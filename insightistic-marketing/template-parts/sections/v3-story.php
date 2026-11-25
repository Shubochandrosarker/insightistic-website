<?php
/**
 * V3 story sections: the proof, the permission model, the five capabilities and
 * the honest comparison.
 *
 * Kept in one template part because they tell one story and are always shipped
 * together. Every claim here is true of the live product at deploy time; nothing
 * is aspirational, and the comparison table states facts rather than insults.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
/**
 * 1. Proof block — what the morning brief looks like.
 *
 * The counts are illustrative of the brief's shape, not a claim about a specific
 * visitor's account, so the block says "an example" and never renders numbers as
 * if they were someone's data.
 */
?>
<section class="ins-section ins-proof" aria-labelledby="ins-proof-title">
	<div class="ins-container">
		<div class="ins-proof__card">
			<p class="ins-proof__eyebrow"><?php esc_html_e( 'The morning brief', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-proof-title" class="ins-proof__title"><?php esc_html_e( 'While you slept: 3 things changed, 1 needs your decision, 0 fires.', 'insightistic-marketing' ); ?></h2>
			<p class="ins-proof__note"><?php esc_html_e( 'An example of what Agent JOLLY writes before you wake up. Your workspace gets its own counts, from your own data.', 'insightistic-marketing' ); ?></p>
			<ul class="ins-proof__list">
				<li><strong>3</strong> <?php esc_html_e( 'changes worth knowing about', 'insightistic-marketing' ); ?></li>
				<li><strong>1</strong> <?php esc_html_e( 'decision waiting for you', 'insightistic-marketing' ); ?></li>
				<li><strong>0</strong> <?php esc_html_e( 'things on fire', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<?php
/** 2. Trust: the permission model. This answers the loudest objection to AI agents. */
?>
<section class="ins-section ins-trust" id="permission" aria-labelledby="ins-trust-title">
	<div class="ins-container">
		<p class="ins-eyebrow"><?php esc_html_e( 'Built to be trusted', 'insightistic-marketing' ); ?></p>
		<h2 id="ins-trust-title" class="ins-section__title"><?php esc_html_e( 'An AI that asks permission', 'insightistic-marketing' ); ?></h2>
		<p class="ins-section__lede"><?php esc_html_e( 'JOLLY can propose, draft and prepare. It cannot change your site, your billing or your settings without you.', 'insightistic-marketing' ); ?></p>

		<div class="ins-trust__grid">
			<div class="ins-trust__item">
				<h3><?php esc_html_e( 'Proposed, then approved', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Site fixes arrive as a reviewable list with the reason and the expected effect. Nothing is applied until you approve it, and every applied change has a one-click rollback and an audit entry.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-trust__item">
				<h3><?php esc_html_e( 'Automations are drafted, not installed', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'When JOLLY spots something worth repeating weekly, it drafts the automation and asks. You get the trigger, the action and its settings on one card, and a single Approve creates it.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-trust__item">
				<h3><?php esc_html_e( 'Every action has a human', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Nothing is posted, emailed or pushed to a third party on its own. The brief and alerts stay inside your workspace; anything outward needs your word.', 'insightistic-marketing' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php
/** 3. Five capability blocks — the V3 features stated plainly. */
$ins_v3_features = array(
	array(
		'title' => __( 'AI visibility and the citation gap', 'insightistic-marketing' ),
		'body'  => __( 'See whether AI answers mention you, which competitors they cite instead, and how that share moves over time. The gap report lists the exact prompts you are losing, built from your own visibility runs.', 'insightistic-marketing' ),
		'tag'   => __( 'AI visibility', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'Google Business Profile in one click', 'insightistic-marketing' ),
		'body'  => __( 'Connect Google once and pick your business location from a list instead of pasting IDs. Local pack visibility and organic rankings live in the same report.', 'insightistic-marketing' ),
		'tag'   => __( 'Local SEO', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'JOLLY remembers your business', 'insightistic-marketing' ),
		'body'  => __( 'Decisions, outcomes and preferences are stored per workspace and recalled into later answers with citations. You can see what it remembers and make it forget any card.', 'insightistic-marketing' ),
		'tag'   => __( 'Memory', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'It learns your website by itself', 'insightistic-marketing' ),
		'body'  => __( 'Switch auto-refresh on and your knowledge base updates from your own crawl after each run. Unchanged pages cost nothing, and one button refreshes everything on demand.', 'insightistic-marketing' ),
		'tag'   => __( 'Knowledge', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'Bring your own tools with MCP', 'insightistic-marketing' ),
		'body'  => __( 'One revocable, site-bound connection lets your own MCP client read your Insightsitic data. Ten tools, scoped tokens, an audit trail and instant revocation.', 'insightistic-marketing' ),
		'tag'   => __( 'MCP', 'insightistic-marketing' ),
	),
);
?>
<section class="ins-section ins-v3-features" aria-labelledby="ins-v3-title">
	<div class="ins-container">
		<p class="ins-eyebrow"><?php esc_html_e( 'New in this release', 'insightistic-marketing' ); ?></p>
		<h2 id="ins-v3-title" class="ins-section__title"><?php esc_html_e( 'Five things your analytics stack cannot do', 'insightistic-marketing' ); ?></h2>
		<div class="ins-v3-features__grid">
			<?php foreach ( $ins_v3_features as $ins_feature ) : ?>
				<article class="ins-v3-features__item">
					<p class="ins-v3-features__tag"><?php echo esc_html( $ins_feature['tag'] ); ?></p>
					<h3><?php echo esc_html( $ins_feature['title'] ); ?></h3>
					<p><?php echo esc_html( $ins_feature['body'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
/**
 * 4. Comparison — factual, no trash-talk. "—" means the tool does not do it.
 */
$ins_compare = array(
	'rows' => array(
		array( 'label' => __( 'AI answer visibility tracking', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => false, 'lrt' => false ),
		array( 'label' => __( 'Citation-gap report (who AI cites instead)', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => false, 'lrt' => false ),
		array( 'label' => __( 'Google Business Profile + organic in one view', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => false, 'lrt' => false ),
		array( 'label' => __( 'AI agent that drafts fixes and automations', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => false, 'lrt' => false ),
		array( 'label' => __( 'Rank tracking for your own keywords', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => true, 'lrt' => true ),
		array( 'label' => __( 'Site audit and Core Web Vitals', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => false, 'screpy' => true, 'lrt' => false ),
		array( 'label' => __( 'GA4 traffic and conversions', 'insightistic-marketing' ), 'ins' => true, 'ga4' => true, 'mi' => true, 'screpy' => true, 'lrt' => false ),
		array( 'label' => __( 'WooCommerce revenue next to SEO queries', 'insightistic-marketing' ), 'ins' => true, 'ga4' => false, 'mi' => true, 'screpy' => false, 'lrt' => false ),
	),
);
$ins_mark = static function ( bool $value ): string {
	return $value ? '✓' : '—';
};
?>
<section class="ins-section ins-compare" aria-labelledby="ins-compare-title">
	<div class="ins-container">
		<h2 id="ins-compare-title" class="ins-section__title"><?php esc_html_e( 'How it compares', 'insightistic-marketing' ); ?></h2>
		<p class="ins-section__lede"><?php esc_html_e( 'Each of these tools is good at its own job. Here is where they overlap with Insightistic, and where they do not.', 'insightistic-marketing' ); ?></p>

		<div class="ins-compare__scroll">
			<table class="ins-compare__table">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e( 'Capability', 'insightistic-marketing' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Insightistic', 'insightistic-marketing' ); ?></th>
						<th scope="col"><?php esc_html_e( 'GA4', 'insightistic-marketing' ); ?></th>
						<th scope="col"><?php esc_html_e( 'MonsterInsights', 'insightistic-marketing' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Screpy', 'insightistic-marketing' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Local Rank Tracker', 'insightistic-marketing' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $ins_compare['rows'] as $ins_row ) : ?>
						<tr>
							<th scope="row"><?php echo esc_html( $ins_row['label'] ); ?></th>
							<td class="is-yes"><?php echo esc_html( $ins_mark( $ins_row['ins'] ) ); ?></td>
							<td><?php echo esc_html( $ins_mark( $ins_row['ga4'] ) ); ?></td>
							<td><?php echo esc_html( $ins_mark( $ins_row['mi'] ) ); ?></td>
							<td><?php echo esc_html( $ins_mark( $ins_row['screpy'] ) ); ?></td>
							<td><?php echo esc_html( $ins_mark( $ins_row['lrt'] ) ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<p class="ins-compare__note"><?php esc_html_e( 'Based on each product’s published feature set at the time of writing. GA4 is free with any Google Analytics account.', 'insightistic-marketing' ); ?></p>
	</div>
</section>
