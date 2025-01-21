<?php
$cards_per_row = get_sub_field('cards_per_row');
?>

<div class="fc-section-cards fc-section-cards-videos">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row columns">
  <?php if ( get_sub_field('videos_name') ) : echo '<h3 class="card-grid-title">' . esc_html(get_sub_field('videos_name')) . '</h3>'; endif; ?>
    <?php $post_objects = get_sub_field('videos'); ?>  
    <?php if( $post_objects ): ?> 
      <?php $i=1; ?>
      <div class="card-grid card-grid-<?php echo $cards_per_row;?> card-grid-videos">
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <a target="_blank" title="<?php the_title();?>" data-post-id="<?php echo get_the_ID(); ?>" data-open="video-modal" class="card-cell card-cell-video">
          <div class="card-cell-video-thumb">  
            <?php the_post_thumbnail( 'medium' );?>
          </div>
          <div class="card-cell-content">
            <span><?php the_title(); ?></span>
          </div>
        </a>
        <!-- Video Modal -->
        <div class="reveal medium" id="video-modal" data-reveal>
          <div class="responsive-embed widescreen" id="modal-video-content">
            <!-- AJAX content will load here -->
          </div>
          <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php $i++;?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const videoLinks = document.querySelectorAll('.card-cell-video');

  videoLinks.forEach(link => {
    if (link.getAttribute('data-listener-added') === 'true') return;

    link.setAttribute('data-listener-added', 'true');

    link.addEventListener('click', function (event) {
      event.preventDefault();

      const postId = this.getAttribute('data-post-id');
      console.log('Fetching content for post ID:', postId);

      const modal = jQuery('#video-modal'); // Use jQuery to select modal
      const modalContent = jQuery('#modal-video-content'); // Use jQuery for modal content

      // Clear previous content and show loading spinner
      modalContent.html('<p>Loading...</p>');

      const ajaxurl = '/wp-admin/admin-ajax.php';

      // Fetch video content via AJAX
      fetch(`${ajaxurl}?action=load_video_content&post_id=${postId}`)
        .then(response => response.text())
        .then(data => {
          // Insert content and open modal
          modalContent.html(data);
          modal.foundation('open'); // Open the modal using jQuery-style method
        })
        .catch(error => {
          console.error('Error loading video content:', error);
          modalContent.html('<p>Error loading content. Please try again.</p>');
        });
    });
  });
});
</script>

<style>
.reveal {
  display: none; /* Initial state */
}

.reveal.is-active {
  display: block; /* When opened */
  aria-hidden: false;
}
</style>