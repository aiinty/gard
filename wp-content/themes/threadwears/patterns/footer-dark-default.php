<?php
 /**
  * Title: Footer Dark Default
  * Slug: threadwears/footer-dark-default
  * Categories: threadwears, footer
  */
?>
 
<!-- wp:group {"align":"full","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull">
	<!-- wp:group {"align":"full","className":"wp-block-footer  wp-block-site-generator footer-dark","layout":{"inherit":true}} -->
	<div class="wp-block-group alignfull wp-block-footer wp-block-site-generator footer-dark ">
		<!-- wp:group {"align":"wide","layout":{"inherit":false}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">
			<?php 
			printf(
				/* translators: %1$s: Copyright html symbol,  %2$s: Year, %3$s: Vendor link */
				esc_html_x( 'Copyright %1$s %2$s %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'threadwears' ),
				'&copy;',
				esc_attr( date_i18n( __( 'Y', 'threadwears' ) ) ),
				'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a><span class="sep"> | </span>Threadwears by <a target="_blank" href="https://catchthemes.com">Catch Themes</a>'
				); 
			?>
			</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
