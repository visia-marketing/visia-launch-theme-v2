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
                <?php if( $card['post_object_tf'] ): ?>
                    <?php $image = get_the_post_thumbnail($card['case_study_id'], 'medium'); ?>
                <?php else: ?>
                    <?php $image = wp_get_attachment_image($card['card_icon'], 'medium'); ?>
                <?php endif; ?>
                
                <?php if( $image ): ?>
                    <div class="card-image-inner">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <h3 class="card-title">
                <?php if( $card['post_object_tf'] ): ?>
                    <a href="<?php echo get_permalink($card['case_study_id']); ?>">
                        <?php echo get_the_title($card['case_study_id']); ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo $card['card_link']; ?>">
                        <?php echo $card['card_title']; ?>
                    </a>
                <?php endif; ?>
            </h2>
        
            <p class="card-p">
                <?php if( !$card['post_object_tf'] ): ?>
                    <?php echo $card['card_description']; ?>
                <?php else: ?>
                    <?php echo get_the_excerpt($card['case_study_id']); ?>
                <?php endif; ?>
            </p>


                <?php if( $card['post_object_tf'] ): ?>
                    <a href="<?php echo get_permalink($card['case_study_id']); ?>">
                        Read More
                    </a>
                <?php else: ?>
                    <a href="<?php echo $card['card_link']['url']; ?>">
                        <?php if($card['card_link']['title']): ?>
                            <?php echo $card['card_link']['title']; ?>
                        <?php else: ?>
                            Read More
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
        
        </div>
      </div>

      <?php endforeach; ?>

      
    </div>

</div>