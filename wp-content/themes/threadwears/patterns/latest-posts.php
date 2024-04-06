<?php
 /**
  * Title: Latest Posts
  * Slug: threadwears/latest-posts
  * Categories: threadwears, page
  */
?>


<!-- wp:group {"align":"full","className":"wp-block-section wp-block-latest-posts","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull wp-block-section wp-block-latest-posts">
	<!-- wp:group {"align":"wide","className":"wp-block-group-heading"} -->
	<div class="wp-block-group alignwide wp-block-group-heading">
		<!-- wp:heading {"textAlign":"center","align":"full"} -->
		<h2 class="alignfull has-text-align-center"><?php esc_html_e ( 'Latest From The Editorial', 'threadwears' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
	<!-- wp:query {"queryId":67,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide"} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template -->
		<!-- wp:post-featured-image /-->
		<!-- wp:post-date /-->
		<!-- wp:post-title /-->
		<!-- wp:read-more {"content":"Continue Reading"} /-->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
