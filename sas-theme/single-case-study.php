<?php while (have_posts()) : the_post(); ?>
<?php $fields = get_fields(); ?>
  
  <article class="page page-<?php global $post; echo $post->post_name; ?>">

    <?php get_template_part('templates/page-header'); ?>
		
    <section class="page-content-wrapper">
      <div class="page-content">


          <div class="case-study--header" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large');  ?>);">
            <div class="row columns">
              <div class="small-12 medium-12">

                  <div class="case-study--header-content">
                    <h1 class="case-study--title"><?php $title = get_the_title(); echo $title; ?></h1>

                    <?php if( array_key_exists('location', $fields) ): ?>
                      <span class="case-study--location"><?php echo $fields['location'];?></span>
                    <?php endif; ?>

                  </div>

              </div>
            </div>
          </div>

          <div class="row case-study--feature">
            <div class="small-12 medium-12 columns">
              <?php if( array_key_exists('headline', $fields) ): ?>
                <h2 class="case-study--headline"><?php echo $fields['headline'];?></h2>
              <?php endif; ?>

              <?php if( array_key_exists('higlights', $fields) ): ?>
                <?php if( is_array($fields['higlights']) ): ?>
                  <div class="row case-study--highlights" data-equalizer>
                    <?php foreach( $fields['higlights'] as $highlight ): ?>

                        <div class="small-12 medium-6 large-4 columns" data-equalizer-watch>
                          <img src="<?php echo $highlight['icon'];?>" height="40" alt="feature icon" />
                          <p><?php echo $highlight['description']; ?></p>
                        </div>

                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              <?php endif; ?>

            </div>
          </div>


          <?php get_template_part('flexible/section_testimonial_slider', '', array('testimonials' => $fields['testimonials']) ); ?>

          <?php if( array_key_exists('overview', $fields) ): ?>
            <div class="row case-study--overview">
              <div class="small-12 columns">
                <?php echo $fields['overview'];?>
              </div>
            </div>
          <?php endif; ?>



          <?php if( array_key_exists('gallery', $fields) ): ?>
            <div class="row case-study--gallery">
              <div class="small-12 columns">
                <?php echo do_shortcode( '[gallery ids="'.implode(',' ,$fields['gallery'] ).'"]'); // $fields['overview'];?>
              </div>
            </div>
          <?php endif; ?>



          


            </div>  
          </div>
      </div>
    </section>

  </article>
  
<?php endwhile; ?>