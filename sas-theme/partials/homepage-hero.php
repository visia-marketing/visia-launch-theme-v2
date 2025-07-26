<?php

$img_background = get_field('img_background');
$background_url = wp_get_attachment_image_src($img_background, 'full');
$style = '';

$content = get_field('content');



if( $background_url[0] ){
    $style .= 'style="background-image: url(' . esc_url($background_url[0]) . ');"';
}

?>

<section class="fc-section fc-section--homepage-hero" <?php echo $style;?>>
    <div class="overlay"></div>

    <div class="row">

        <div class="columns">
            <?php if( array_key_exists( 'h1_headline', $content) ): ?>
                <h1>
                    <?php echo $content['h1_headline'];?>
                </h1>
            <?php endif; ?>

            <?php if( array_key_exists( 'p_text', $content) ): ?>
                <p>
                    <?php echo $content['p_text'];?>
                </p>
            <?php endif; ?>


            <?php if( array_key_exists( 'a_button', $content) ): ?>
                <div class="hero-button">
                    <a class="button" href="<?php echo $content['a_button']['url'];?>" title="<?php echo $content['a_button']['title'];?>" target="<?php echo $content['a_button']['target'];?>">
                        <?php echo $content['a_button']['title'];?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    
    </div>
</section>