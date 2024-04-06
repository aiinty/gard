<?php
 /**
  * Title: Header With Cart
  * Slug: threadwears/header-with-cart
  * Categories: threadwears, header
  */
?>

<!-- wp:group {"align":"full","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull">
	<!-- wp:group {"align":"full","className":"wp-block-main-header","layout":{"inherit":true,"type":"constrained"}} -->
	<div class="wp-block-group alignfull wp-block-main-header">
		<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dtiny)","top":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dtiny)"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignfull" style="padding-top:var(--wp--custom--spacing--tiny);padding-bottom:var(--wp--custom--spacing--tiny)">
			<!-- wp:navigation {"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"left"}} /-->
			<!-- wp:group {"className":"wp-site-logo","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group wp-site-logo">
				<!-- wp:site-logo {"width":64} /-->
				<!-- wp:group -->
				<div class="wp-block-group">
					<!-- wp:site-title {"textAlign":"center"} /-->
					<!-- wp:site-tagline {"textAlign":"center","style":{"spacing":{"margin":{"top":"7px"}}}} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"className":"wp-header-right","layout":{"type":"flex","allowOrientation":false}} -->
			<div class="wp-block-group wp-header-right">
				<!-- wp:woocommerce/customer-account {"displayStyle":"icon_only"} /-->
				<!-- wp:woocommerce/mini-cart {"hasHiddenPrice":true} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
