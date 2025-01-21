<article class="page page-<?php global $post; echo $post->post_name; ?>">

  <?php get_template_part('templates/page-header'); ?>
  
  <section class="page-content-wrapper">
    <div class="row">
      <div class="small-12 columns">
        
      <div class="alert alert-warning">
        <?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?>
      </div>

      <?php get_search_form(); ?>
        
      </div>
    </div>
  </section>

</article>
