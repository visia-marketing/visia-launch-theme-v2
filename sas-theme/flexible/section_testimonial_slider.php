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
                    <div class="row columns slider-navigation-container">
                        <div class="slider-navigation-arrows">

                            <button class="slider-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="51" height="50" viewBox="0 0 51 50" fill="none">
                                    <circle cx="25" cy="25" r="24" transform="matrix(-1 0 0 1 50 0)" stroke="#86AB3C" stroke-width="2"/>
                                    <path d="M24.5225 17.2881C24.131 16.8988 23.5027 16.9047 23.1191 17.3018L16.291 24.375C15.9077 24.7724 15.9142 25.4105 16.3057 25.7998L23.2705 32.7266C23.662 33.1159 24.2902 33.1098 24.6738 32.7129C25.0574 32.3156 25.0508 31.6776 24.6592 31.2881L19.2256 25.8838H32C32.5523 25.8838 33 25.4361 33 24.8838C33 24.3315 32.5523 23.8838 32 23.8838H19.5449L24.5371 18.7129C24.9207 18.3156 24.914 17.6776 24.5225 17.2881Z" fill="#86AB3C"/>
                                </svg>
                            </button>
                            <button class="slider-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="50" viewBox="0 0 52 50" fill="none">
                                    <circle cx="26.241" cy="25" r="24" stroke="#86AB3C" stroke-width="2"/>
                                    <path d="M26.7185 17.2881C27.11 16.8988 27.7382 16.9047 28.1218 17.3018L34.95 24.375C35.3332 24.7724 35.3268 25.4105 34.9353 25.7998L27.9705 32.7266C27.579 33.1159 26.9508 33.1098 26.5671 32.7129C26.1835 32.3156 26.1902 31.6776 26.5818 31.2881L32.0154 25.8838H19.241C18.6887 25.8838 18.241 25.4361 18.241 24.8838C18.241 24.3315 18.6887 23.8838 19.241 23.8838H31.696L26.7039 18.7129C26.3203 18.3156 26.3269 17.6776 26.7185 17.2881Z" fill="#86AB3C"/>
                                </svg>
                            </button>
                            <div class="slide-index"></div>

                        </div>
                        
                    </div>
                </div>
            </div>



        </div>

    </div>


</div>