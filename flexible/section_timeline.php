<div class="fc-section-timeline">
  <?php get_template_part('flexible/section_header'); ?>
  
  <?php if( have_rows('timeline') ): ?>  
  <div class="row columns">
    <div class="timeline">
      <?php $i = 0;?>
      <?php while( have_rows('timeline') ) : the_row(); ?>
        <div class="timeline-item <?php if($i%2 == 0): echo 'left'; else: echo 'right'; endif; ?>">
          <div class="content">
            <?php if (get_sub_field('image')){ ?>
              <?php $image = get_sub_field('image'); ?>
              <div class="image">                
                <a data-open="modal-<?php echo $image['id'];?>" class="th"><img src="<?php echo $image['sizes']['thumbnail'];?>"></a>
              </div>                
              <div id="modal-<?php echo $image['id'];?>" class="reveal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                <img src="<?php echo $image['sizes']['large'];?>">
                <h4><?php echo $image['caption']; ?></h4>
                <button class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php } ?>
            <div class="text">
              <span class="date"><?php echo get_sub_field('date'); ?></span>
              <p class="then"><?php echo get_sub_field('description'); ?></p>
            </div>
          </div>
          <div class="connector"></div>
          <img src="/wp-content/uploads/2024/12/Screenshot-2024-12-17-at-3.47.18 PM.png" class="timeline-icon" alt="Icon">
        </div>
        <?php $i++;?>
      <?php endwhile; ?>
    </div>
  </div>
  <?php endif; ?>

</div>
