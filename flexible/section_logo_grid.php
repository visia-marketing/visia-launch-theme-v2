<?php
$logos_per_row = get_sub_field('logos_per_row');
?>

<div class="fc-section-cards .fc-section-cards-logos">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns "> 
    <div class="card-grid card-grid-logos card-grid-<?php echo $logos_per_row; ?> ">
      <?php
      if( have_rows('logos') ):
        while( have_rows('logos') ) : the_row();
          ?>
            <a href="<?php echo get_sub_field('url');?>" target="_blank" class="card-cell card-cell-logo">
            <?php
              $image = get_sub_field('logo');
              $size = 'full'; // (thumbnail, medium, large, full or custom size)
              if( $image ) {
                  echo wp_get_attachment_image( $image, $size, false, array( "class" => "" )  );
              }
            ?>  
            </a>
          <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>