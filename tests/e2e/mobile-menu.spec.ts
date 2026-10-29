import { expect, test } from "@playwright/test";
import fs from "node:fs";
import path from "node:path";

test("critical interaction scripts opt out of both production optimizers", async () => {
  const enqueue = fs.readFileSync(
    path.resolve("insightistic-marketing/inc/enqueue.php"),
    "utf8",
  );

  expect(enqueue).toContain('data-cfasync="false"');
  expect(enqueue).toContain('bv-exclude="true"');
  expect(enqueue).toContain("insightistic-theme");
  expect(enqueue).toContain("insightistic-pricing-toggle");
});

test("the mobile navigation opens on the first tap and closes accessibly", async ({ page }) => {
  await page.setContent(`
    <!doctype html>
    <html class="no-js" lang="en">
      <body>
        <header id="ins-header">
          <button id="ins-burger" aria-expanded="false" aria-controls="ins-mobile" aria-label="Open menu">
            <svg aria-hidden="true"></svg>
            <svg aria-hidden="true"></svg>
          </button>
          <div id="ins-mobile" hidden>
            <nav aria-label="Mobile"><a href="#features">Features</a></nav>
          </div>
          <button class="ins-mobile__backdrop" type="button" aria-label="Close menu" hidden></button>
        </header>
      </body>
    </html>
  `);

  await page.addScriptTag({
    path: path.resolve("insightistic-marketing/assets/js/theme.js"),
  });

  const trigger = page.locator("#ins-burger");
  const panel = page.locator("#ins-mobile");
  const backdrop = page.locator(".ins-mobile__backdrop");

  await expect(trigger).toHaveAttribute("aria-expanded", "false");
  await trigger.tap();

  await expect(trigger).toHaveAttribute("aria-expanded", "true");
  await expect(trigger).toHaveAttribute("aria-label", "Close menu");
  await expect(panel).not.toHaveAttribute("hidden", "");
  await expect(panel).toHaveClass(/is-open/);
  await expect(backdrop).not.toHaveAttribute("hidden", "");
  await expect(page.locator("body")).toHaveClass(/ins-menu-open/);
  await expect(panel.getByRole("link", { name: "Features" })).toBeFocused();

  await page.keyboard.press("Escape");

  await expect(trigger).toHaveAttribute("aria-expanded", "false");
  await expect(trigger).toHaveAttribute("aria-label", "Open menu");
  await expect(page.locator("body")).not.toHaveClass(/ins-menu-open/);
  await expect(trigger).toBeFocused();
  await expect(panel).toHaveAttribute("hidden", "", { timeout: 1_000 });
});
