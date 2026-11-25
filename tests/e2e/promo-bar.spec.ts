import { expect, test } from "@playwright/test";
import fs from "node:fs";
import path from "node:path";

/**
 * AppSumo announcement bar.
 *
 * Shuvo's mechanics: a per-visitor EVERGREEN window (8d 23h 59m from first
 * sight, stored in ins_promo_first_seen), dismissal remembered per device, and
 * an expiry that simplifies the bar to badge + CTA instead of showing a dead
 * "expired" banner.
 *
 * The bar markup is injected from the theme partial and its real script is
 * loaded from disk, so this exercises the shipped code rather than a copy.
 */
const PARTIAL = fs.readFileSync(
  path.resolve("insightistic-marketing/template-parts/global/promo-bar.php"),
  "utf8",
);
const SCRIPT = path.resolve("insightistic-marketing/assets/js/promo-bar.js");
const ORIGIN = "https://insightistic.test";
const CSS = fs.readFileSync(
  path.resolve("insightistic-marketing/assets/css/promo-bar.css"),
  "utf8",
);

/** The partial is PHP; strip the tags down to the markup the browser receives. */
function barMarkup(): string {
  return `<!doctype html>
  <html><head><style>${CSS}</style></head><body>
    <div id="ins-promo-bar" class="ins-promo-bar" data-promo-end="" hidden role="region">
      <div class="ins-promo-bar__inner">
        <span class="ins-promo-bar__badge">LIFETIME DEAL</span>
        <p class="ins-promo-bar__text">Insightistic Lifetime Deal on AppSumo — from $49.</p>
        <span class="ins-promo-bar__countdown" data-promo-countdown hidden>
          <span class="ins-promo-bar__countdown-label">Ends in</span>
          <span class="ins-promo-bar__clock" data-promo-clock>—</span>
        </span>
        <a class="ins-promo-bar__cta" href="https://appsumo.com/products/insightistic-ai-business-intelligence-w/">Get the Lifetime Deal</a>
        <button type="button" class="ins-promo-bar__close" data-promo-dismiss aria-label="Dismiss">×</button>
      </div>
    </div>
  </body></html>`;
}

/** localStorage shim is unnecessary now that we serve a real origin. */
async function primeVisitedAt(page: import("@playwright/test").Page, seenAt: number | null, dismissed = false) {
  await page.addInitScript(
    ([seen, wasDismissed]) => {
      if (seen !== null) window.localStorage.setItem("ins_promo_first_seen", String(seen));
      if (wasDismissed) window.localStorage.setItem("ins_promo_dismissed", "1");
    },
    [seenAt, dismissed],
  );

  // Serve a real https origin: localStorage is unavailable on about:blank,
  // and the bar's whole memory (first sight, dismissal) depends on it.
  await page.route(`${ORIGIN}/**`, (route) =>
    route.fulfill({ status: 200, contentType: "text/html", body: barMarkup() }),
  );

  await page.goto(`${ORIGIN}/`);
  await page.addScriptTag({ path: SCRIPT });
}

test("the bar renders with a live countdown inside the evergreen window", async ({ page }) => {
  await primeVisitedAt(page, Date.now());
  await page.setContent(barMarkup());
  await page.addScriptTag({ path: SCRIPT });

  const bar = page.locator("#ins-promo-bar");
  await expect(bar).toBeVisible();

  const clock = page.locator("[data-promo-clock]");
  await expect(clock).toHaveText(/\d+d \d+h \d{2}m \d{2}s/);

  // It really ticks: the seconds field changes within a couple of seconds.
  const first = await clock.textContent();
  await page.waitForTimeout(2100);
  expect(await clock.textContent()).not.toBe(first);
});

test("the countdown starts from the first visit and never resets", async ({ page }) => {
  const threeDaysAgo = Date.now() - 3 * 24 * 60 * 60 * 1000;
  await primeVisitedAt(page, threeDaysAgo);
  await page.setContent(barMarkup());
  await page.addScriptTag({ path: SCRIPT });

  // 8d 23h 59m minus 3 days → the clock is already inside day 6.
  await expect(page.locator("[data-promo-clock]")).toHaveText(/^5d /);
});

test("an expired window keeps badge and CTA and hides only the countdown", async ({ page }) => {
  const longAgo = Date.now() - 30 * 24 * 60 * 60 * 1000;
  await primeVisitedAt(page, longAgo);
  await page.setContent(barMarkup());
  await page.addScriptTag({ path: SCRIPT });

  await expect(page.locator("#ins-promo-bar")).toBeVisible();
  await expect(page.locator("[data-promo-countdown]")).toBeHidden();
  await expect(page.locator(".ins-promo-bar__cta")).toBeVisible();
});

test("dismissing hides the bar and is remembered", async ({ page }) => {
  await primeVisitedAt(page, Date.now());
  await page.setContent(barMarkup());
  await page.addScriptTag({ path: SCRIPT });

  await page.locator("[data-promo-dismiss]").click();

  await expect(page.locator("#ins-promo-bar")).toBeHidden();

  const stored = await page.evaluate(() => (window as any).localStorage.getItem("ins_promo_dismissed"));
  expect(stored).toBe("1");
});

test("a returning visitor who dismissed never sees the bar again", async ({ page }) => {
  await primeVisitedAt(page, Date.now(), true);
  await page.setContent(barMarkup());
  await page.addScriptTag({ path: SCRIPT });

  await expect(page.locator("#ins-promo-bar")).toBeHidden();
});

test("the partial carries the website tracking slug and the offer copy", async () => {
  expect(PARTIAL).toContain("insightistic_promo_url");
  expect(PARTIAL).toContain("LIFETIME DEAL");
  expect(PARTIAL).toContain("Agent JOLLY included in every tier");
  expect(PARTIAL).toContain("Get the Lifetime Deal");

  const helpers = fs.readFileSync(
    path.resolve("insightistic-marketing/inc/helpers.php"),
    "utf8",
  );
  expect(helpers).toContain("insightistic-ai-business-intelligence-w");
});

test("the bar respects prefers-reduced-motion", async () => {
  expect(CSS).toContain("prefers-reduced-motion: reduce");
});
