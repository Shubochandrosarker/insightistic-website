<?php
/**
 * Homepage positioning, illustrative product views, and buyer journeys.
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
  <section class="ins-r-hero" aria-labelledby="hero-title">
      <div class="ins-r-wrap ins-r-hero-grid">
        <div class="ins-r-hero-copy">
          <p class="ins-r-overline"><span aria-hidden="true"></span> Website intelligence for WordPress</p>
          <h1 id="hero-title">See what changed. <em>Know what’s next.</em></h1>
          <p class="ins-r-hero-lead">Bring search, site health, and WooCommerce into one view. Agent JOLLEY explains what moved and shows the evidence behind its next step.</p>
          <div class="ins-r-actions"><a class="ins-r-button ins-r-primary" href="<?php echo esc_url( insightistic_register_url() ); ?>">Start free <span aria-hidden="true">→</span></a><a class="ins-r-button ins-r-outline" href="<?php echo esc_url( home_url( '/product-tour/' ) ); ?>">Explore the product tour <span aria-hidden="true">→</span></a></div>
          <p class="ins-r-hero-note">Start with Free Connected. Add capacity as you grow.</p>
        </div>
        <figure class="ins-r-preview" aria-labelledby="preview-title">
          <div class="ins-r-preview-chrome">
            <span class="ins-r-identity"><img src="<?php echo esc_url( insightistic_asset_url( 'assets/images/insightistic-icon.png' ) ); ?>" width="26" height="26" alt=""> Insightistic</span>
            <span class="ins-r-sample"><span aria-hidden="true"></span> Sample workspace</span>
          </div>
          <div class="ins-r-preview-body">
            <h2 id="preview-title">Business Pulse</h2>
            <p class="ins-r-period">Last 7 days vs. previous 7 days</p>
            <div class="ins-r-tabs" role="tablist" aria-label="Explore the sample workspace" hidden>
              <button type="button" role="tab" id="tab-overview" aria-selected="true" aria-controls="view-overview" tabindex="0">Overview</button>
              <button type="button" role="tab" id="tab-search" aria-selected="false" aria-controls="view-search" tabindex="-1">Search</button>
              <button type="button" role="tab" id="tab-store" aria-selected="false" aria-controls="view-store" tabindex="-1">Store</button>
              <button type="button" role="tab" id="tab-health" aria-selected="false" aria-controls="view-health" tabindex="-1">Site health</button>
            </div>
            <section class="ins-r-view-panel" id="view-overview" aria-labelledby="tab-overview" role="tabpanel" tabindex="0">
              <dl class="ins-r-metrics">
                <div class="ins-r-metric"><dt>Search clicks</dt><dd>1,248</dd><dd class="ins-r-down">Down 8%</dd></div>
                <div class="ins-r-metric"><dt>Orders</dt><dd>186</dd><dd class="ins-r-up">Up 4%</dd></div>
                <div class="ins-r-metric"><dt>Mobile LCP</dt><dd>3.1 s</dd><dd class="ins-r-warn">Up 0.7 s</dd></div>
              </dl>
              <div class="ins-r-chart">
                <div class="ins-r-chart-heading"><strong>Organic clicks</strong><small>Search Console · 7 days</small></div>
                <div class="ins-r-chart-plot" aria-hidden="true">
                  <div><b style="--height:74.5%"></b><span>M</span></div>
                  <div><b style="--height:80.9%"></b><span>T</span></div>
                  <div><b style="--height:85.5%"></b><span>W</span></div>
                  <div><b style="--height:70.5%"></b><span>T</span></div>
                  <div><b style="--height:79.5%"></b><span>F</span></div>
                  <div><b style="--height:94.1%"></b><span>S</span></div>
                  <div><b style="--height:82.3%"></b><span>S</span></div>
                </div>
                <p class="ins-r-sr">Sample values from Monday through Sunday: 164, 178, 188, 155, 175, 207, 181.</p>
              </div>
              <div class="ins-r-finding">
                <span class="ins-r-finding-icon" aria-hidden="true">↗</span>
                <div><strong>Mobile load time increased</strong><p>The largest visible element took 3.1 s to appear on mobile, up from 2.4 s.</p><a href="#brief">Read the example brief <span aria-hidden="true">→</span></a></div>
              </div>
            </section>
            <section class="ins-r-view-panel" id="view-search" aria-labelledby="tab-search" role="tabpanel" tabindex="0" hidden>
              <dl class="ins-r-metrics">
                <div class="ins-r-metric"><dt>Search clicks</dt><dd>1,248</dd><dd class="ins-r-down">Down 8%</dd></div>
                <div class="ins-r-metric"><dt>Impressions</dt><dd>32.6k</dd><dd class="ins-r-up">Up 5%</dd></div>
                <div class="ins-r-metric"><dt>Avg. position</dt><dd>12.4</dd><dd class="ins-r-warn">Previous 11.8</dd></div>
              </dl>
              <div class="ins-r-chart">
                <div class="ins-r-chart-heading"><strong>Search clicks by day</strong><small>Search Console · 7 days</small></div>
                <div class="ins-r-chart-plot" aria-hidden="true">
                  <div><b style="--height:74.5%"></b><span>M</span></div>
                  <div><b style="--height:80.9%"></b><span>T</span></div>
                  <div><b style="--height:85.5%"></b><span>W</span></div>
                  <div><b style="--height:70.5%"></b><span>T</span></div>
                  <div><b style="--height:79.5%"></b><span>F</span></div>
                  <div><b style="--height:94.1%"></b><span>S</span></div>
                  <div><b style="--height:82.3%"></b><span>S</span></div>
                </div>
                <p class="ins-r-sr">Sample values from Monday through Sunday: 164, 178, 188, 155, 175, 207, 181.</p>
              </div>
              <div class="ins-r-finding">
                <span class="ins-r-finding-icon" aria-hidden="true">↗</span>
                <div><strong>More impressions, fewer clicks</strong><p>Compare the affected page and queries before rewriting its title.</p><a href="<?php echo esc_url( home_url( '/seo-analytics/' ) ); ?>">Explore search analytics <span aria-hidden="true">→</span></a></div>
              </div>
            </section>
            <section class="ins-r-view-panel" id="view-store" aria-labelledby="tab-store" role="tabpanel" tabindex="0" hidden>
              <dl class="ins-r-metrics">
                <div class="ins-r-metric"><dt>Orders</dt><dd>186</dd><dd class="ins-r-up">Up 4%</dd></div>
                <div class="ins-r-metric"><dt>Net revenue</dt><dd>$13,206</dd><dd class="ins-r-up">Up 7%</dd></div>
                <div class="ins-r-metric"><dt>Refunds</dt><dd>$420</dd><dd class="ins-r-up">Previous $510</dd></div>
              </dl>
              <div class="ins-r-chart">
                <div class="ins-r-chart-heading"><strong>Orders by day</strong><small>WooCommerce · 7 days</small></div>
                <div class="ins-r-chart-plot" aria-hidden="true">
                  <div><b style="--height:61.1%"></b><span>M</span></div>
                  <div><b style="--height:72.2%"></b><span>T</span></div>
                  <div><b style="--height:66.7%"></b><span>W</span></div>
                  <div><b style="--height:80.6%"></b><span>T</span></div>
                  <div><b style="--height:63.9%"></b><span>F</span></div>
                  <div><b style="--height:94.4%"></b><span>S</span></div>
                  <div><b style="--height:77.8%"></b><span>S</span></div>
                </div>
                <p class="ins-r-sr">Sample values from Monday through Sunday: 22, 26, 24, 29, 23, 34, 28.</p>
              </div>
              <div class="ins-r-finding">
                <span class="ins-r-finding-icon" aria-hidden="true">↗</span>
                <div><strong>Revenue rose alongside order volume</strong><p>Compare product mix and refund totals to see what contributed to the change.</p><a href="<?php echo esc_url( home_url( '/woocommerce-analytics/' ) ); ?>">Explore WooCommerce analytics <span aria-hidden="true">→</span></a></div>
              </div>
            </section>
            <section class="ins-r-view-panel" id="view-health" aria-labelledby="tab-health" role="tabpanel" tabindex="0" hidden>
              <dl class="ins-r-metrics">
                <div class="ins-r-metric"><dt>Mobile LCP</dt><dd>3.1 s</dd><dd class="ins-r-warn">Up 0.7 s</dd></div>
                <div class="ins-r-metric"><dt>Broken links</dt><dd>3</dd><dd class="ins-r-down">New in crawl</dd></div>
                <div class="ins-r-metric"><dt>Uptime</dt><dd>100%</dd><dd class="ins-r-up">Last 7 days</dd></div>
              </dl>
              <div class="ins-r-chart">
                <div class="ins-r-chart-heading"><strong>Mobile load time by run</strong><small>PageSpeed Insights · 7 days</small></div>
                <div class="ins-r-chart-plot" aria-hidden="true">
                  <div><b style="--height:68.6%"></b><span>M</span></div>
                  <div><b style="--height:71.4%"></b><span>T</span></div>
                  <div><b style="--height:68.6%"></b><span>W</span></div>
                  <div><b style="--height:80.0%"></b><span>T</span></div>
                  <div><b style="--height:82.9%"></b><span>F</span></div>
                  <div><b style="--height:85.7%"></b><span>S</span></div>
                  <div><b style="--height:88.6%"></b><span>S</span></div>
                </div>
                <p class="ins-r-sr">Sample values from Monday through Sunday: 2.4, 2.5, 2.4, 2.8, 2.9, 3, 3.1 seconds.</p>
              </div>
              <div class="ins-r-finding">
                <span class="ins-r-finding-icon" aria-hidden="true">↗</span>
                <div><strong>Check the product page first</strong><p>The latest run took 3.1 seconds to render its largest visible element.</p><a href="<?php echo esc_url( home_url( '/performance-monitoring/' ) ); ?>">Explore performance monitoring <span aria-hidden="true">→</span></a></div>
              </div>
            </section>
          </div>
          <figcaption>Illustrative data from a fictional store.</figcaption>
        </figure>
      </div>
    </section>

    <div class="ins-r-connections">
      <div class="ins-r-wrap ins-r-connections-row">
        <p>Bring your existing data</p>
        <ul aria-label="Example integrations">
          <li>WordPress</li><li>WooCommerce</li><li>Search Console</li><li>Google Analytics 4</li>
        </ul>
        <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/integrations/' ) ); ?>">All integrations <span aria-hidden="true">→</span></a>
      </div>
    </div>

    <section class="ins-r-section ins-r-wrap" id="ins-workflows" aria-labelledby="product-title">
      <div class="ins-r-section-head">
        <h2 id="product-title">Three places to look when your numbers move.</h2>
        <p>Follow each signal to the page, product, or measurement you can act on.</p>
      </div>
      <div class="ins-r-workflows">
        <article class="ins-r-workflow">
          <span class="ins-r-icon ins-r-search" aria-hidden="true"></span>
          <h3>Search visibility</h3>
          <p>Track Google rankings, Search Console performance, and which monitored AI answers mention or cite your site.</p>
          <div class="ins-r-example"><strong>When impressions rise but clicks fall</strong><p>Review the affected queries and landing pages before changing a title.</p></div>
          <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/seo-analytics/' ) ); ?>">Explore search analytics <span aria-hidden="true">→</span></a>
        </article>
        <article class="ins-r-workflow">
          <span class="ins-r-icon ins-r-store" aria-hidden="true"></span>
          <h3>Store performance</h3>
          <p>Review WooCommerce revenue, orders, average order value, and refunds alongside your traffic.</p>
          <div class="ins-r-example"><strong>When orders rise but revenue slows</strong><p>Check refund totals and product mix for the same period.</p></div>
          <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/woocommerce-analytics/' ) ); ?>">Explore WooCommerce analytics <span aria-hidden="true">→</span></a>
        </article>
        <article class="ins-r-workflow">
          <span class="ins-r-icon ins-r-health" aria-hidden="true"></span>
          <h3>Site health</h3>
          <p>Keep an eye on broken links, mobile speed, uptime, and crawl issues for the pages you monitor.</p>
          <div class="ins-r-example"><strong>When a product page slows down</strong><p>Open its latest PageSpeed report and see what changed.</p></div>
          <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/performance-monitoring/' ) ); ?>">Explore site monitoring <span aria-hidden="true">→</span></a>
        </article>
      </div>
    </section>

    <section class="ins-r-brief ins-r-section" id="brief" aria-labelledby="brief-title">
      <div class="ins-r-wrap ins-r-brief-grid">
        <div class="ins-r-brief-copy">
          <p class="ins-r-overline"><span aria-hidden="true"></span> Agent JOLLEY</p>
          <h2 id="brief-title">Get the explanation. Check the evidence.</h2>
          <p>Ask about your connected data. JOLLEY gives you a finding, the source behind it, and a next step you can review.</p>
          <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/ai-insights/' ) ); ?>">Explore AI Insights <span aria-hidden="true">→</span></a>
        </div>
        <article class="ins-r-brief-card" aria-labelledby="example-title">
          <div class="ins-r-brief-header"><h3 id="example-title">JOLLEY Brief</h3><span>Example</span></div>
          <p class="ins-r-question">What should I check first on my store this week?</p>
          <p><strong>Start with the product page.</strong> Mobile LCP rose from 2.4 to 3.1 seconds in the sample PageSpeed run. Orders increased over the same period.</p>
          <p><strong>Next step.</strong> Open the mobile report to identify the largest visible element before you change the page.</p>
          <ul aria-label="Illustrative sources"><li>PageSpeed report</li><li>WooCommerce orders</li></ul>
        </article>
      </div>
    </section>

    <section class="ins-r-section ins-r-wrap" aria-labelledby="setup-title">
      <div class="ins-r-section-head">
        <h2 id="setup-title">Start with one site.</h2>
        <p>Use the data you already collect. Add more sources as new questions come up.</p>
      </div>
      <ol class="ins-r-steps">
        <li><h3>Create a workspace</h3><p>Open a Free Connected account and add the website you want to monitor.</p></li>
        <li><h3>Connect the right sources</h3><p>Connect Google for search or traffic. Use the Insightistic plugin for WordPress and WooCommerce data.</p></li>
        <li><h3>Review your first changes</h3><p>Pick a date range, follow a signal to its source, and ask JOLLEY about what changed.</p></li>
      </ol>
      <a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/knowledgebase/' ) ); ?>">Read the setup guide <span aria-hidden="true">→</span></a>
      <div class="ins-r-agency">
        <div><h3>Looking after client sites?</h3><p>Review site performance across clients and share reports with the evidence behind your recommendations.</p></div>
        <a class="ins-r-button ins-r-outline" href="<?php echo esc_url( home_url( '/agency/' ) ); ?>">Explore agency workflows <span aria-hidden="true">→</span></a>
      </div>
    </section>

    <section class="ins-r-plans ins-r-section" id="plans" aria-labelledby="plans-title">
      <div class="ins-r-wrap ins-r-plan-grid">
        <div class="ins-r-section-head">
          <h2 id="plans-title">Start free. Add capacity as you grow.</h2>
          <p>Compare site limits, reports, team access, and AI allowances before choosing a paid plan.</p>
        </div>
        <article class="ins-r-offer ins-r-free"><h3>Free Connected</h3><p>Explore Insightistic with your first connected site.</p><a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">Compare subscription plans <span aria-hidden="true">→</span></a></article>
        <article class="ins-r-offer"><h3>AppSumo lifetime deal</h3><p>Compare the one-time license tiers and their monthly allowances.</p><a class="ins-r-text-link" href="<?php echo esc_url( home_url( '/ltd/' ) ); ?>">Compare lifetime tiers <span aria-hidden="true">→</span></a></article>
      </div>
    </section>

    <section class="ins-r-section ins-r-wrap ins-r-faq" aria-labelledby="faq-title">
      <div class="ins-r-section-head">
        <h2 id="faq-title">Before you connect a site</h2>
        <p>Find setup and troubleshooting help in the <a href="<?php echo esc_url( home_url( '/knowledgebase/' ) ); ?>">knowledge base</a>.</p>
      </div>
      <div class="ins-r-faq-list">
        <?php foreach ( function_exists( 'insightistic_home_faqs' ) ? insightistic_home_faqs() : array() as $faq ) : ?>
          <details>
            <summary><?php echo esc_html( $faq['q'] ); ?></summary>
            <p><?php echo esc_html( $faq['a'] ); ?></p>
          </details>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="ins-r-closing ins-r-wrap" aria-labelledby="closing-title">
      <div><h2 id="closing-title">See your first week in context.</h2><p>Connect one site and see where your attention is needed.</p></div>
      <div class="ins-r-actions"><a class="ins-r-button ins-r-primary" href="<?php echo esc_url( insightistic_register_url() ); ?>">Start free <span aria-hidden="true">→</span></a><a class="ins-r-button ins-r-outline" href="<?php echo esc_url( insightistic_login_url() ); ?>">Sign in <span aria-hidden="true">→</span></a></div>
    </section>
