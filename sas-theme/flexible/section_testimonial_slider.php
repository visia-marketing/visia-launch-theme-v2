<?php $testimonials = get_sub_field('testimonials'); 

// print_r( $testimonials);
?>
<div class="padding-row">
    <div class="fc-section-content-testimonial-slider content-testimonial-slider-wrapper" id="slider-<?php echo uniqid(); ?>">

        <div class="content-testimonial-slider-container row">

            <div class="slider-inner columns">
                <div class="content-testimonial-slider-header">

                    <div class="row columns">
                        <?php if ( get_sub_field( 'slider_headline' ) ): ?>
                            <h2 class="content-testimonial-slider-title"><?php echo esc_html( get_sub_field( 'slider_headline' ) ); ?></h2>
                        <?php endif; ?>

                        <svg xmlns="http://www.w3.org/2000/svg" width="154" height="104" viewBox="0 0 154 104" fill="none">
                            <path d="M31.8259 0.222656L14.3766 29.9262C4.11239 47.226 0.348831 56.3656 0.348831 68.4429C0.348831 88.6804 15.7452 103.369 37.3001 103.369C57.4865 103.369 73.5672 88.6804 73.5672 68.4429C73.5672 52.7751 60.5658 39.3922 44.143 39.3922H43.8008L68.7772 0.222656L31.8259 0.222656ZM112.229 0.222656L94.78 29.9262C84.5157 47.226 80.7521 56.3656 80.7521 68.4429C80.7521 88.6804 96.1485 103.369 117.703 103.369C137.89 103.369 153.97 88.6804 153.97 68.4429C153.97 52.7751 140.969 39.3922 124.546 39.3922H124.204L149.18 0.222656L112.229 0.222656Z" fill="#86AB3C"/>
                        </svg>
                    </div>

                    </div>

                    <?php if( $testimonials ): ?>
                    <div class="content-testimonial-slider-slides">
                        <?php foreach ( $testimonials as $slide ): ?>
                            <div class="content-testimonial-slider-slide">
                                <div class="row" >

                                    <div class="small-12 columns">
                                        <div class="content-testimonial-slider-content">
                                            <?php if ( $slide ): ?>
                                                <div class="testimonial-content">
                                                    <?php if ( $slide['testimonial_text'] ): ?>
                                                        <p><?php echo esc_html( $slide['testimonial_text'] ); ?></p>
                                                    <?php endif; ?>

                                                    <?php if ( $slide['name'] ): ?>
                                                        <span class="testimonial-author"><?php echo esc_html( $slide['name'] ); ?></span><span class="testimonial-title"><?php echo esc_html( $slide['title'] ); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                <div class="content-testimonial-slider-navigation">
                    <div class="row columns">
                        <button class="slider-prev"><i class="fa-regular fa-chevron-left"></i></button>
                        <button class="slider-next"><i class="fa-regular fa-chevron-right"></i></button>
                        <div class="slide-index"></div>
                    </div>
                </div>
            </div>



        </div>

    </div>


</div>