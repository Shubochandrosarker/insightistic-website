# Insightistic Website Redesign Delivery Report

**Date:** 2026-10-15
**Branch:** `feature/insightistic-brand-seo-redesign`
**Write scope:** `insightistic-website` only

## Delivered

- Reworked the marketing theme around the approved `#04D2C0 → #0064F9`
  teal-to-blue identity with a light SaaS shell, dark product-surface mockups,
  clearer contrast, responsive grids and reduced-motion support.
- Refreshed the homepage composition, hero messaging, navigation fallbacks,
  feature bands, connector journey, reports, security, pricing and final CTA.
- Kept Formistic, the connector boundary and the existing WordPress template
  architecture intact.
- Added strict public-catalog validation. The theme accepts a complete API
  catalog only; incomplete or unavailable API responses use the audited
  application snapshot instead of publishing stale entitlements.
- Added Free Connected, the full approved paid resource comparison, Insight
  Credit packs and application-controlled Founding Angel status handling.
- Removed invented testimonial fallback content and labeled dashboard/report
  figures as illustrative samples.
- Updated fallback metadata, schema offers, sitemap/LLM discovery references,
  README guidance and the website-owned ChatGPT handoff bundle.
- Added the audit and implementation wireframe at
  `docs/WEBSITE-REDESIGN-AUDIT.md`.

## Commercial source of truth

The local application checkout was inspected read-only. Its commercial catalog
is version `2026-10-14` and supplies the approved Starter, Growth, Agency and
Agency Pro plans, Free Connected, three Angel tiers, three credit packs and AI
action costs.

The live `GET https://api.insightistic.com/api/public/plans` endpoint returned
HTTP 200 during this audit but still omitted the catalog version, LTD campaign,
credit packs and AI action costs. It also returned limits that did not match the
local application catalog. The website therefore fails closed to the audited
fallback until the deployed API publishes the complete contract.

## Validation matrix

| Area | Result | Evidence / boundary |
|---|---|---|
| PHP syntax | PASS | `php -l` completed for every PHP file in `insightistic-marketing/`. |
| JavaScript syntax | PASS | `node --check` passed for `theme.js` and `pricing-toggle.js`. |
| Theme JSON | PASS | `theme.json` parsed successfully; 11 intentional palette entries remain. |
| SVG/XML assets | PASS | Updated SVG assets parsed successfully. |
| CSS structure | PASS | CSS brace-balance check passed for every stylesheet. |
| Diff hygiene | PASS | `git diff --check` completed without whitespace errors. Git reports only normal LF/CRLF conversion warnings for two edited PHP files. |
| Legacy palette scan | PASS | No old purple/violet or deprecated green color values remain in theme source. |
| Local application contract comparison | PASS | Website mapping matches the inspected controller field names, limits and catalog sections. |
| WordPress render at 320/375/390/768/1024/1440/1920 | NEEDS VALIDATION | No local WordPress runtime/container was available in this workspace. Existing baseline captures were retained; visual regression must be run after the theme is loaded in staging. |
| Formistic submission and connector sync | NEEDS VALIDATION | Both integrations were preserved and not modified, but require a reachable WordPress staging site for browser and round-trip proof. |
| Live marketing deployment | NOT PERFORMED | This task changed the branch only; no production upload, cache purge or deployment was executed. |

## Files intentionally preserved

The application checkout, canonical plugin code, existing `.codex-backups/`
files and existing `codex-screenshots/` files were not modified or deleted.

## Staging acceptance checklist

Before merging or deploying, load the theme in a WordPress staging site and
verify:

1. The front page and every required page template render without PHP notices.
2. The fallback catalog shows the approved values while the live API remains
   incomplete, then switches to the API catalog only after the endpoint is
   complete.
3. Annual pricing changes paid cards only; Free Connected remains `$0 forever`.
4. LTD cards show all monthly allowances and never show a fabricated deadline or
   guessed remaining-license count.
5. Header focus, Escape, outside-click, mobile navigation, FAQ interaction and
   reduced-motion behavior work at all required viewports.
6. Formistic contact/newsletter/agency/LTD forms and the connector license/sync
   journey work end to end.
7. Browser console, accessibility audit, no-horizontal-scroll, CTA URLs, SEO
   metadata, JSON-LD, `/sitemap.xml`, `/llms.txt` and `/llms-full.txt` are clean.
