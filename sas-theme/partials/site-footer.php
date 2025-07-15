<?php /*
$footer_form = get_field('footer_form');
if ( $footer_form && (!empty($footer_form['heading']) || !empty($footer_form['title']) || !empty($footer_form['form_id'])) ): ?>
  <div class="site-footer-form">
    <div class="row columns">
      <?php if ( $footer_form['heading'] ): echo '<h2 class="g-style-section-heading">' . $footer_form['heading'] . '</h2>'; endif; ?>
      <?php if ( $footer_form['title'] ): echo '<h3 class="g-style-section-title">' . $footer_form['title'] . '</h3>'; endif; ?>
      <?php echo do_shortcode('[gravityform id="' . $footer_form['form_id'] . '" title="false"]');?>
    </div>
  </div>
<?php endif; */ ?>

<footer class="main-footer">
  <div class="row">   
    <div class="small-12 medium-8 columns">
      <div class="footer-logo">
        <a href="<?= esc_url(home_url('/')); ?>"><img src="<?php the_field('footer_logo', 'option');?>" alt="<?php bloginfo('name'); ?>"></a>
        <span class="footer-site-description"><?php echo get_bloginfo('description');?></span>
      </div>
    </div>
    <div class="small-12 medium-2 columns footer-menu">   
      <?php
      if (has_nav_menu('footer_navigation_1')) :
      wp_nav_menu(['theme_location' => 'footer_navigation_1', 'depth' => 2, 'menu_class' => 'footer-menu' ]); 
      endif;
      ?>
    </div>
    <div class="small-12  medium-2 columns footer-contact">
      <?php echo get_field('footer_contact', 'options');?>
    </div>
  </div>

  <div class="row columns footer-bottom">
    <div class="footer-copyright">
      <div class="copyright">
        <?php echo get_field('copyright', 'options');?>
      </div>
      <?php
        if (has_nav_menu('footer_navigation_legal')) :
        wp_nav_menu(['theme_location' => 'footer_navigation_legal', 'depth' => 1, 'menu_class' => 'footer-menu-legal' ]); 
        endif;
      ?>
    </div>
  </div>
 
</footer>