(() => {
  const config = document.currentScript.dataset;
  const layer = window.dataLayer = window.dataLayer || [];
  const googleAdsDestination = config.googleAds;
  const metaPixelId = config.metaPixel;
  const storageKey = 'insightistic_blackfriday_consent_v1';
  const preferences = document.querySelector('#measurement-preferences');
  const openPreferences = document.querySelector('#measurement-preferences-link');
  let consent = { analytics: false, ads: false };
  let tagManagerLoaded = false;
  let googleAdsLoaded = false;
  let metaPixelLoaded = false;
  let clarityLoaded = false;
  let privatusLoaded = false;
  let landingViewSent = false;
  let contentEngagedSent = false;
  let pricingViewSent = false;
  let compareToolsViewSent = false;

  function campaignContext() {
    const params = new URLSearchParams(window.location.search);
    const keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
    return keys.reduce((context, key) => {
      const value = params.get(key);
      if (value) context[key] = value.slice(0, 120);
      return context;
    }, {});
  }

  function pushEvent(name, details = {}) {
    if (!consent.analytics && !consent.ads) return;
    layer.push({
      event: name,
      page_path: window.location.pathname,
      page_title: document.title,
      ...campaignContext(),
      ...details,
      analytics_consent: consent.analytics,
      advertising_consent: consent.ads
    });
  }

  function sendLandingSignals() {
    if (!landingViewSent && (consent.analytics || consent.ads)) {
      landingViewSent = true;
      pushEvent('landing_view', { landing_name: 'blackfriday' });
      pushEvent('blackfriday_view', { landing_name: 'blackfriday' });
    }
  }

  function gtag() {
    layer.push(arguments);
  }

  function googleConsent(action) {
    gtag('consent', action, {
      analytics_storage: consent.analytics ? 'granted' : 'denied',
      ad_storage: consent.ads ? 'granted' : 'denied',
      ad_user_data: consent.ads ? 'granted' : 'denied',
      ad_personalization: 'denied'
    });
  }

  function applyConsent() {
    googleConsent('update');
    layer.push({
      event: 'insightistic_consent_updated',
      analytics_consent: consent.analytics,
      advertising_consent: consent.ads
    });
    sendLandingSignals();
    if (!tagManagerLoaded && config.container && (consent.analytics || consent.ads)) {
      tagManagerLoaded = true;
      layer.push({ 'gtm.start': Date.now(), event: 'gtm.js' });
      const script = document.createElement('script');
      script.async = true;
      script.src = 'https://www.googletagmanager.com/gtm.js?id=' + encodeURIComponent(config.container);
      document.head.append(script);
    }
    if (!metaPixelLoaded && metaPixelId && consent.ads) {
      metaPixelLoaded = true;
      if (!window.fbq) {
        const pixel = function (...args) {
          if (pixel.callMethod) {
            pixel.callMethod(...args);
          } else {
            pixel.queue.push(args);
          }
        };
        pixel.push = pixel;
        pixel.loaded = true;
        pixel.version = '2.0';
        pixel.queue = [];
        window.fbq = window._fbq = pixel;
        const script = document.createElement('script');
        script.async = true;
        script.src = 'https://connect.facebook.net/en_US/fbevents.js';
        document.head.append(script);
      }
      window.fbq('set', 'autoConfig', false, metaPixelId);
      window.fbq('init', metaPixelId);
      window.fbq('trackSingle', metaPixelId, 'PageView');
    }
    if (!googleAdsLoaded && googleAdsDestination && consent.ads) {
      googleAdsLoaded = true;
      const tagId = googleAdsDestination.split('/')[0];
      gtag('js', new Date());
      gtag('config', tagId);
      const script = document.createElement('script');
      script.async = true;
      script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(tagId);
      document.head.append(script);
    }
    if (!clarityLoaded && config.clarity && consent.analytics) {
      clarityLoaded = true;
      window.clarity = window.clarity || function () {
        (window.clarity.q = window.clarity.q || []).push(arguments);
      };
      const script = document.createElement('script');
      script.async = true;
      script.src = 'https://www.clarity.ms/tag/' + encodeURIComponent(config.clarity);
      document.head.append(script);
    }
    if (clarityLoaded) {
      window.clarity('consentv2', {
        ad_Storage: 'denied',
        analytics_Storage: consent.analytics ? 'granted' : 'denied'
      });
    }
    if (!privatusLoaded && config.privatus && consent.analytics) {
      privatusLoaded = true;
      window.privatus = window.privatus || { q: [] };
      window.privatus.track = window.privatus.track || function (...args) {
        window.privatus.q.push(['track', args]);
      };
      const script = document.createElement('script');
      script.async = true;
      script.src = 'https://privatusstats.com/js/pa.js';
      script.dataset.site = config.privatus;
      script.dataset.modules = 'engage,vitals';
      document.head.append(script);
    }
    sendLandingSignals();
  }

  googleConsent('default');
  if ((config.container || googleAdsDestination || metaPixelId || config.clarity || config.privatus) && preferences && openPreferences) {
    let saved;
    try {
      saved = JSON.parse(localStorage.getItem(storageKey));
    } catch {}
    const form = preferences.querySelector('form');
    const analytics = form.elements.analytics;
    const ads = form.elements.ads;
    if (saved && typeof saved.analytics === 'boolean' && typeof saved.ads === 'boolean') {
      consent = saved;
      applyConsent();
    } else {
      preferences.hidden = false;
    }
    openPreferences.hidden = false;
    openPreferences.addEventListener('click', () => {
      analytics.checked = consent.analytics;
      ads.checked = consent.ads;
      preferences.hidden = false;
      analytics.focus();
    });
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const old = consent;
      consent = event.submitter?.value === 'reject' ? { analytics: false, ads: false } : {
        analytics: analytics.checked,
        ads: ads.checked
      };
      try {
        localStorage.setItem(storageKey, JSON.stringify(consent));
      } catch {}
      applyConsent();
      preferences.hidden = true;
      openPreferences.focus();
      if ((old.analytics && !consent.analytics) || (old.ads && !consent.ads)) location.reload();
    });
  }

  function recordDealClick(event) {
    const cta = event.target.closest('a[data-deal-placement]');
    if (!cta || (event.type === 'auxclick' && event.button !== 1)) return;
    const details = {
      event: 'appsumo_outbound_click',
      cta_placement: cta.dataset.dealPlacement,
      offer_channel: 'google_ads_landing',
      offer_destination: 'appsumo',
      analytics_consent: consent.analytics,
      advertising_consent: consent.ads,
      ...campaignContext()
    };
    if (!consent.analytics && !consent.ads) return;
    if (metaPixelLoaded && consent.ads) {
      window.fbq('trackSingleCustom', metaPixelId, 'AppSumoOutboundClick', { cta_placement: cta.dataset.dealPlacement });
    }
    if (clarityLoaded && consent.analytics) window.clarity('event', 'appsumo_outbound_click');
    if (privatusLoaded && consent.analytics) {
      window.privatus.track('appsumo_outbound_click', { cta_placement: cta.dataset.dealPlacement });
    }
    // A direct Google Ads destination and a GTM conversion tag are mutually
    // exclusive. Running both would count one AppSumo click twice.
    const trackGoogleAds = googleAdsLoaded && consent.ads && !tagManagerLoaded;
    if ((tagManagerLoaded || trackGoogleAds) && event.type === 'click' && !event.metaKey && !event.ctrlKey && !event.shiftKey && !event.altKey) {
      event.preventDefault();
      let continued = false;
      const navigate = () => {
        if (continued) return;
        continued = true;
        location.assign(cta.href);
      };
      layer.push({ ...details, eventCallback: navigate, eventTimeout: 450 });
      if (trackGoogleAds) gtag('event', 'conversion', { send_to: googleAdsDestination, event_callback: navigate, event_timeout: 450 });
      setTimeout(navigate, 450);
    } else {
      layer.push(details);
      if (trackGoogleAds) gtag('event', 'conversion', { send_to: googleAdsDestination });
    }
  }

  document.addEventListener('click', recordDealClick);
  document.addEventListener('auxclick', recordDealClick);

  const contentObserver = 'IntersectionObserver' in window ? new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      if (entry.target.id === 'tier-comparison' && !pricingViewSent) {
        pricingViewSent = true;
        pushEvent('pricing_view', { section_id: entry.target.id });
      }
      if (entry.target.id === 'compare-tools' && !compareToolsViewSent) {
        compareToolsViewSent = true;
        pushEvent('content_engaged', { section_id: entry.target.id });
      }
    });
  }, { threshold: 0.35 }) : null;

  ['tier-comparison', 'compare-tools'].forEach((id) => {
    const section = document.getElementById(id);
    if (contentObserver && section) contentObserver.observe(section);
  });

  window.addEventListener('scroll', () => {
    if (contentEngagedSent || (!consent.analytics && !consent.ads)) return;
    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
    if (scrollable > 0 && window.scrollY / scrollable >= 0.5) {
      contentEngagedSent = true;
      pushEvent('content_engaged', { engagement_depth: 0.5 });
    }
  }, { passive: true });
})();
