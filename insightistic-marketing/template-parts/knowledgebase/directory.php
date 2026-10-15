<?php
/** Knowledgebase topic and guide directory. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$topics = insightistic_knowledgebase_topics();
$guides = insightistic_knowledgebase_guides();
?>
<section class="ins-section ins-directory" aria-labelledby="ins-topic-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Browse by topic', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-topic-title"><?php esc_html_e( 'A practical library for WordPress operators', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Start with the business question you are trying to answer. Each topic connects product context, implementation guidance and the next useful action.', 'insightistic-marketing' ); ?></p>
		</div>
		<div class="ins-directory__topics">
			<?php foreach ( $topics as $topic ) : ?>
				<a class="ins-directory__topic" href="<?php echo esc_url( $topic['url'] ); ?>">
					<span class="ins-directory__kicker"><?php esc_html_e( 'Topic', 'insightistic-marketing' ); ?></span>
					<h3><?php echo esc_html( $topic['title'] ); ?></h3>
					<p><?php echo esc_html( $topic['description'] ); ?></p>
					<span class="ins-link"><?php esc_html_e( 'Explore topic', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="ins-section ins-directory ins-directory--guides" aria-labelledby="ins-guide-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow ins-eyebrow--accent"> <?php esc_html_e( 'Start here', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-guide-title"><?php esc_html_e( 'Evergreen guides built around real decisions', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'These guides are designed to become durable reference points for US store owners, operators and agencies. New articles appear in the Blog as the editorial library grows.', 'insightistic-marketing' ); ?></p>
		</div>
		<div class="ins-grid ins-grid--posts">
			<?php foreach ( $guides as $guide ) : ?>
				<article class="ins-guide-card">
					<p class="ins-postcard__cat"><?php echo esc_html( $guide['label'] ); ?></p>
					<h3><?php echo esc_html( $guide['title'] ); ?></h3>
					<p><?php echo esc_html( $guide['description'] ); ?></p>
					<a class="ins-link" href="<?php echo esc_url( $guide['url'] ); ?>"><?php esc_html_e( 'Read the guide', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="ins-center ins-directory__more"><a class="ins-btn ins-btn--ghost" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Open the latest blog posts', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</div>
</section>

