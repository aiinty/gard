<?php
 /**
  * Title: Sidebar
  * Slug: threadwears/sidebar
  * Categories: threadwears, page
  */
?>

<!-- wp:group {"className":"wp-block-widget-area wp-block-sidebar"} -->
<div class="wp-block-group wp-block-widget-area wp-block-sidebar">


<!-- wp:group {"className":"wp-block-widget"} -->
<div class="wp-block-group wp-block-widget"><!-- wp:search {"label":"","showLabel":false,"buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true} /--></div>
<!-- /wp:group -->
   <!-- wp:group {"className":"wp-block-widget"} -->
   <div class="wp-block-group wp-block-widget">
	  <!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"20px","left":"0px"}}}} -->
	  <h2 id="about" style="margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px"><?php esc_html_e ( 'Author', 'threadwears' ); ?></h2>
	  <!-- /wp:heading -->
	  <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
	  <figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/about-author.jpg' ) ); ?>" alt="" /></figure>
	  <!-- /wp:image -->
	  <!-- wp:paragraph -->
	  <p><?php esc_html_e ( 'Style is s a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.', 'threadwears' ); ?></p>
	  <!-- /wp:paragraph -->
   </div>
   <!-- /wp:group -->
   <!-- wp:group {"className":"wp-block-widget"} -->
   <div class="wp-block-group wp-block-widget">
	  <!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"20px","left":"0px"}}}} -->
	  <h2 id="categories" style="margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px"><?php esc_html_e ( 'Categories', 'threadwears' ); ?></h2>
	  <!-- /wp:heading -->
	  <!-- wp:categories /-->
   </div>
   <!-- /wp:group -->
   <!-- wp:group {"className":"wp-block-widget"} -->
   <div class="wp-block-group wp-block-widget">
	  <!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"20px","left":"0px"}}}} -->
	  <h2 id="recent-post" style="margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px"><?php esc_html_e ( 'Recent Post', 'threadwears' ); ?></h2>
	  <!-- /wp:heading -->
	  <!-- wp:latest-posts {"displayPostDate":true,"displayFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeWidth":75,"featuredImageSizeHeight":75,"addLinkToFeaturedImage":true} /-->
   </div>
   <!-- /wp:group -->
   <!-- wp:group {"className":"wp-block-widget"} -->
   <div class="wp-block-group wp-block-widget">
	  <!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"20px","left":"0px"}}}} -->
	  <h2 id="tags" style="margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px"><?php esc_html_e ( 'Tags', 'threadwears' ); ?></h2>
	  <!-- /wp:heading -->
	  <!-- wp:tag-cloud {"numberOfTags":15} /-->
   </div>
   <!-- /wp:group -->
</div>
<!-- /wp:group -->

