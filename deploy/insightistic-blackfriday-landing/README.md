# Insightistic Black Friday landing

This is the standalone WordPress plugin used for the live [Black Friday page](https://www.insightistic.com/blackfriday/). Version 1.0.2 includes the offer and tier comparison, site links, structured data, and consent-aware click measurement.

## WordPress integration

- The plugin selects published page ID 605 with slug `blackfriday` through `template_include`. WordPress previews and other routes use the normal template.
- `landing.php` renders the page. `landing.css` is the compiled stylesheet and `measurement.js` provides optional measurement.
- In Settings → Black Friday measurement, confirm the Tag Manager container, direct Google Ads event destination, and Meta Pixel. Save blank advertising destinations in an isolated test site to disable the direct tags. The package's advertising defaults are the same public browser identifiers used by the production page. WordPress previews bypass the custom landing template.
- All nine deal links use the Google Ads AppSumo partner destination. The separate marketing site link is owned by the theme. The existing theme template remains the fallback if this plugin is disabled.

## Measurement

- Analytics and advertising measurement default to denied. Site visitors can set their choices independently from the landing page.
- With advertising consent, the browser loads the direct Google Ads tag and the Meta Pixel. The Google event records an outbound click. The Meta browser events are `PageView` and `AppSumoOutboundClick`.
- A deal click sends the visitor to AppSumo. Confirmed purchases require separate verification through the marketplace.

## Verification and rollback

- Run PHP lint on both PHP files and `node --check measurement.js`.
- Verify the canonical and paid campaign URLs, one H1 and canonical tag, nine deal links, and the footer. Check that the page works with analytics and advertising declined.
- In a controlled browser, mock the external advertising requests to check exactly one click event per platform. For live attribution, use the relevant provider's diagnostics.
- Before any WordPress update, retain the previous plugin package. If rollback is necessary, reinstall the previous package or deactivate this plugin to return to the theme fallback. Purge the landing URL from the WordPress cache and verify it again.
