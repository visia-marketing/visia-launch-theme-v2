<article class="post-archive">


<section class="fc-section" id="archive-header">
    <div class="fc-section-columns">
        <div class="row padding-row">
            <div class="small-12 medium-6 columns">
                <div class="content content-columns">
                <h1><?php echo get_queried_object()->label; ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>



  <section class="fc-section-columns fc-section-cards">
    <div class="row " data-equalizer data-equalize-by-row="true">
      
      <?php if (!have_posts()) : ?>
        <div class="alert alert-warning">
          <?php _e('Sorry, no results were found.', 'visia_starter_theme'); ?>
        </div>
        <?php get_search_form(); ?>
      <?php endif; ?>

      <?php while (have_posts()) : the_post(); ?>
        <div class=" small-12 medium-4 columns">
            <div class="content content-cards" data-equalizer-watch>

                <div class="card-image">
                    <div class="card-image-inner">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'medium'); ?>
                    </div>
                </div>

                <h3 class="card-title">
                    <a href="<?php echo get_the_permalink( get_the_ID() ); ?>">
                        <?php echo get_the_title( get_the_ID() ); ?>
                    </a>
                </h2>
            
                <p class="card-p">
                    <?php echo get_the_excerpt( get_the_ID() ); ?>   
                </p>

                <a href="<?php echo get_permalink( get_the_ID() ); ?>">
                    Read More
                </a>
                    
            
            </div>
        </div>
      <?php endwhile; ?>

      <?php the_posts_navigation(); ?>

    </div>
  </section>

</article>



