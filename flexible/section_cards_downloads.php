<div class="fc-section-cards fc-section-cards-downloads">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns">
  <?php if ( get_sub_field('downloads_name') ) : echo '<h3 class="card-grid-title">' . esc_html(get_sub_field('downloads_name')) . '</h3>'; endif; ?>
    <?php $post_objects = get_sub_field('downloads'); ?>  
    <?php if( $post_objects ): ?> 
      <div class="card-grid card-grid-downloads">
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <div class="card-cell card-cell-download">
          <?php setup_postdata($post); ?>
            <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title();?>"><?php the_post_thumbnail( 'thumb' );?></a>
            <div class="card-cell-content">
              <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title();?></a>
            </div>
          <?php wp_reset_postdata(); ?>
        </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>