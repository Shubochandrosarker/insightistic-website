<?php
defined( 'ABSPATH' ) || exit;

$bf_appsumo_url = 'https://appsumo.com/pl/insightistic-ai-business-intelligence-ga/';
$bf_promo_timezone = new DateTimeZone( 'America/Chicago' );
$bf_now = new DateTimeImmutable( 'now', $bf_promo_timezone );
$bf_promo_ends_at = new DateTimeImmutable( '2026-12-01 12:00:00', $bf_promo_timezone );
$bf_promo_active = $bf_now < $bf_promo_ends_at;

$bf_tiers = array(
	array(
		'tier' => 1, 'price' => 49, 'sites' => '5', 'google_keywords' => '10', 'jolley_replies' => '300',
		'credits' => '5,000', 'maps_keywords' => '5', 'crawl_pages' => '10,000', 'browser_minutes' => '15',
		'knowledge_bases' => '1', 'maps_profiles' => '1', 'ai_requests' => '100', 'reports' => '10',
		'active_schedules' => '5', 'scheduled_reports' => '5', 'team' => '5 teammates + owner',
		'woocommerce' => 'Not included', 'workflows' => 'Not included', 'competitors' => 'Not included',
		'white_label' => 'Not included', 'priority_support' => 'Not included', 'executive_insights' => 'Not included',
	),
	array(
		'tier' => 2, 'price' => 79, 'sites' => '10', 'google_keywords' => '20', 'jolley_replies' => '500',
		'credits' => '10,000', 'maps_keywords' => '5', 'crawl_pages' => '40,000', 'browser_minutes' => '60',
		'knowledge_bases' => '3', 'maps_profiles' => '1', 'ai_requests' => '200', 'reports' => '50',
		'active_schedules' => '25', 'scheduled_reports' => '25', 'team' => 'No fixed seat cap*',
		'woocommerce' => 'Included', 'workflows' => 'Included', 'competitors' => 'Not included',
		'white_label' => 'Not included', 'priority_support' => 'Not included', 'executive_insights' => 'Not included',
	),
	array(
		'tier' => 3, 'price' => 149, 'sites' => '15', 'google_keywords' => '30', 'jolley_replies' => '800',
		'credits' => '30,000', 'maps_keywords' => '5', 'crawl_pages' => '100,000', 'browser_minutes' => '180',
		'knowledge_bases' => '5', 'maps_profiles' => '1', 'ai_requests' => '600', 'reports' => 'Unlimited',
		'active_schedules' => '50', 'scheduled_reports' => '50', 'team' => 'No fixed seat cap*',
		'woocommerce' => 'Included', 'workflows' => 'Included', 'competitors' => 'Included',
		'white_label' => 'Not included', 'priority_support' => 'Not included', 'executive_insights' => 'Not included',
	),
	array(
		'tier' => 4, 'price' => 269, 'sites' => '30', 'google_keywords' => '50', 'jolley_replies' => '1,200',
		'credits' => '75,000', 'maps_keywords' => '10', 'crawl_pages' => '250,000', 'browser_minutes' => '300',
		'knowledge_bases' => '10', 'maps_profiles' => '2', 'ai_requests' => '1,500', 'reports' => 'Unlimited',
		'active_schedules' => '100', 'scheduled_reports' => '100', 'team' => 'No fixed seat cap*',
		'woocommerce' => 'Included', 'workflows' => 'Included', 'competitors' => 'Included',
		'white_label' => 'Included', 'priority_support' => 'Included', 'executive_insights' => 'Included',
	),
	array(
		'tier' => 5, 'price' => 499, 'sites' => '50', 'google_keywords' => '100', 'jolley_replies' => '2,000',
		'credits' => '250,000', 'maps_keywords' => '15', 'crawl_pages' => '600,000', 'browser_minutes' => '600',
		'knowledge_bases' => '20', 'maps_profiles' => '3', 'ai_requests' => '5,000', 'reports' => 'Unlimited',
		'active_schedules' => 'Unlimited', 'scheduled_reports' => 'Unlimited', 'team' => 'No fixed seat cap*',
		'woocommerce' => 'Included', 'workflows' => 'Included', 'competitors' => 'Included',
		'white_label' => 'Included', 'priority_support' => 'Included', 'executive_insights' => 'Included',
	),
);

$bf_comparison_rows = array(
	'Licensed websites' => 'sites',
	'Google keyword slots' => 'google_keywords',
	'Agent JOLLEY replies / month' => 'jolley_replies',
	'AI requests / month' => 'ai_requests',
	'Insight Credits / month' => 'credits',
	'Google Maps keyword slots' => 'maps_keywords',
	'Site Audit crawl pages / month' => 'crawl_pages',
	'Browser minutes / month' => 'browser_minutes',
	'Knowledge bases' => 'knowledge_bases',
	'Local (Maps) profiles' => 'maps_profiles',
	'Reports / month' => 'reports',
	'Active report schedules' => 'active_schedules',
	'Scheduled reports' => 'scheduled_reports',
	'Teammates' => 'team',
	'WooCommerce analytics' => 'woocommerce',
	'Custom workflow builder' => 'workflows',
	'AI competitor insights' => 'competitors',
	'White-label reports' => 'white_label',
	'Priority support' => 'priority_support',
  'Executive insights' => 'executive_insights',
);
$bf_from_price = $bf_promo_active ? number_format( $bf_tiers[0]['price'] * 0.9, 2, '.', ',' ) : number_format( $bf_tiers[0]['price'], 0, '.', ',' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Insightistic Lifetime Deal: Meet Agent JOLLEY</title>
<meta name="description" content="Meet Agent JOLLEY in Insightistic Version 3: track AI visibility, Google and Maps rankings, and site health, then review evidence-based fixes. Compare five AppSumo lifetime tiers." />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<link rel="canonical" href="https://www.insightistic.com/blackfriday/" />

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:title" content="Insightistic Lifetime Deal: Meet Agent JOLLEY" />
<meta property="og:description" content="Meet Agent JOLLEY in Insightistic Version 3: track AI visibility, Google and Maps rankings, and site health, then review evidence-based fixes. Compare five AppSumo lifetime tiers." />
<meta property="og:url" content="https://www.insightistic.com/blackfriday/" />
<meta property="og:site_name" content="Insightistic" />
<meta property="og:locale" content="en_US" />
<meta property="og:image" content="https://www.insightistic.com/wp-content/uploads/2026/11/Insightistic_-Turn-Data-Into-Growth-1-1024x576.png" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="576" />
<meta property="og:image:alt" content="Insightistic Version 3 analytics and Agent JOLLEY dashboard illustration" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="https://www.insightistic.com/wp-content/uploads/2026/11/Insightistic_-Turn-Data-Into-Growth-1-1024x576.png" />
<meta name="twitter:image:alt" content="Insightistic Version 3 analytics and Agent JOLLEY dashboard illustration" />
<meta name="twitter:title" content="Insightistic Lifetime Deal: Meet Agent JOLLEY" />
<meta name="twitter:description" content="Meet Agent JOLLEY in Insightistic Version 3: track AI visibility, Google and Maps rankings, and site health, then review evidence-based fixes. Compare five AppSumo lifetime tiers." />

<!-- Fonts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5.0.0/index.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/space-grotesk@5.0.0/index.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/jetbrains-mono@5.0.0/index.css" />

<link rel="stylesheet" href="<?php echo esc_url( plugins_url( 'landing.css', __FILE__ ) ); ?>?ver=1.1.0" />

<!-- Schema.org Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Insightistic Lifetime Deal: Meet Agent JOLLEY",
  "url": "https://www.insightistic.com/blackfriday/",
  "dateModified": "2026-11-28",
  "description": "Meet Agent JOLLEY in Insightistic Version 3: track AI visibility, Google and Maps rankings, and site health, then review evidence-based fixes. Compare five AppSumo lifetime tiers.",
  "about": {
    "@type": "SoftwareApplication",
    "name": "Insightistic",
    "url": "https://www.insightistic.com/",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "Web",
    "sameAs": "https://appsumo.com/products/insightistic-ai-business-intelligence/",
    "publisher": {
      "@type": "Organization",
      "name": "WordPressistic LLC",
      "url": "https://wordpressistic.com/"
    }
  }
}
</script>
<noscript><style>.reveal{opacity:1!important;transform:none!important}
  .bf-table-wrap{overflow-x:auto;border:1px solid rgba(255,255,255,.12);border-radius:1rem}
  .bf-table{min-width:68rem;width:100%;border-collapse:collapse}
  .bf-table th,.bf-table td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid rgba(255,255,255,.08);vertical-align:top}
  .bf-table thead th{color:#FFD66B;background:#0b0d14;font-size:.8rem;white-space:nowrap}
  .bf-table tbody th{color:#fff;font-weight:600;white-space:nowrap}
  .bf-table tbody td{color:rgba(255,255,255,.78)}
  .bf-table tbody tr:nth-child(even){background:rgba(255,255,255,.025)}
  .bf-source-links a{color:#FFD66B;text-decoration:underline;text-underline-offset:3px}
  .bf-source-links a:hover{color:#fff}
  @media(max-width:640px){.bf-table th,.bf-table td{padding:.65rem .75rem}.bf-table-wrap{border-radius:.75rem}}
</style></noscript>
<style>
  :root{
    --bg:#05060a;
    --bg-2:#0b0d14;
    --gold:#FFD66B;
    --gold-2:#FFB800;
    --red:#FF2D55;
    --red-2:#FF5E3A;
    --cyan:#4EE2EC;
    --text:#E9ECF1;
    --muted:#9AA3B2;
    --site-header-height:96px;
  }
  *{box-sizing:border-box}
  html{scroll-behavior:smooth;scroll-padding-top:calc(var(--site-header-height) + .75rem)}
  body{
    font-family:'Inter',system-ui,sans-serif;
    background:var(--bg);
    color:var(--text);
    max-width:100vw;
    margin:0;
  }
  h1,h2,h3,h4{font-family:'Space Grotesk',sans-serif;letter-spacing:-0.02em}
  .mono{font-family:'JetBrains Mono',monospace}

  /* Animated gradient background */
  .bg-aurora{
    background:
      radial-gradient(1200px 600px at 10% -10%, rgba(255,45,85,.18), transparent 60%),
      radial-gradient(900px 500px at 90% 10%, rgba(255,184,0,.15), transparent 60%),
      radial-gradient(700px 500px at 50% 100%, rgba(78,226,236,.10), transparent 60%),
      linear-gradient(180deg,#05060a 0%, #080a12 100%);
  }
  .grid-overlay{
    background-image:
      linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size:48px 48px;
    mask-image: radial-gradient(ellipse at center, black 40%, transparent 80%);
  }
  .gold-text{
    background:linear-gradient(135deg,#FFD66B 0%,#FFB800 40%,#FF9500 100%);
    -webkit-background-clip:text;background-clip:text;color:transparent;
  }
  .red-text{
    background:linear-gradient(135deg,#FF5E3A,#FF2D55);
    -webkit-background-clip:text;background-clip:text;color:transparent;
  }
  .btn-primary{
    background:linear-gradient(135deg,#FF2D55,#FF5E3A);
    box-shadow:0 10px 30px -10px rgba(255,45,85,.6), inset 0 1px 0 rgba(255,255,255,.2);
    transition:transform .2s ease, box-shadow .2s ease;
  }
  .btn-primary:hover{transform:translateY(-2px);box-shadow:0 18px 40px -10px rgba(255,45,85,.7)}
  .btn-gold{
    background:linear-gradient(135deg,#FFD66B,#FFB800);
    color:#1a1200;
    box-shadow:0 10px 30px -10px rgba(255,184,0,.5), inset 0 1px 0 rgba(255,255,255,.4);
    transition:transform .2s ease;
  }
  .btn-gold:hover{transform:translateY(-2px)}
  .card{
    background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.015));
    border:1px solid rgba(255,255,255,.08);
    backdrop-filter:blur(10px);
    border-radius:20px;
  }
  .card-glow{
    position:relative;
  }
  .card-glow::before{
    content:"";position:absolute;inset:-1px;border-radius:inherit;padding:1px;
    background:linear-gradient(135deg,rgba(255,184,0,.5),rgba(255,45,85,.3),rgba(78,226,236,.3));
    -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
    -webkit-mask-composite:xor;mask-composite:exclude;
    pointer-events:none;
  }

  /* Floating particles */
  .particle{position:absolute;border-radius:50%;filter:blur(1px);animation:floatUp linear infinite;opacity:.6}
  @keyframes floatUp{
    0%{transform:translateY(0) translateX(0);opacity:0}
    10%{opacity:.8}
    90%{opacity:.6}
    100%{transform:translateY(-100vh) translateX(40px);opacity:0}
  }

  /* Agent Jolley SVG animations */
  .jolley-float{animation:jolleyFloat 4s ease-in-out infinite}
  @keyframes jolleyFloat{
    0%,100%{transform:translateY(0)}
    50%{transform:translateY(-14px)}
  }
  .eye-pulse{animation:eyePulse 2.2s ease-in-out infinite}
  @keyframes eyePulse{
    0%,100%{filter:drop-shadow(0 0 6px #4EE2EC)}
    50%{filter:drop-shadow(0 0 18px #4EE2EC)}
  }
  .scan-line{animation:scanMove 3s ease-in-out infinite}
  @keyframes scanMove{
    0%,100%{transform:translateY(-8px);opacity:.3}
    50%{transform:translateY(8px);opacity:.9}
  }
  .orbit{animation:spin 14s linear infinite;transform-origin:center}
  .orbit-rev{animation:spin 20s linear infinite reverse;transform-origin:center}
  @keyframes spin{to{transform:rotate(360deg)}}
  .data-blink{animation:blink 1.4s ease-in-out infinite}
  @keyframes blink{0%,100%{opacity:.3}50%{opacity:1}}
  .wave-hand{animation:wave 2.4s ease-in-out infinite;transform-origin:70% 70%}
  @keyframes wave{
    0%,100%{transform:rotate(0deg)}
    25%{transform:rotate(-12deg)}
    75%{transform:rotate(12deg)}
  }
  .glow-ring{animation:ringPulse 3s ease-in-out infinite}
  @keyframes ringPulse{
    0%,100%{opacity:.2;transform:scale(1)}
    50%{opacity:.7;transform:scale(1.05)}
  }

  /* Scroll reveal */
  .reveal{opacity:0;transform:translateY(30px);transition:all .8s cubic-bezier(.2,.7,.2,1)}
  .reveal.in{opacity:1;transform:none}

  /* Marquee */
  .marquee{display:flex;gap:3rem;animation:marquee 30s linear infinite}
  @keyframes marquee{to{transform:translateX(-50%)}}
  @media (max-width:639px), (prefers-reduced-motion:reduce){
    .marquee{justify-content:center;flex-wrap:wrap;gap:.5rem 1rem;padding-inline:1rem;text-align:center;font-size:.875rem;white-space:normal;animation:none}
    .marquee > [aria-hidden="true"]{display:none}
  }

  /* Countdown */
  .cd-box{
    background:linear-gradient(180deg,rgba(255,255,255,.06),rgba(255,255,255,.02));
    border:1px solid rgba(255,255,255,.1);
    border-radius:14px;
  }

  /* Pricing popular */
  .popular{
    background:linear-gradient(180deg,rgba(255,184,0,.08),rgba(255,45,85,.04));
    border:1px solid rgba(255,184,0,.35);
  }

  /* FAQ */
  details summary{cursor:pointer;list-style:none}
  details summary::-webkit-details-marker{display:none}
  details[open] .chev{transform:rotate(180deg)}
  .chev{transition:transform .3s}

  /* Progress bar animation */
  .bar-fill{animation:fillBar 2s ease-out forwards}
  @keyframes fillBar{from{width:0}}

  /* Noise overlay */
  .noise::after{
    content:"";position:fixed;inset:0;pointer-events:none;opacity:.04;z-index:1;
    background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='200' height='200'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.9'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
  }

  /* Ticker */
  .ticker-badge{
    background:linear-gradient(90deg,#FF2D55,#FF5E3A);
    animation:pulseBadge 2s ease-in-out infinite;
  }
  @keyframes pulseBadge{
    0%,100%{box-shadow:0 0 0 0 rgba(255,45,85,.5)}
    50%{box-shadow:0 0 0 12px rgba(255,45,85,0)}
  }

  /* Mobile */
  .page-menu-panel{
    max-height:calc(100vh - var(--site-header-height));
    max-height:calc(100dvh - var(--site-header-height));
    overflow-y:auto;
  }
  .page-menu summary::-webkit-details-marker{display:none}
  @media (max-width:767px){
    .hero-title{font-size:clamp(2rem, 9vw, 2.4rem)}
    body > section.py-24{padding-block:4rem}
    #tier-comparison .tier-table thead{
      position:absolute;
      width:1px;height:1px;
      overflow:hidden;
      clip:rect(0,0,0,0);
      white-space:nowrap;
    }
    #tier-comparison .tier-table,
    #tier-comparison .tier-table tbody{display:block}
    #tier-comparison .tier-table tbody tr{
      display:grid;
      grid-template-columns:repeat(2,minmax(0,1fr));
      padding:1rem;
      gap:.625rem;
    }
    #tier-comparison .tier-table tbody th{
      grid-column:1/-1;
      padding:0 0 .25rem;
    }
    #tier-comparison .tier-table tbody td{
      padding:.5rem;
      overflow-wrap:anywhere;
      border-radius:.5rem;
      background:rgba(255,255,255,.05);
    }
  }
  @media (prefers-reduced-motion:reduce){
    html{scroll-behavior:auto}
    *,*::before,*::after{animation:none!important;transition:none!important}
  }
</style>
</head>
<body class="noise">
<a class="sr-only" href="#main">Skip to content</a>

<header id="site-header" class="sticky top-0 z-50">
<!-- ================= TOP PROMO BAR ================= -->
<div class="bg-gradient-to-r from-[#FF2D55] via-[#FF5E3A] to-[#FFB800] text-white">
  <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between gap-2 text-sm font-medium">
    <div class="flex items-center gap-2">
      <span class="ticker-badge px-2 py-0.5 rounded-md text-xs font-bold uppercase tracking-wider">Deal</span>
      <span class="hidden sm:inline">Black Friday lifetime licenses on AppSumo</span>
      <span class="sm:hidden">Black Friday deal</span>
    </div>
    <div class="flex items-center gap-3 mono text-xs shrink-0">
      <a href="#pricing" class="font-bold hover:underline">See tiers →</a>
    </div>
  </div>
</div>

<!-- ================= NAV ================= -->
<nav class="relative backdrop-blur-xl bg-black/80 border-b border-white/5" aria-label="Page navigation">
  <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between gap-3">
    <a href="https://www.insightistic.com" class="flex shrink-0 items-center gap-2 font-bold text-lg">
      <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
        <defs><linearGradient id="lg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#FFD66B"/><stop offset="1" stop-color="#FF2D55"/></linearGradient></defs>
        <rect x="2" y="2" width="28" height="28" rx="8" fill="url(#lg)"/>
        <path d="M9 22 L9 14 M14 22 L14 10 M19 22 L19 16 M24 22 L24 8" stroke="#05060a" stroke-width="2.5" stroke-linecap="round"/>
      </svg>
      <span>Insightistic</span>
    </a>
    <div class="hidden md:flex items-center gap-4 lg:gap-7 text-sm text-white/70">
      <a href="#agent-jolley" class="hover:text-white transition">Agent JOLLEY</a>
      <a href="#features" class="hover:text-white transition">Features</a>
      <a href="#how" class="hover:text-white transition">How it Works</a>
      <a href="#compare-tools" class="hover:text-white transition">Compare tools</a>
      <a href="#pricing" class="hover:text-white transition">Pricing</a>
      <a href="#faq" class="hover:text-white transition">FAQ</a>
    </div>
    <div class="flex shrink-0 items-center gap-2">
      <a href="#pricing" class="btn-primary inline-flex items-center min-h-[44px] text-white text-sm font-semibold px-3 lg:px-4 py-2 rounded-xl">
        <span class="md:hidden">Tiers</span><span class="hidden md:inline">Compare tiers →</span>
      </a>
      <details class="page-menu md:hidden">
        <summary class="grid w-11 h-11 place-items-center cursor-pointer list-none rounded-xl border border-white/20">
          <span class="sr-only">Page menu</span><span aria-hidden="true">☰</span>
        </summary>
        <div class="page-menu-panel absolute inset-x-0 top-full bg-[#0b0d14] border-y border-white/15 px-4 py-2 text-sm text-white/90">
          <a href="#agent-jolley" class="flex items-center min-h-[44px] py-2">Agent JOLLEY</a>
          <a href="#features" class="flex items-center min-h-[44px] py-2">Features</a>
          <a href="#how" class="flex items-center min-h-[44px] py-2">How it works</a>
          <a href="#compare-tools" class="flex items-center min-h-[44px] py-2">Compare tools</a>
          <a href="#pricing" class="flex items-center min-h-[44px] py-2">Pricing</a>
          <a href="#faq" class="flex items-center min-h-[44px] py-2">FAQ</a>
        </div>
      </details>
    </div>
  </div>
</nav>
</header>

<main id="main">
  <!-- HERO -->
  <section class="relative bg-aurora overflow-hidden">
    <div class="absolute inset-0 grid-overlay" aria-hidden="true"></div>
    <div class="relative max-w-7xl mx-auto px-4 pt-14 pb-20 grid lg:grid-cols-2 gap-10 items-center">
      <div class="reveal">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-yellow-400/30 bg-yellow-400/5 text-yellow-300 text-xs font-semibold mb-5">
          <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse" aria-hidden="true"></span>
          <?php if ( $bf_promo_active ) : ?>
            BLACK FRIDAY · APPSUMO · 10% OFF
          <?php else : ?>
            AGENT JOLLEY · APPSUMO LIFETIME DEAL
          <?php endif; ?>
        </div>
        <h1 class="text-5xl md:text-6xl font-black leading-[1.02] mb-5">
          Meet <span class="gold-text">Agent JOLLEY.</span><br/>
          <span class="red-text">Your AI business manager.</span>
        </h1>
        <p class="text-lg text-white/70 max-w-xl mb-7 leading-relaxed">
          Insightistic Version 3 brings AI visibility, Google and Maps rankings, Site Audit, PageSpeed, uptime, SSL, and optional WordPress or WooCommerce data together. JOLLEY briefs you each morning, answers supported questions about Site Audit and PageSpeed results with evidence, and waits for your approval before a supported fix runs.
        </p>
        <div class="flex flex-wrap gap-3 mb-6">
          <a href="#pricing" class="btn-primary text-white font-semibold px-6 py-3.5 rounded-xl inline-flex items-center gap-2">
            Compare five AppSumo tiers <span aria-hidden="true">→</span>
          </a>
          <a href="#agent-jolley" class="px-6 py-3.5 rounded-xl border border-white/15 hover:border-white/30 transition font-semibold inline-flex items-center gap-2">
            See how JOLLEY works
          </a>
        </div>
        <p class="text-sm text-white/65 leading-relaxed">
          <?php if ( $bf_promo_active ) : ?>
            AppSumo applies the 10% Black Friday discount automatically through December 1, 2026 at 12:00 p.m. CT. Plus members receive 19% off under the promotion. Cards show standard 10%-off prices before tax; checkout confirms the final total.
          <?php else : ?>
            Check AppSumo for current tier prices, promotions, taxes, and deal terms.
          <?php endif; ?>
        </p>
        <div class="flex flex-wrap gap-4 mt-6 text-sm text-white/60">
          <span><strong class="text-white">One-time</strong> license payment</span>
          <span><strong class="text-white">5–50</strong> licensed websites</span>
          <span><strong class="text-white">60 days</strong> AppSumo refund window shown on the listing</span>
        </div>
      </div>
      <div class="reveal">
        <div class="card card-glow p-6 md:p-8">
          <div class="flex items-center justify-between gap-3 mb-5">
            <div>
              <p class="mono text-[10px] uppercase tracking-widest text-yellow-300">Illustrative example</p>
              <h2 class="text-2xl font-bold mt-2">JOLLEY’s morning brief</h2>
            </div>
            <span class="w-11 h-11 rounded-xl bg-yellow-400/10 border border-yellow-400/30 grid place-items-center text-xl" aria-hidden="true">✦</span>
          </div>
          <div class="space-y-3">
            <div class="rounded-xl border border-white/10 bg-black/30 p-4">
              <p class="text-xs uppercase tracking-wider text-white/50 mb-2">What changed</p>
              <p class="text-white/85 text-sm">Review a change in SEO, AI visibility, site health, or connected analytics.</p>
            </div>
            <div class="rounded-xl border border-cyan-400/20 bg-cyan-400/10 p-4">
              <p class="text-xs uppercase tracking-wider text-cyan-300 mb-2">Evidence</p>
              <p class="text-white/85 text-sm">Open the cited report or measurement to check the date range and source.</p>
            </div>
            <div class="rounded-xl border border-yellow-400/20 bg-yellow-400/5 p-4">
              <p class="text-xs uppercase tracking-wider text-yellow-300 mb-2">Your decision</p>
              <p class="text-white/85 text-sm">Review the proposed fix and its evidence. JOLLEY waits for approval, then records an activity receipt and audit entry.</p>
            </div>
          </div>
          <p class="mono text-[10px] text-white/40 mt-4">EXAMPLE ONLY · RESULTS DEPEND ON YOUR CONNECTED SOURCES</p>
        </div>
      </div>
    </div>
  </section>

  <!-- AGENT JOLLEY -->
  <section id="agent-jolley" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12 reveal">
        <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">Version 3 · Agent JOLLEY</p>
        <h2 class="text-4xl md:text-5xl font-black mb-4">From business signals to <span class="gold-text">reviewable next steps</span></h2>
        <p class="text-white/65 text-lg">JOLLEY watches your connected SEO, AI visibility, analytics, and site-health signals, then delivers a morning brief. Ask about a completed Site Audit and mobile or desktop PageSpeed results, follow citations to the source, and approve supported fixes before anything changes.</p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
        <article class="card p-6">
          <p class="text-2xl mb-4" aria-hidden="true">☀️</p>
          <h3 class="text-lg font-bold mb-2">Start with a brief</h3>
          <p class="text-white/60 text-sm leading-relaxed">Get a morning brief highlighting changes and the decision that may need your attention.</p>
        </article>
        <article class="card p-6">
          <p class="text-2xl mb-4" aria-hidden="true">🔎</p>
          <h3 class="text-lg font-bold mb-2">Follow the evidence</h3>
          <p class="text-white/60 text-sm leading-relaxed">Ask about completed Site Audits and PageSpeed results, then open the cited measurements behind an answer.</p>
        </article>
        <article class="card p-6">
          <p class="text-2xl mb-4" aria-hidden="true">✅</p>
          <h3 class="text-lg font-bold mb-2">Approve supported actions</h3>
          <p class="text-white/60 text-sm leading-relaxed">Review the reason and expected effect before approving a supported fix. Applied changes include an activity receipt, an audit entry, and a one-click rollback.</p>
        </article>
        <article class="card p-6">
          <p class="text-2xl mb-4" aria-hidden="true">📚</p>
          <h3 class="text-lg font-bold mb-2">Add your references</h3>
          <p class="text-white/60 text-sm leading-relaxed">Give JOLLEY business context through workspace knowledge bases. Version 3 can recall workspace decisions and preferences with citations; you can review or remove saved memory.</p>
        </article>
      </div>
      <div class="text-center mt-8">
        <a href="https://www.insightistic.com/ai-insights/" class="text-yellow-300 underline underline-offset-4 hover:text-white">Explore Agent JOLLEY and AI insights on Insightistic →</a>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section id="features" class="py-20 relative bg-gradient-to-b from-transparent via-yellow-500/[.03] to-transparent">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12 reveal">
        <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">One connected workspace</p>
        <h2 class="text-4xl md:text-5xl font-black mb-4">Track your signals. <span class="gold-text">Investigate with context.</span></h2>
        <p class="text-white/65 text-lg">Use the data sources and limits that match each AppSumo tier. Insightistic does not guarantee search rankings or inclusion in AI-generated answers.</p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">AI answer visibility</h3>
          <p class="text-white/60 text-sm leading-relaxed">Track selected prompts and see whether configured AI answers mention your brand, cite your domain, or mention competitors instead. Competitor comparisons start on Tier 3; monthly runs vary by tier.</p>
          <a href="https://www.insightistic.com/ai-insights/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">See AI insights</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">Google search rankings</h3>
          <p class="text-white/60 text-sm leading-relaxed">Track Google rankings to position 100 by country, language, device, or optional city. Keyword limits and check frequency vary by tier; compare results with Search Console and Bing data.</p>
          <a href="https://www.insightistic.com/seo-analytics/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Explore SEO analytics</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">Site Audit</h3>
          <p class="text-white/60 text-sm leading-relaxed">Review broken links, redirects, and on-page findings ranked by priority. Monthly crawl allowances apply, with a maximum of 5,000 URLs per run.</p>
          <a href="https://www.insightistic.com/knowledgebase/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Read setup guides</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">PageSpeed, uptime & SSL</h3>
          <p class="text-white/60 text-sm leading-relaxed">Compare mobile and desktop PageSpeed results, review available Core Web Vitals, and monitor uptime and certificate expiry.</p>
          <a href="https://www.insightistic.com/performance-monitoring/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Explore performance monitoring</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">WooCommerce analytics</h3>
          <p class="text-white/60 text-sm leading-relaxed">Review revenue, orders, refunds, products, and customers on Tiers 2–5. The optional free WordPress connector supplies WordPress and store data.</p>
          <a href="https://www.insightistic.com/woocommerce-analytics/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Explore WooCommerce analytics</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">Reports and workflows</h3>
          <p class="text-white/60 text-sm leading-relaxed">Schedule reports and download PDF or HTML versions. Custom workflows start on Tier 2; report and schedule limits vary by tier.</p>
          <a href="https://www.insightistic.com/ai-insights/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">See reporting</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">Workspace memory and knowledge</h3>
          <p class="text-white/60 text-sm leading-relaxed">Add reference material to knowledge bases and let JOLLEY use workspace context with citations. You can review saved memory and remove it.</p>
          <a href="https://www.insightistic.com/ai-insights/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Explore AI insights</a>
        </article>
        <article class="card p-6">
          <h3 class="text-xl font-bold mb-2">Scoped MCP connection</h3>
          <p class="text-white/60 text-sm leading-relaxed">Connect an MCP client with a site-bound, revocable token. Scoped tools and an audit trail keep access under your control.</p>
          <a href="https://www.insightistic.com/features/" class="inline-block mt-4 text-yellow-300 underline underline-offset-4">Explore product features</a>
        </article>
      </div>
      <div class="card card-glow p-6 md:p-8 mt-8">
        <h3 class="text-xl font-bold mb-3">Connections for WordPress and other websites</h3>
        <p class="text-white/65 text-sm leading-relaxed">Direct connections include Google Analytics 4, Google Search Console, Bing Webmaster Tools, and Cloudflare. Site Audit, PageSpeed, uptime checks, rank tracking, and AI visibility provide their own measurements. WordPress and WooCommerce data use the optional free connector; WooCommerce analytics is included from Tier 2.</p>
        <div class="flex flex-wrap gap-x-5 gap-y-2 mt-4 text-sm bf-source-links">
          <a href="https://www.insightistic.com/integrations/">Insightistic integrations</a>
          <a href="https://support.google.com/webmasters/answer/7451491?hl=en" target="_blank" rel="noopener">Google Search Console reference</a>
          <a href="https://support.google.com/analytics/answer/14183469?hl=en" target="_blank" rel="noopener">Google Analytics 4 reference</a>
          <a href="https://woocommerce.com/document/woocommerce-analytics/" target="_blank" rel="noopener">WooCommerce Analytics reference</a>
          <a href="https://developers.cloudflare.com/analytics/" target="_blank" rel="noopener">Cloudflare Analytics reference</a>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section id="pricing" class="py-24 relative bg-gradient-to-b from-transparent via-yellow-500/[.04] to-transparent">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12 reveal">
        <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">AppSumo lifetime deal</p>
        <h2 class="text-4xl md:text-5xl font-black mb-4">Five tiers. <span class="gold-text">One-time payment.</span></h2>
        <p class="text-white/65 text-lg">Choose a tier by licensed sites and monthly allowances. The purchase does not renew; usage allowances reset each month.</p>
        <?php if ( $bf_promo_active ) : ?>
          <p class="mt-4 text-yellow-300 font-semibold">10% off automatically through December 1, 2026 at 12:00 p.m. CT. AppSumo Plus members receive 19% off.</p>
        <?php endif; ?>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
        <?php foreach ( $bf_tiers as $bf_tier ) :
          $bf_display_price = $bf_promo_active ? round( $bf_tier['price'] * 0.9, 2 ) : $bf_tier['price'];
          $bf_price_decimals = $bf_promo_active ? 2 : 0;
          ?>
          <article class="card p-6 flex flex-col">
            <p class="text-xs uppercase tracking-widest text-white/50 mb-2">Insightistic AppSumo lifetime license</p>
            <h3 class="text-2xl font-bold mb-2">Tier <?php echo esc_html( (string) $bf_tier['tier'] ); ?></h3>
            <p class="text-white/60 text-sm mb-4"><?php echo esc_html( $bf_tier['sites'] ); ?> licensed websites</p>
            <div class="flex items-baseline gap-2 mb-2">
              <span class="text-4xl font-black gold-text">$<?php echo esc_html( number_format( $bf_display_price, $bf_price_decimals, '.', ',' ) ); ?></span>
              <span class="text-white/60 text-sm">one-time</span>
            </div>
            <?php if ( $bf_promo_active ) : ?>
              <p class="text-xs text-white/55 mb-4"><del>$<?php echo esc_html( number_format( $bf_tier['price'], 0, '.', ',' ) ); ?></del> standard price · 10% off</p>
            <?php else : ?>
              <p class="text-xs text-white/55 mb-4">Standard AppSumo price before tax. Plus members receive the published 19% promotion discount; checkout confirms the final total.</p>
            <?php endif; ?>
            <ul class="space-y-2 text-sm text-white/75 mb-6 flex-1">
              <li>✓ <?php echo esc_html( $bf_tier['jolley_replies'] ); ?> Agent JOLLEY replies/month</li>
              <li>✓ <?php echo esc_html( $bf_tier['credits'] ); ?> Insight Credits/month</li>
              <li>✓ <?php echo esc_html( $bf_tier['ai_requests'] ); ?> AI requests/month</li>
              <li>✓ <?php echo esc_html( $bf_tier['google_keywords'] ); ?> Google keywords · <?php echo esc_html( $bf_tier['maps_keywords'] ); ?> Google Maps keywords</li>
              <?php if ( 1 < (int) $bf_tier['tier'] ) : ?>
                <li>✓ WooCommerce analytics</li>
              <?php endif; ?>
            </ul>
            <a href="<?php echo esc_url( $bf_appsumo_url ); ?>" rel="sponsored noopener" target="_top" data-deal-placement="tier_<?php echo esc_attr( (string) $bf_tier['tier'] ); ?>" class="btn-gold text-center font-bold py-3 rounded-xl">
              Compare Tier <?php echo esc_html( (string) $bf_tier['tier'] ); ?> on AppSumo →
            </a>
          </article>
        <?php endforeach; ?>
      </div>

      <h3 class="text-2xl font-bold mb-4">Compare every tier allowance</h3>
      <p class="text-sm text-white/55 mb-4">The AppSumo listing is authoritative for current availability, terms, and checkout totals. Displayed prices are before taxes.</p>
      <div class="bf-table-wrap" role="region" aria-label="AppSumo lifetime tier comparison table" tabindex="0">
        <table class="bf-table">
          <thead>
            <tr>
              <th scope="col">Plan allowance</th>
              <?php foreach ( $bf_tiers as $bf_tier ) : ?>
                <th scope="col">Tier <?php echo esc_html( (string) $bf_tier['tier'] ); ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $bf_comparison_rows as $bf_label => $bf_key ) : ?>
              <tr>
                <th scope="row"><?php echo esc_html( $bf_label ); ?></th>
                <?php foreach ( $bf_tiers as $bf_tier ) : ?>
                  <td><?php echo esc_html( (string) $bf_tier[ $bf_key ] ); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="grid md:grid-cols-2 gap-5 mt-6">
        <div class="card p-5">
          <h3 class="font-bold mb-2">Shared across all tiers</h3>
          <p class="text-white/60 text-sm">AI visibility prompt tracking, Site Audit, PageSpeed Insights, uptime and SSL monitoring, Google and Bing data, GA4, and Cloudflare analytics. Monthly allowances vary by tier.</p>
        </div>
        <div class="card p-5">
          <h3 class="font-bold mb-2">Team seat details</h3>
          <p class="text-white/60 text-sm">Tier 1 supports five teammates plus the workspace owner. Tiers 2–5 have no fixed seat cap. Each added teammate uses 50 Insight Credits once.</p>
        </div>
      </div>
      <p class="text-center text-xs text-white/50 mt-6">WooCommerce analytics starts on Tier 2. Tiers 3–5 add AI competitor insights; Tiers 4–5 add white-label reports, priority support, and Executive insights. The full comparison and current terms are on AppSumo.</p>
    </div>
  </section>

  <!-- INTERNAL RESOURCES -->
  <section class="py-20 relative">
    <div class="max-w-6xl mx-auto px-4">
      <div class="card p-7 md:p-8">
        <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">Explore Insightistic</p>
        <h2 class="text-3xl md:text-4xl font-black mb-4">Learn more about the product</h2>
        <p class="text-white/65 text-sm leading-relaxed mb-5">Use these product pages and setup guides to confirm supported workflows, data sources, and feature details.</p>
        <div class="flex flex-wrap gap-x-5 gap-y-3 text-sm bf-source-links">
          <a href="https://www.insightistic.com/ai-insights/">Agent JOLLEY and AI insights</a>
          <a href="https://www.insightistic.com/seo-analytics/">SEO analytics</a>
          <a href="https://www.insightistic.com/performance-monitoring/">Performance monitoring</a>
          <a href="https://www.insightistic.com/woocommerce-analytics/">WooCommerce analytics</a>
          <a href="https://www.insightistic.com/integrations/">Integrations</a>
          <a href="https://www.insightistic.com/knowledgebase/">Knowledge base</a>
          <a href="https://www.insightistic.com/features/">Product tour</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-24 relative">
    <div class="max-w-4xl mx-auto px-4">
      <div class="text-center mb-12 reveal">
        <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">Before you buy</p>
        <h2 class="text-4xl md:text-5xl font-black mb-4">Straight answers about <span class="gold-text">Agent JOLLEY</span></h2>
      </div>
      <div class="space-y-3">
        <details class="card p-5" open>
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>Is the AppSumo deal a subscription?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">No. Each AppSumo tier is a one-time purchase. Monthly feature and usage allowances renew each month, but the license payment itself does not renew.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>What does Agent JOLLEY do?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">JOLLEY summarizes changes in connected data, answers supported questions with links to available evidence, and can prepare supported actions for you to review. Actions wait for your approval and show an activity receipt.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>Does it guarantee Google rankings or AI citations?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">No. Insightistic tracks the rankings and AI answer mentions or citations available for your configured keywords and prompts. Search engines and AI services decide what they display; tracking does not guarantee a position, mention, or citation.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>Do I need WordPress?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">No. Supported analytics connections, AI visibility, rankings, Site Audit, PageSpeed, uptime, and SSL work for websites without WordPress. WordPress and WooCommerce data use the optional free connector; WooCommerce analytics is included on Tiers 2–5.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>How often are Google rankings checked?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">Every tier tracks Google rankings to position 100. Each keyword gets a full top-100 check about every four weeks, with page-one checks between full checks: every two weeks on Tiers 1–2 and weekly on Tiers 3–5. Rank checks are included and do not use Insight Credits.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>How are Site Audit crawl pages counted?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">The monthly allowance counts URLs processed by the crawler. Each run is capped at 5,000 URLs, and you can set a lower cap for a project.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>How many teammates can I add?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">Tier 1 supports five teammates plus the workspace owner. Tiers 2–5 have no fixed seat cap. Each added teammate uses 50 Insight Credits once.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>How are JOLLEY replies and Insight Credits counted?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">Agent JOLLEY has its own monthly completed-reply allowance for each tier. After that allowance, each answered JOLLEY message uses 10 Insight Credits. AI requests are a separate allowance; eligible overage and other credit-priced actions follow the rates shown in the product.</p>
        </details>
        <details class="card p-5">
          <summary class="flex justify-between items-center gap-4 font-bold cursor-pointer"><span>What are the AppSumo refund and activation terms?</span><span class="text-white/50" aria-hidden="true">⌄</span></summary>
          <p class="text-white/70 text-sm mt-3 leading-relaxed">The current AppSumo listing shows a refund window of up to 60 days and requires activation within 60 days of purchase. Review the listing for current terms and eligibility.</p>
        </details>
      </div>
      <div class="text-center mt-10">
        <a href="<?php echo esc_url( $bf_appsumo_url ); ?>" rel="sponsored noopener" target="_top" class="btn-primary text-white font-bold px-6 py-3.5 rounded-xl inline-flex items-center gap-2">See the AppSumo deal and terms →</a>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="py-20 relative bg-gradient-to-b from-transparent via-pink-500/[.03] to-transparent">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <p class="text-sm uppercase tracking-widest text-yellow-400 mb-3">Insightistic Version 3</p>
      <h2 class="text-4xl md:text-5xl font-black mb-5">Let JOLLEY help you see <span class="gold-text">what changed.</span></h2>
      <p class="text-white/65 text-lg mb-7">Compare the tier limits, connect your sources, and review JOLLEY’s cited evidence before approving a supported fix.</p>
      <a href="<?php echo esc_url( $bf_appsumo_url ); ?>" rel="sponsored noopener" target="_top" class="btn-gold text-black font-bold px-8 py-4 rounded-xl inline-flex items-center gap-2">
        <?php if ( $bf_promo_active ) : ?>
          Get 10% off on AppSumo · from $<?php echo esc_html( $bf_from_price ); ?>
        <?php else : ?>
          Compare AppSumo tiers · from $<?php echo esc_html( $bf_from_price ); ?>
        <?php endif; ?>
      </a>
      <p class="text-xs text-white/45 mt-4">One-time license payment. Monthly allowances renew. AppSumo checkout sets final pricing, taxes, and terms.</p>
    </div>
  </section>
</main>

<footer class="border-t border-white/5 py-14 relative">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-5 gap-10 mb-10">
      <div class="md:col-span-2">
        <a href="https://www.insightistic.com" class="flex items-center gap-2 font-bold text-lg mb-3">
          <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
            <rect x="2" y="2" width="28" height="28" rx="8" fill="url(#lg)"/>
            <path d="M9 22 L9 14 M14 22 L14 10 M19 22 L19 16 M24 22 L24 8" stroke="#05060a" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
          Insightistic
        </a>
        <p class="text-white/50 text-sm max-w-sm">Insightistic is built by <a class="underline hover:text-white" href="https://www.insightistic.com/about/">WordPressistic LLC</a>. See the <a class="underline hover:text-white" href="https://www.insightistic.com/features/">features</a> and the <a class="underline hover:text-white" href="https://wordpress.org/plugins/insightistic/">WordPress connector listing</a>.</p>
        <div class="flex gap-3 mt-4">
          <a href="https://x.com/wordpressistic" aria-label="WordPressistic on X" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center transition">𝕏</a>
          <a href="https://www.linkedin.com/company/wordpressistic/" aria-label="WordPressistic on LinkedIn" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center transition">in</a>
          <a href="https://www.youtube.com/@wordpressistic" aria-label="WordPressistic on YouTube" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center transition">▶</a>
        </div>
      </div>

      <div>
        <h4 class="font-bold mb-3 text-sm">Product</h4>
        <ul class="space-y-2 text-sm text-white/60">
          <li><a href="https://www.insightistic.com/features/" class="hover:text-white">Features</a></li>
          <li><a href="https://www.insightistic.com/ai-insights/" class="hover:text-white">Agent JOLLEY</a></li>
          <li><a href="https://www.insightistic.com/integrations/" class="hover:text-white">Integrations</a></li>
          <li><a href="https://www.insightistic.com/pricing/" class="hover:text-white">Pricing</a></li>
          <li><a href="https://www.insightistic.com/changelog/" class="hover:text-white">Changelog</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-bold mb-3 text-sm">Resources</h4>
        <ul class="space-y-2 text-sm text-white/60">
          <li><a href="https://www.insightistic.com/blog/" class="hover:text-white">Blog</a></li>
          <li><a href="https://www.insightistic.com/knowledgebase/" class="hover:text-white">Knowledge base</a></li>
          <li><a href="https://www.insightistic.com/features/" class="hover:text-white">Product tour</a></li>
          <li><a href="https://www.insightistic.com/ai-insights/" class="hover:text-white">Reports</a></li>
          <li><a href="https://www.insightistic.com/contact/" class="hover:text-white">Contact support</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-bold mb-3 text-sm">Deals</h4>
        <ul class="space-y-2 text-sm text-white/60">
          <li><a href="https://www.insightistic.com/blackfriday/" class="text-yellow-400 font-semibold">Black Friday deal</a></li>
          <li><a href="https://appsumo.com/pl/insightistic-ai-business-intelligence-ga/" rel="sponsored" data-deal-placement="footer_deal" class="hover:text-white">AppSumo Deal Page</a></li>
          <li><a href="https://www.insightistic.com/ltd/" class="hover:text-white">Lifetime deal guide</a></li>
          <li><a href="https://www.insightistic.com/agency/" class="hover:text-white">Agency workflows</a></li>
        </ul>
      </div>
    </div>

    <!-- Related product resources -->
    <div class="border-t border-white/5 pt-6 mb-6">
      <p class="text-xs uppercase tracking-widest text-white/40 mb-3">Related Resources</p>
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-xs text-white/50">
        <a href="https://appsumo.com/pl/insightistic-ai-business-intelligence-ga/" rel="sponsored" data-deal-placement="footer_resources" class="hover:text-white">Insightistic on AppSumo</a>
        <a href="https://www.insightistic.com/integrations/" class="hover:text-white">Supported integrations</a>
        <a href="https://www.insightistic.com/woocommerce-analytics/" class="hover:text-white">WooCommerce analytics</a>
        <a href="https://www.insightistic.com/seo-analytics/" class="hover:text-white">SEO analytics</a>
        <a href="https://www.insightistic.com/performance-monitoring/" class="hover:text-white">Performance monitoring</a>
        <a href="https://www.insightistic.com/knowledgebase/" class="hover:text-white">Setup guides</a>
      </div>
    </div>

    <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-white/40">
      <p>© 2026 WordPressistic LLC. All rights reserved.</p>
      <div class="flex flex-wrap justify-center gap-x-5 gap-y-2">
        <a href="https://www.insightistic.com/privacy-policy/" class="hover:text-white">Privacy</a>
        <a href="https://www.insightistic.com/terms/" class="hover:text-white">Terms</a>
        <a href="https://www.insightistic.com/about/" class="hover:text-white">About</a>
        <a href="https://www.insightistic.com/sitemap/" class="hover:text-white">Sitemap</a>
      </div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-4 mt-4 text-center text-xs text-white/60">
    <button type="button" id="measurement-preferences-link" class="underline hover:text-white" hidden>Tracking choices</button>
  </div>
</footer>

<aside id="measurement-preferences" class="fixed inset-x-3 bottom-3 sm:left-auto sm:right-5 sm:max-w-md z-[60] card bg-[#0b0d14] p-5 shadow-2xl max-h-[80vh] overflow-y-auto" aria-labelledby="measurement-preferences-title" hidden>
  <h2 id="measurement-preferences-title" class="text-lg font-bold">Optional tracking</h2>
  <p class="text-sm text-white/70 mb-3">Choose whether to allow analytics or advertising measurement on this page. <a class="underline" href="https://www.insightistic.com/cookies/">Cookie policy</a></p>
  <form class="grid gap-2">
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="analytics"> Analytics and site experience</label>
    <?php if ( insightistic_blackfriday_container_id() || insightistic_blackfriday_google_ads_destination() ) : ?>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="ads"> Advertising measurement</label>
    <?php else : ?>
    <input type="checkbox" name="ads" hidden>
    <?php endif; ?>
    <div class="flex flex-wrap gap-2 mt-2">
      <button type="submit" value="reject" class="rounded-xl px-3 py-2 text-sm border border-white/30">Reject optional</button>
      <button type="submit" value="save" class="btn-gold rounded-xl px-3 py-2 text-sm font-bold">Save choices</button>
    </div>
  </form>
</aside>
<script defer src="<?php echo esc_url( plugins_url( 'measurement.js', __FILE__ ) ); ?>?ver=1.1.0"
  data-container="<?php echo esc_attr( insightistic_blackfriday_container_id() ); ?>"
  data-google-ads="<?php echo esc_attr( insightistic_blackfriday_google_ads_destination() ); ?>"
  data-meta-pixel="<?php echo esc_attr( insightistic_blackfriday_meta_pixel_id() ); ?>"
  data-privatus="pa_CLZCVGORNU"
  data-clarity="<?php echo esc_attr( insightistic_blackfriday_clarity_id() ); ?>"></script>

<script>
  const siteHeader = document.getElementById("site-header");
  const pageMenu = siteHeader.querySelector(".page-menu");
  function syncHeaderHeight() {
    document.documentElement.style.setProperty("--site-header-height", siteHeader.offsetHeight + "px");
  }
  syncHeaderHeight();
  if ("ResizeObserver" in window) {
    new ResizeObserver(syncHeaderHeight).observe(siteHeader);
  } else {
    window.addEventListener("resize", syncHeaderHeight);
  }
  siteHeader.addEventListener("click", (event) => {
    if (event.target.closest("a[href^='#']")) pageMenu.open = false;
  });
  document.addEventListener("click", (event) => {
    if (pageMenu.open && !pageMenu.contains(event.target)) pageMenu.open = false;
  });
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && pageMenu.open) {
      pageMenu.open = false;
      pageMenu.querySelector("summary").focus();
    }
  });

  // Keep content visible before animation support is available.
  const revealItems = document.querySelectorAll(".reveal");
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if ("IntersectionObserver" in window && !reduceMotion) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("in");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealItems.forEach((item) => observer.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add("in"));
  }

  // Floating particles
  const pc = document.getElementById("particles");
  const colors = ["#FFD66B","#FF2D55","#4EE2EC","#FF5E3A"];
  for(let i=0;!reduceMotion && pc && i<30;i++){
    const p = document.createElement("div");
    p.className = "particle";
    const size = Math.random()*4+2;
    p.style.width = size+"px";
    p.style.height = size+"px";
    p.style.background = colors[Math.floor(Math.random()*colors.length)];
    p.style.left = Math.random()*100+"%";
    p.style.bottom = "-20px";
    p.style.animationDuration = (Math.random()*15+10)+"s";
    p.style.animationDelay = (Math.random()*10)+"s";
    pc.appendChild(p);
  }
</script>
</body>
</html>

