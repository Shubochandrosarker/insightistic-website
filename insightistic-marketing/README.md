# Insightistic Marketing — WordPress Theme

A premium, mobile-first **light SaaS** marketing theme for **Insightistic** —
AI Business Intelligence for WordPress & WooCommerce. The page chrome is light
by default with the approved teal-to-blue brand gradient; embedded product-shot
cards (dashboard preview, report card) keep a deliberate dark product-surface
treatment as an accent, not a theme flip — see the `:root` tokens in
`assets/css/theme.css`. It powers the public
marketing website at `insightistic.com` only. Accounts, billing and the
dashboard live in the separate SaaS app (`app.insightistic.com`) and API
(`api.insightistic.com`); **no dashboard logic lives in this theme.**

- No page builder, no jQuery dependency, no remote fonts.
- Native WordPress blocks/templates + reusable template parts.
- Mobile-first CSS, fluid type, 44px tap targets, accessible nav & FAQ.
- SEO-ready (title-tag, schema, breadcrumbs) and SEO-plugin friendly.
- Formistic-ready form areas with graceful fallbacks.

## Requirements

- WordPress 6.4+ and PHP 8.0+.
- (Optional) **Formistic** plugin for contact / newsletter / lead forms.
- (Optional) An SEO plugin (Rank Math / Yoast) — the theme won't duplicate meta.

## Install

1. Zip the `insightistic-marketing/` folder (or upload it to
   `wp-content/themes/insightistic-marketing`).
2. **Appearance → Themes → Add New → Upload**, then **Activate**.
3. **Appearance → Customize → Insightistic** to set:
   - App / API / Marketing URLs
   - Hero eyebrow, title, subtitle
   - Formistic form ids (contact, newsletter, agency, ltd, …)
   - Footer tagline + social links
4. **Appearance → Menus**: create menus and assign to **Primary**, **Footer**
   and **Legal** locations.
5. **Settings → Reading**: set a static front page (any page) — the homepage
   uses `front-page.php` automatically, so the full multi-section landing renders
   regardless of which page you choose.

## Required pages & templates

Create these pages and assign the matching **Page Template** (Page → Page
Attributes → Template):

| Page | Template |
|---|---|
| Home (front page) | *(automatic — `front-page.php`, multi-section landing)* |
| Pricing (`/pricing`) | Pricing |
| Features (`/features`) | Features |
| Contact (`/contact`) | Contact |
| About (`/about`) | About |
| Why Insightistic (`/why-insightistic`) | Why Insightistic |
| Integrations (`/integrations`) | Integrations |
| WooCommerce Analytics (`/woocommerce-analytics`) | WooCommerce Analytics |
| Traffic Analytics (`/traffic-analytics`) | Traffic Analytics |
| SEO Analytics (`/seo-analytics`) | SEO Analytics |
| Performance Monitoring (`/performance-monitoring`) | Performance Monitoring |
| AI Insights (`/ai-insights`) | AI Insights |
| Reports (`/reports`) | Reports |
| Security (`/security`) | Security |
| Agency (`/agency`) | Agency |
| Lifetime Deal (`/lifetime-deal`) | Lifetime Deal |
| Changelog (`/changelog`) | Changelog |
| Blog index | *(automatic — Settings → Reading → Posts page)* |
| Privacy Policy (`/privacy-policy`) | Privacy Policy |
| Terms (`/terms`) | Terms |

20 pages total (Home + 18 templated pages + the blog index, which uses no
dedicated template of its own). The blog index is whatever you set under
**Settings → Reading → Posts page**.

## App routing

Every CTA links to the app via the `insightistic_get_app_url()` helper:

```php
echo esc_url( insightistic_get_app_url( '/login' ) );
echo esc_url( insightistic_register_url( 'growth' ) ); // /register?plan=growth
echo esc_url( insightistic_dashboard_url() );
```

Defaults: `https://app.insightistic.com` — change in **Customize → Insightistic
→ App & API URLs**. Plan CTAs already point at
`/register?plan=starter|growth|agency|agency_pro`.

## Formistic forms

Form areas degrade gracefully: if Formistic isn't active, a clear message shows
instead. Areas: `contact`, `newsletter`, `agency`, `ltd`, `early_access`,
`support`.

`contact` and `newsletter` always use Formistic's fixed shortcodes — nothing
to configure. The other four (`agency`, `ltd`, `early_access`, `support`) are
Formistic builder forms; **as soon as both this theme and Formistic are
active** (in either order), `inc/formistic-provisioning.php` auto-creates all
four with real fields/copy and fills in their Customizer slot — an admin
never has to build them by hand first. It's idempotent (`ensure_form()` in
Formistic keys off a stored identifier, not the title, so renaming or
re-running never duplicates a form) and never overwrites a slot an admin has
already set manually. Override the generated fields/copy via the
`insightistic_formistic_form_definitions` filter, or just pick a different
form from the dropdown in **Customize → Forms** afterward.

```php
insightistic_formistic_form( 'contact', 'Send us a message' );
```

Consent line to use under forms:

> By submitting this form, you agree to our [Privacy Policy](/privacy-policy).

## Demo content (optional)

- **Testimonials**: add only consented, evidence-backed entries under the
  **Testimonials** menu. The theme has no invented fallback quotes. Use the
  page-attributes *Order* to sort; add a role in
  the body via custom field `_ins_role` if desired.
- **Pricing**: `insightistic_public_catalog()` fetches the complete manifest
  from `GET {API URL}/api/public/plans` (cached 5 minutes). A response is
  accepted only when it includes the catalog version, Free Connected tier,
  paid resource limits, LTD tiers, credit packs and AI action costs. An
  incomplete response fails closed to the audited application catalog snapshot
  in `inc/helpers.php`; the application remains authoritative for checkout.
- **FAQ / Features**: edit `insightistic_faqs()` / `insightistic_features()` in
  `inc/helpers.php`, or hook the `insightistic_faqs` / `insightistic_features`
  filters from a small mu-plugin.

## Performance & SEO notes

- CSS is split into `theme.css` (base, mobile-first), `responsive.css` and
  `blocks.css`. JS is two small deferred files; the pricing toggle only loads
  where a pricing table exists.
- The FAQ outputs `FAQPage` JSON-LD. `title-tag`, post thumbnails and excerpts
  are supported; the theme defers meta titles/descriptions to your SEO plugin.

## Deployment checklist

- [ ] Theme uploaded to `wp-content/themes/insightistic-marketing` and activated.
- [ ] Customizer: App/API/Marketing URLs set.
- [ ] Menus assigned (Primary, Footer, Legal).
- [ ] All required pages created with the correct templates.
- [ ] Static front page set under Settings → Reading.
- [ ] Formistic installed + form ids mapped (or fallback accepted).
- [ ] Permalinks set to "Post name" (Settings → Permalinks).
- [ ] Test on 360 / 390 / 768 / 1024 / 1440 widths — no horizontal scroll.
- [ ] Verify CTAs open `app.insightistic.com/login` and `/register?plan=...`.

See `Appearance → Insightistic` for a live summary of URLs and integration status.

## Discovery, SEO and agent browsing

- The theme emits canonical URLs, descriptions, Open Graph/Twitter fallbacks,
  robots directives and one connected JSON-LD graph when no SEO plugin owns
  those outputs. The graph covers Organization, WebSite, Product/
  SoftwareApplication, WebPage/CollectionPage, BreadcrumbList, BlogPosting and
  visible FAQ content.
- Dynamic discovery endpoints are generated from published WordPress content:
  `/sitemap.xml`, `/sitemap-pages.xml`, `/sitemap-posts.xml`,
  `/sitemap-taxonomies.xml`, `/llms.txt` and `/llms-full.txt`.
- `/robots.txt` remains WordPress’s standard endpoint but advertises the
  branded sitemap and keeps admin/search paths out of the crawl. Rewrite rules
  flush on theme activation; flush permalinks once after deployment if a new
  endpoint returns 404.
- `llms.txt` is a concise product/entity map. `llms-full.txt` adds current
  published page summaries and recent editorial routes. Both are generated at
  request time so editors do not maintain duplicated route lists.
- External ecosystem links are conservative by default. Add additional live,
  approved product roots through the `insightistic_ecosystem_links` filter after
  verifying each destination; the directory avoids invented or broken links.

## Legal and entity configuration

The legal templates use the public entity details supplied for WordPressistic
LLC: 1209 MOUNTAIN ROAD PL NE, STE N, Albuquerque, NM 87110, US; Entity ID
0008120099; Reference 3277100; `hello@wordpressistic.com`. Review the legal
copy with qualified counsel before publication for a specific jurisdiction,
especially for privacy, data-processing, refund and accessibility obligations.

Create these additional WordPress pages and assign their matching template:

- `/knowledgebase` → Knowledgebase
- `/ecosystem` → Ecosystem
- `/sitemap` → HTML Sitemap
- `/cookies` → Cookie Policy
- `/data-processing` → Data Processing Information
- `/accessibility` → Accessibility Statement
- `/refunds` → Refund & Cancellation Policy
- `/acceptable-use` → Acceptable Use Policy
- `/subprocessors` → Subprocessors
- `/legal-notices` → Legal Notices

On theme activation, the theme provisions these pages idempotently and assigns
their templates when they are missing. Existing pages and non-default
templates are preserved. If a site was already active before this module was
installed, activate the theme once or assign the templates manually from the
page editor.
