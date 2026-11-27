# Insightistic growth implementation handoff — December 2026

This document is the operational handoff for the approved organic, paid and retargeting plan. It does not contain advertising credentials, customer lists or provider tokens.

## Locked decisions

- Customer target: 100 unique non-refunded customers from AppSumo and direct Stripe by 2026-12-31.
- Initial spend ceiling: Google Ads $5/day plus Meta Ads $3/day.
- No automatic budget increase after the first sale.
- Google paid landing page: `/blackfriday/`.
- Google AppSumo destination: `https://appsumo.com/pl/insightistic-ai-business-intelligence-ga/`.
- Other website AppSumo destination: `https://appsumo.com/pl/insightistic-ai-business-intelligence-w/`.
- Exact paid locations: Mesa, Kentucky, Vientiane, Vientiane Capital, Luang Prabang and Johannesburg. No country-wide expansion without approval.

## Measurement contract

The landing plugin uses consent-gated browser signals:

- `landing_view`
- `blackfriday_view`
- `pricing_view`
- `content_engaged`
- `appsumo_outbound_click`

UTM values are copied into the data layer and click payloads. Configure either a direct Google Ads conversion destination or a GTM conversion tag for the outbound click, never both. Browser events are directional evidence only; purchases are reconciled from AppSumo and Stripe.

## Publication workflow

1. Research with Semrush, Ahrefs, Exa and the available Search Console export.
2. Draft in the marketing repository and store approved assets in the authorised Drive folder.
3. Review claims against the approved entitlement matrix.
4. Run PHP/JavaScript/static SEO checks.
5. Publish through the AdaptlyPost draft and approval queue.
6. Respond to inbox questions and convert repeated objections into FAQ content.
7. Review verified customers, refunds and activations weekly.

`social.wpistic.com` and the WPistic Support Desk remain out of the critical path until authenticated access and session health are verified.

## First content cluster

- WooCommerce reports and analytics
- Google Analytics and WooCommerce integration
- WooCommerce-to-GA troubleshooting
- WooCommerce dashboard
- WooCommerce reporting comparison
- Metorik alternatives
- GA4 versus WooCommerce reconciliation
- Agency reporting workflow

Every page requires one factual CTA, one author, a review date, source/methodology notes, two relevant internal links and clearly labelled illustrative data where customer data is not available.

## Pre-launch gate

Do not increase spend or publish new paid creative until the following are verified in the live provider diagnostics:

- One landing view per consented session.
- One outbound-click event per CTA click.
- No duplicate Google conversion from GTM plus direct gtag.
- AppSumo links resolve to the approved destinations.
- Stripe purchase and AppSumo activation can be reconciled separately.
- Purchasers are excluded from retargeting audiences.
