<?php
 /**
  * Title: Header Media
  * Slug: threadwears/header-media
  * Categories: threadwears, header
  */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/header-media-bg.jpg' ) ); ?>","dimRatio":0,"isDark":false,"align":"full","className":"wp-block-custom-header-media wp-block-section wp-block-no-padding"} -->
<div class="wp-block-cover alignfull is-light wp-block-custom-header-media wp-block-section wp-block-no-padding">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
	<img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/header-media-bg.jpg' ) ); ?>" data-object-fit="cover"/>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","layout":{"inherit":true,"type":"constrained"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:media-text {"mediaPosition":"right","mediaType":"image"} -->
			<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile">
				<div class="wp-block-media-text__content">
					<!-- wp:heading {"className":"as-text-color"} -->
					<h2 class="as-text-color">
						<?php esc_html_e ( 'Elegant Styles', 'threadwears' ); ?>
					</h2>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"className":"has-text-color"} -->
					<p class="has-text-color">
						<?php esc_html_e ( 'We collaborate with smart and creative people to build awesome WordPress Full Site Editing Themes.', 'threadwears' ); ?>
					</p>
					<!-- /wp:paragraph -->
					<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"14px"}}}} -->
					<div class="wp-block-buttons" style="margin-top:14px">
						<!-- wp:button -->
						<div class="wp-block-button">
						<a class="wp-block-button__link wp-element-button">
								<?php esc_html_e ( 'Shop Now', 'threadwears' ); ?>
							</a>
						</div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<figure class="wp-block-media-text__media">
					<img src="" alt=""/>
				</figure>
			</div>
			<!-- /wp:media-text -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
