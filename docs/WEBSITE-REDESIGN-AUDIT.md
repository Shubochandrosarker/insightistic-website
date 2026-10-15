# Insightistic Website Redesign Audit

**Audit date:** 2026-10-15
**Write target:** `insightistic-website` only
**Read-only sources:** `insightistic-app` application checkout and the live public endpoints
**Implementation branch:** `feature/insightistic-brand-seo-redesign`

## Executive summary

The marketing website is a WordPress-native custom theme with reusable template
parts, a small vanilla JavaScript layer, Formistic forms, and a legacy
Insightistic connector kept for backwards compatibility. The current theme has
good separation from the application, but its presentation still uses the old
mint/green and violet palette, repeats unsupported or stale commercial claims,
and renders too much of the homepage as one undifferentiated scroll.

The highest-risk issue is commercial data drift. The local application catalog
and controller define catalog version `2026-10-14`, the approved four paid
plans, three Founding Angel tiers, AI credit packs, and campaign state. The
live `GET https://api.insightistic.com/api/public/plans` response inspected on
2026-10-15 returned HTTP 200 but omitted `catalog_version`, `trial_days`, `ltd`,
`credit_packs`, and `ai_action_costs`, while also returning different site,
AI-insight, report, crawl, and keyword limits. The website must not treat that
response as authoritative until it satisfies the expected schema.

The live marketing homepage was reachable with HTTP 200 through Cloudflare. A
cached page response identified the active theme as `insightistic-marketing`
and the current public render still contained old trial language, old social
proof, and the existing mint/blue visual treatment. Existing baseline captures
in `codex-screenshots/20260928-154810-live-html/` show the same overall pattern
on the integrations and LTD pages: clean but overly sparse layouts, weak visual
hierarchy, outdated green accents, and commercial claims that require review.

## Repository and architecture

### Website repository

- `insightistic-marketing/` is a custom WordPress theme, not a Next.js site.
- Global composition lives in `front-page.php`, `header.php`, `footer.php`,
  `functions.php`, and `template-parts/`.
- Styles are split across `assets/css/theme.css`, `responsive.css`,
  `pricing-layout.css`, and `blocks.css`.
- Interactions are intentionally lightweight vanilla JavaScript in
  `assets/js/theme.js` and `assets/js/pricing-toggle.js`.
- The theme includes page templates for feature pages, pricing, LTD, agency,
  SEO, traffic, performance, reports, integrations, legal pages, knowledgebase,
  and ecosystem content.
- Formistic and `insightistic-connector` are separate repository components and
  are preserved. Their internal functionality is outside this visual redesign.
- Existing untracked `.codex-backups/` and `codex-screenshots/` are preserved.

### Application repository (read-only)

The app checkout contains a Next.js dashboard and Laravel API. No files in that
checkout are being modified. Read-only route inspection verified public-facing
product areas including:

- WordPress/WooCommerce analytics: overview, revenue, orders, products,
  customers, refunds, comparisons, and the semantic query engine.
- Traffic and SEO: traffic dimensions, Search Console queries/pages/overview,
  Bing search data, rank history, crawl/search intelligence, and IndexNow.
- Performance and operations: PageSpeed, Core Web Vitals data, uptime, site
  health, anomaly scans, alerts, and scheduled jobs.
- AI workflows: Ask Insightistic, saved insights, investigations, AI insights,
  action proposals with explicit approval, outcome verification, and supported
  automation rules.
- Reporting and agency workflows: reports, scheduled delivery, email audit
  workflows, agency overview/portfolio, client grouping, team roles, white-label
  settings, licenses, usage, and privacy controls.
- Integrations and billing: Google/GA4/Search Console, Cloudflare, connector
  sync, account billing, Paddle checkout configuration, credit wallet, and
  license activation.

Marketing copy will describe these as available capabilities only where the
relevant route or application surface verifies them. Empty-state or future
roadmap behavior will not be marketed as a guaranteed current result.

## Current UI findings

### Brand system

- `theme.css`, `theme.json`, `blocks.css`, and inline SVG preview accents still
  use `#00C04B`, `#00D084`, and `#6C5CE7`.
- The header logo asset is retained, but the surrounding UI does not yet use the
  approved teal-to-blue identity.
- The old green-to-violet gradient appears in buttons, text gradients, pricing,
  badges, SVG charts, and editor color presets.
- Tokens are fragmented (`--brand`, `--brand-2`, `--violet`, `--ink`, `--panel`)
  and do not map cleanly to the approved semantic vocabulary.

### Layout and content

- The homepage has a useful section architecture, but the hero still leads with
  generic “AI Business Analytics” language and “Start Free Trial” rather than a
  clear free-account/plugin entry point.
- The current hero uses unsupported-looking convenience claims such as “3 min to
  connect” and “No credit card” without a source/state distinction.
- The product preview uses synthetic metric values. It needs explicit product
  preview labeling and stronger separation from verified customer results.
- The homepage repeats pricing and conversion CTAs without enough product proof,
  data-source context, or a clear WordPress-plugin-to-cloud journey.
- Feature pages rely on long centered sections and repeated cards. The redesign
  should use consistent section bands, proof-led layouts, and scannable
  capability summaries.
- Existing baseline captures show large unused vertical space, light low-contrast
  copy, and a weak distinction between primary and secondary actions.

### Navigation and interaction

- The theme has a desktop menu, a hidden mobile panel, a backdrop, and deferred
  vanilla JS. This is a sound base to preserve.
- Fallback desktop and mobile menus are not perfectly aligned: desktop uses
  `Learn` and `About`, while mobile uses `Knowledgebase` and `Contact`.
- Mobile, focus, escape, outside-click, and reduced-motion behavior need direct
  verification after the redesign.
- Pricing toggle is lightweight, but the pricing cards do not currently expose
  the full approved resource comparison.

### Pricing and commercial content

- The current theme fetches `/api/public/plans` and maps only the paid `plans`
  rows into pricing cards.
- The current fallback values contain outdated entitlements such as 3/10/30/100
  sites and do not expose the approved resource matrix, Free Connected tier,
  credit packs, or live LTD campaign status.
- The current public page says every plan includes a 14-day trial and no credit
  card, while the approved brief requires a separate Free Connected tier and
  limits trial language to what is verified.
- The live API returned HTTP 200 but did not match the application controller's
  published contract. Runtime schema validation and a versioned fallback are
  required.
- LTD copy and cards must use the application campaign state, never a hardcoded
  deadline, sold count, or competing inventory counter.
- The historical future-product discount claim needs owner/legal verification;
  it will not be marketed as a current new-sales promise without evidence.

### Trust and proof

- `template-parts/sections/testimonials.php` renders named testimonials from
  theme data, including “Marcus Lindqvist / Pulse Supplements”. No consent or
  evidence is present in this repository. These will be replaced with factual
  product proof unless verified evidence is supplied.
- No Review or AggregateRating schema should be emitted for these entries.
- Security and privacy copy must describe implemented architecture and controls,
  not certifications or guarantees that the source does not verify.
- Legal entity and founder identity are present in `inc/site-data.php`; these
  remain useful E-E-A-T signals but should be kept factually separate from
  product performance claims.

### SEO and AI discovery

- The theme already contains dedicated SEO and discovery modules, canonical and
  metadata helpers, sitemap/knowledgebase pages, and a site-data registry.
- Titles and descriptions still reflect older positioning and trial language.
- Structured data and pricing output need to be audited against the validated
  catalog instead of hardcoded fallback assumptions.
- The repository does not currently contain a complete ChatGPT handoff bundle.
  Website-owned product profile, FAQ, feature catalog, pricing reference, source
  links, and update instructions will be added without claiming external ChatGPT
  configuration access.

### Performance and accessibility

- The theme avoids mandatory jQuery, React, and a heavy animation framework;
  that lightweight approach will be preserved.
- CSS is concentrated in a large theme stylesheet and includes duplicated
  responsive rules. Tokens and component layers will be consolidated carefully.
- Images and SVG preview assets need explicit size/alt treatment and above-fold
  prioritization.
- Keyboard focus, touch target size, contrast, heading hierarchy, form labels,
  and reduced motion require manual verification at the requested viewports.

## Audit wireframe and implementation direction

```text
┌──────────────────────────────────────────────────────────────┐
│ Wordmark | Product | Solutions | Resources | Pricing | Sign in│
│                                      [Start free]              │
├──────────────────────────────────────────────────────────────┤
│ Eyebrow: AI business intelligence for WordPress & WooCommerce│
│ Understand your WordPress business. Act on what matters.      │
│ Clear value proposition + Start free + Explore features       │
│ Plugin / free account note                                    │
│                           ┌─────────────────────────────────┐ │
│                           │ labeled product preview          │ │
│                           │ KPI / trend / AI recommendation  │ │
│                           └─────────────────────────────────┘ │
├──────────────────────────────────────────────────────────────┤
│ One workspace: commerce | traffic | SEO | performance | AI    │
├──────────────────────────────────────────────────────────────┤
│ Problem → connected sources → measurable next action          │
├──────────────────────────────────────────────────────────────┤
│ Feature proof bands: WooCommerce / SEO / AI / reports         │
├──────────────────────────────────────────────────────────────┤
│ WordPress plugin + cloud connection + agency workflow         │
├──────────────────────────────────────────────────────────────┤
│ Free Connected | paid plan preview | transparent allowances   │
├──────────────────────────────────────────────────────────────┤
│ FAQ / trust / final CTA                                       │
├──────────────────────────────────────────────────────────────┤
│ Footer: product, resources, legal, contact, ecosystem         │
└──────────────────────────────────────────────────────────────┘
```

Implementation will use the approved `#04D2C0 → #0064F9` gradient as the visual
signature, with dark navy surfaces, accessible text colors, restrained shadows,
and responsive grids. The existing WordPress template-part architecture will be
kept so page-template assignments and Customizer options remain compatible.

## Planned implementation sequence

1. Introduce centralized design tokens in CSS and `theme.json`, replacing only
   marketing accents while preserving semantic success states.
2. Rework header, mobile navigation, buttons, forms, cards, tables, accordions,
   footer, and shared section primitives.
3. Refresh homepage and existing feature templates with product-accurate,
   proof-led copy and a clearly labeled application preview.
4. Replace pricing integration with strict catalog validation, approved
   versioned fallback data, Free Connected/credits presentation, full resource
   comparisons, and API-driven LTD state.
5. Remove unverified named testimonials from public output and replace them with
   factual product proof.
6. Update SEO metadata, structured data, AI discovery files, and the ChatGPT
   handoff bundle without changing app/backend behavior.
7. Run PHP/JSON/CSS/JS checks, render the website locally where possible, inspect
   requested viewports, and record actual PASS/NEEDS VALIDATION/BLOCKED results.

## Scope and blockers

- No application, API, database, billing, licensing, customer, or plugin files
  will be modified.
- The live API contract mismatch is an external deployment/configuration issue;
  the website can fail closed on incomplete responses but cannot repair the API
  from this repository.
- Live browser screenshots at every required viewport require a reachable
  WordPress render or local/staging WordPress runtime. Existing baseline images
  are retained; any missing runtime evidence will be marked as NEEDS VALIDATION,
  not claimed as passed.
- Creating or pushing a GitHub pull request requires repository credentials and
  remote access. The branch and local commit can be prepared here; PR creation
  will be reported only if it is actually completed.
