<?php
$cards = get_sub_field('cards');
$per_row = get_sub_field('cards_per_row');

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

<div class="fc-section-columns fc-section-cards">

  <div class="row padding-row" data-equalizer>
    <?php get_template_part('flexible/section_header'); ?>
    

    <?php foreach( $cards as $card ): ?>

      <div class="<?php echo $class; ?>">
        <div class="content content-cards" data-equalizer-watch>

            <div class="card-image">
                <?php $image = wp_get_attachment_image($card['card_icon'], 'thumbnail'); ?>
                
                <?php if( $image ): ?>
                    <div class="card-image-inner">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

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

      <?php endforeach; ?>

      
    </div>

</div>