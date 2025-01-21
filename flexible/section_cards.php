<?php
$cards_per_row = get_sub_field('cards_per_row');
?>

<div class="fc-section-cards" >
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns "> 
    <div class="card-grid card-grid-<?php echo $cards_per_row; ?>">
      <?php
      if( have_rows('cards') ):
        while( have_rows('cards') ) : the_row();
          ?>
          <div class="card-cell">
            <div class="card-cell-header">
              <h3><?php echo get_sub_field('card_title');?></h3>
              <?php
                $image = get_sub_field('card_icon');
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                if( $image ) {
                    echo wp_get_attachment_image( $image, $size, false, array( "class" => "card-cell-header-icon style-svg" )  );
                }
              ?>
            </div>
            <div class="card-cell-content">
              <h3><?php echo get_sub_field('card_title');?></h3>
              <?php echo get_sub_field('card_description');?>
            </div>
            <div class="card-cell-footer">
              <?php 
              $link = get_sub_field('card_link');
              if( $link ): 
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>
                  <a class="card-cell-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html($link_title); ?></a>
              <?php endif; ?>
            </div>  		
          </div>
          <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>