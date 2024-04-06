<?php
 /**
  * Title: Featured Collections
  * Slug: threadwears/featured-collections
  * Categories: threadwears, header
  */
?>

<!-- wp:group {"align":"full","className":"wp-block-section wp-block-featured-collections","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull wp-block-section wp-block-featured-collections">
	<!-- wp:group {"align":"wide","className":"wp-block-group-heading"} -->
	<div class="wp-block-group alignwide wp-block-group-heading">
		<!-- wp:heading {"textAlign":"center","align":"full"} -->
		<h2 class="alignfull has-text-align-center">
			<?php esc_html_e ( 'Featured Collection', 'threadwears' ); ?>
		</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">
			<?php esc_html_e ( 'We collaborate with smart and creative people', 'threadwears' ); ?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-category /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-category /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-category /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
