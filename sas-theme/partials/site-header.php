<?php if (has_nav_menu('top_navigation')) : ?>
<div class="top-header">
	<div class="row">
		<div class="small-12 columns">
      <div class="top-header-flex">
        <?php
          wp_nav_menu(['theme_location' => 'top_navigation', 'depth' => 1, 'menu_class' => 'top-header-navigation top-header-navigation-right']); 
        ?>
      </div>
		</div>
	</div>
</div>
<?php endif; ?>

<header class="main-header">
	<div class="row" data-equalizer>
    <div class="small-6 medium-4 columns" data-equalizer-watch>
      <div class="main-logo">
        <a href="<?= esc_url(home_url('/')); ?>"><img src="<?php the_field('main_logo', 'option');?>" alt="<?php bloginfo('name'); ?>"></a>
      </div>
    </div>
    <div class="small-2 small-offset-4 medium-1 medium-offset-7 columns hide-for-large menu-icon-column" data-equalizer-watch>
      <button class="menu-icon" type="button" data-open="off-canvas-menu"></button>
		</div>
    <div class="small-4 medium-8 columns show-for-large">
      <div class="primary-navigation-wrapper">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'depth' => 2, 'menu_class' => 'vertical medium-horizontal menu primary-navigation', 'items_wrap' => '<ul class="%2$s" id="primary-navigation" data-responsive-menu="drilldown medium-dropdown">%3$s</ul>' ]); 
          endif;
        ?>
      </div>
    </div>
  </div>
</header>