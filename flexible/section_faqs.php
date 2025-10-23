<?php
$style = get_sub_field('faq_style');
$fields = get_sub_field('questions_and_answers');
$length = count($fields);

$faq_container_class = 'fc-faq-section';
$faq_class = '';
$faq_item_class = 'faq_item';

$question_class = 'faq_question';
$answer_class = 'faq_answer';

if($style == 'plain'){
    $faq_class .= 'plain-faq';
}else{
    $faq_container_class .= ' fc-section-accordion-simple';
    $faq_class .= 'accordion';
    $faq_item_class .= ' accordion-item';
    $question_class = 'accordion-topic';
    $answer_class = 'accordion-response';
    if( $style == 'separated' ){
        $faq_class .= ' separated';
    }
}

?>

<div class="fc-section-columns <?php echo $faq_container_class;?>" id="<?php //echo $anchor;?>">
 <?php get_template_part('flexible/section_header'); ?>
  <?php if( have_rows('questions_and_answers') ): ?>
  <div class="row columns "> 
    <div class="row columns">
      <div class="<?php echo $faq_class; ?>">
      <?php while ( have_rows('questions_and_answers' ) ): the_row(); ?>
          <div class="<?php echo $faq_item_class;?>">
            <div class="<?php echo $question_class; ?>"><h4><?php echo get_sub_field('question');?></h4><div class="accordion-arrow"><i class="fas fa-chevron-right"></i></div></div>
            <div class="<?php echo $answer_class; ?>"><?php echo get_sub_field('answer');?></div>
          </div>
      <?php endwhile; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>


<script type="application/ld+json">
{
    "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php while ( have_rows('questions_and_answers' ) ): the_row(); //echo get_row_index(); ?>
            
                {
                    "@type": "Question",
                    "name": "<?php echo esc_js( get_sub_field('question') ); ?>",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "<?php echo esc_js( get_sub_field('answer') ); ?>"
                    }
                }
                <?php if( $length != get_row_index()  ): ?>
                    ,
                <?php endif;?>

            <?php endwhile; ?>
        ]
}

</script>