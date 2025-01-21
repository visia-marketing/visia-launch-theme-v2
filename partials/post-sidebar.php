<div class="post-sidebar">
	
	<?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 5, 'post__not_in' => array($post->ID) ) ); ?>

	<?php if($related){ ?>

		<div class="post-sidebar-related-posts">

			<h5>Related Posts</h5>

			<?php foreach($related as $post ) { ?>

			<?php setup_postdata($post); ?>

			<ul> 
		      <li>
		      	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		      </li>
		  </ul>

		  <?php } ?>

		</div> 
	
	<?php } ?>

	<?php wp_reset_postdata(); ?>

</div>
