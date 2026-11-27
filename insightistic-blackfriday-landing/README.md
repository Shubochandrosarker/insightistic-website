# Insightistic Black Friday landing

This folder contains the source for the WordPress plugin that serves the existing `/blackfriday/` campaign page.

## Files

- `insightistic-blackfriday-landing.php` routes the existing campaign page to the standalone template and retains its measurement configuration.
- `landing.php` contains the page markup, SEO metadata, AppSumo tier data, promotion cutoff, internal links, and FAQs.
- `landing.css` contains the page styles, including the responsive tier comparison table.
- `measurement.js` retains the existing consent-aware ad measurement behavior.

## Live deployment

This repository does not currently auto-deploy this plugin to Insightistic.com. To deploy the reviewed source, back up the active plugin folder first, then replace the files in:

`wp-content/plugins/insightistic-blackfriday-landing/`

Keep the directory name unchanged because the plugin builds its asset URLs from its installed location. After deployment, confirm that `/blackfriday/` renders and that each AppSumo button opens the campaign URL configured in the template.

The `/ga/` AppSumo destination is intentional for the Google Ads campaign. The 10% Black Friday display switches off after December 1, 2026 at 12:00 p.m. Central Time; the page then shows the standard AppSumo prices.