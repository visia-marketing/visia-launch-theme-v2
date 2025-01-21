<?php
//$top_border = (get_sub_field('top_border') === 'yes') ? "top-border" : "";
//$anchor = get_sub_field('section_heading') ? create_anchor(get_sub_field('section_heading')) : '';
?>

<div class="fc-section-navigation" id="<?php //echo $anchor;?>">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="fc-section-navigation row columns "> 
    <div class="row columns">
      <?php if( have_rows('navigation') ): ?>
        <nav>
          <ul>
          <?php while( have_rows('navigation') ) : the_row(); ?>
            <li>
            <?php  
              $link = get_sub_field('navigation_item');
              if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $link_title; ?></a>
              <?php endif; ?>
            </li>  
          <?php endwhile; ?>
          </ul> 
        </nav>  
      <?php endif; ?>
    </div>
  </div>
</div>