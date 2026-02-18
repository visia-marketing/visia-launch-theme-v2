<?php
$cards = get_sub_field('cards');
$display = get_sub_field('cards_display'); // Grid or Slider
$per_row = get_sub_field('cards_per_row'); // 3, 4, 5

$aos = get_sub_field('animate_in');
$aos_duration = 0;
$aos_step = 0;


$class = 'columns cards cards-style--'.$card_style;
$rand_id = $display . '_' . wp_generate_uuid4();

if ($aos == 'no_animation') {
    $aos = false;
}else{
    $aos_duration = get_sub_field('duration');
    $aos_step = get_sub_field('animation_step');

}

$class = 'columns cards';

switch ($per_row) {
    case 2:
        $class .= ' small-12 medium-6';
        break;
    case 3:
        $class .= ' small-12 medium-4';
        break;
    case 4:
        $class .= ' small-12 medium-3';
        break; 
    default:
        $class .= ' small-12 medium-4'; // Default to 3 per row
}


?>

<div class="fc-section-columns fc-section-cards" id="<?php echo $rand_id;?>">

  <div class="row padding-row" data-equalizer>
    <?php get_template_part('flexible/section_header'); ?>
    

    <?php if($display == "carousel"): ?><div class="carousel-wrapper"  data-slides-to-show="<?php echo $per_row; ?>" data-duration="<?php echo $aos_duration; ?>" data-step="<?php echo $aos_step; ?>"> <?php endif; ?>
        <?php $delay = 0; ?>

        <?php foreach( $cards as $card ): ?>

        <?php $delay += $aos_step; ?>
        <div class="<?php echo $class; ?>" <?php if($aos != false): ?>data-aos="<?php echo $aos; ?>" data-aos-duration="<?php echo $aos_duration; ?>" data-aos-delay="<?php echo $delay; ?>"<?php endif; ?>> 
            <div class="content content-cards" data-equalizer-watch>

                <div class="card-image">
                    <?php $image = wp_get_attachment_image($card['card_icon'], 'thumbnail'); ?>
                    
                    <?php if( $image ): ?>
                        <div class="card-image-inner">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="content-cards--inner">

                    <h3 class="card-title">
                        <a href="<?php echo $card['card_link']; ?>">
                            <?php echo $card['card_title']; ?>
                        </a>
                    </h3>
                
                    <p class="card-p">
                        <?php echo $card['card_description']; ?>
                    </p>

                    <?php if( array_key_exists( 'card_link', $card) ): ?>
                        <?php if( is_array( $card['card_link']) ): ?>
                            <a href="<?php echo $card['card_link']['url']; ?>">
                                <?php if($card['card_link']['title']): ?>
                                    <?php echo $card['card_link']['title']; ?>
                                <?php else: ?>
                                    Read More
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>


                </div>



            
            </div>
        </div>
        <?php
            if ($delay >= ($aos_step * $per_row)) {
                $delay = 0;
            }
        ?>

        <?php endforeach; ?>

        
        </div>
    <?php if($display == "carousel"): ?></div> <?php endif; ?>

</div>

<?php if($display == "carousel"): ?>

    <style>

        #<?php echo $rand_id;?> .carousel-wrapper .slick-prev:before,
        #<?php echo $rand_id;?> .carousel-wrapper .slick-next:before{
            content: '' !important;
        }

        #<?php echo $rand_id;?> .carousel-wrapper svg *{
            stroke: #072E6E;
        }

    </style>
<?php endif; ?>