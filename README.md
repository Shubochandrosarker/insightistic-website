# insightistic-website

Public-facing WordPress side of Insightistic — kept fully separate from the
[`insightistic-app`](https://github.com/Shubochandrosarker/insightistic-app)
repo (dashboard + API) and the [`insightistic`](https://github.com/Shubochandrosarker/insightistic)
repo (the canonical, license-activated product plugin).

- `insightistic-marketing/` — the `insightistic.com` marketing site theme.
- `formistic/` — lead-capture forms plugin used by the marketing site (contact,
  demo request, agency inquiry, newsletter — see the marketing site's forms).
- `insightistic-connector/` — legacy, lightweight WordPress plugin for sites
  that don't run the main [`insightistic`](https://github.com/Shubochandrosarker/insightistic)
  plugin (e.g. an agency dashboarding a client's store). Connects via a
  manually-issued connector token instead of a license key. Not part of the
  normal customer onboarding flow — the main plugin is the default path for
  every new customer; this stays only for backward compatibility.

## What's NOT here

The main Insightistic WordPress plugin (license-key activation, GA4/Search
Console/PageSpeed/WooCommerce/Cloudflare analytics, AI Insights) lives
exclusively in the [`insightistic`](https://github.com/Shubochandrosarker/insightistic)
repo — never duplicate it into this one.
