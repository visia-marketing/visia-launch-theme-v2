<?php while (have_posts()) : the_post(); ?>
  
<article class="home-page">
  
  <section class="home-hero">
    <div class="home-hero-slides">
      
    <?php if( have_rows('hero_slides') ): ?>
    <?php while( have_rows('hero_slides') ): the_row(); ?>
      <div class="home-hero-slide">
        <?php
        $image = get_sub_field('hero_background_image');
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        if ($image) {
            echo wp_get_attachment_image($image, $size, false, array("class" => "hero-slide-background"));
        }
        ?>
        
        <div class="row">
          <div class="small-12 medium-6 large-5 columns">
            <div class="hero-slide-content">
              <?php echo get_sub_field('hero_content');?>
            </div>
          </div>
        </div>

      </div>          
    <?php endwhile; ?>
    <?php endif; ?>

    </div>
  </section>

  <?php get_flexible_content(); ?>

</article>
  
<?php endwhile; ?>