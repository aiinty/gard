<?php
 /**
  * Title: Featured Products
  * Slug: threadwears/featured-products
  * Categories: threadwears, page
  */
?>

<!-- wp:group {"align":"full","className":"wp-block-section wp-product-showcase"} -->
<div class="wp-block-group alignfull wp-block-section wp-product-showcase">
	<!-- wp:group {"className":"wp-block-group-heading","layout":{"type":"constrained"}} -->
	<div class="wp-block-group wp-block-group-heading">
		<!-- wp:columns {"align":"full"} -->
		<div class="wp-block-columns alignfull">
			<!-- wp:column {"width":"66.333%"} -->
			<div class="wp-block-column" style="flex-basis:66.333%">
				<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left"}} -->
				<div class="wp-block-group">
					<!-- wp:heading -->
					<h2><?php esc_html_e ( 'Feautred Products', 'threadwears' ); ?></h2>
					<!-- /wp:heading -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"33.3333%"} -->
			<div class="wp-block-column" style="flex-basis:33.3333%">
				<!-- wp:group {"layout":{"type":"constrained","justifyContent":"center"}} -->
				<div class="wp-block-group">
					<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
					<div class="wp-block-buttons">
						<!-- wp:button {"className":"is-style-button"} -->
						<div class="wp-block-button is-style-button">
							<a class="wp-block-button__link wp-element-button"><?php esc_html_e ( 'See All', 'threadwears' ); ?></a>
						</div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"className":"wp-product-cateogry-block","layout":{"inherit":true,"type":"constrained"}} -->
	<div class="wp-block-group wp-product-cateogry-block">
		<!-- wp:columns {"align":"full"} -->
		<div class="wp-block-columns alignfull">
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-product /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-product /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-product /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-product /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:woocommerce/featured-product /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
