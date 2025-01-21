<div class="fc-section-cards" id="<?php //echo $anchor; ?>">
  
  <?php get_template_part('flexible/section_header'); ?>
  
    <div class="row columns">
      <div class="card-grid card-grid-articles card-grid-3">
      
      <?php
      // Get the ACF radio field choice
      $content_type = get_sub_field('display_articles'); // Replace 'content_type' with the actual field name of your radio button
      
      if ($content_type === 'custom') {
        // If 'articles' is selected, use the provided articles logic
        $articles = get_sub_field('articles'); // ACF post object field returning IDs
        
        if ($articles && is_array($articles)) : // Ensure it's an array
          foreach ($articles as $article) :
            if (get_post_status($article) === 'publish') : // Ensure it's a published post
              $title = get_the_title($article);
              $permalink = get_permalink($article);
              $thumbnail = get_the_post_thumbnail($article, 'medium', ['class' => 'card-cell-header-image']);

              // Get the category
              $categories = get_the_category($article);
              $category_name = $categories ? esc_html($categories[0]->name) : 'Blog';

              ?>
              <div class="card-cell card-cell-article">
                <div class="card-cell-header">
                  <?php if ($thumbnail): ?>
                    <?php echo $thumbnail; ?>
                  <?php endif; ?>
                </div>
                <div class="card-cell-content">
                  <span><?php echo $category_name; ?></span>
                  <h3><?php echo esc_html($title); ?></h3>
                </div> 
                <div class="card-cell-footer">
                  <a href="<?php echo $permalink; ?>" class=""><i class="fa-sharp fa-light fa-arrow-up-right-from-square"></i></a>
                </div> 
              </div>
              <?php
            endif;
          endforeach;
        endif;
        
      } elseif ($content_type === 'recent') {
        // If 'recent' is selected, fetch the three most recent blog posts
        $recent_posts = new WP_Query([
          'posts_per_page' => 3,
          'post_status' => 'publish',
        ]);

        if ($recent_posts->have_posts()) : 
          while ($recent_posts->have_posts()) : $recent_posts->the_post();
            $title = get_the_title();
            $permalink = get_permalink();
            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'card-cell-header-image']);

            // Get the category
            $categories = get_the_category();
            $category_name = $categories ? esc_html($categories[0]->name) : 'Blog';

            ?>
            <div class="card-cell card-cell-article">
              <div class="card-cell-header">
                <?php if ($thumbnail): ?>
                  <?php echo $thumbnail; ?>
                <?php endif; ?>
              </div>
              <div class="card-cell-content">
                <span><?php echo $category_name; ?></span>
                <h3><?php echo esc_html($title); ?></h3>
              </div> 
              <div class="card-cell-footer">
                <a href="<?php echo $permalink; ?>" class=""><i class="fa-sharp fa-light fa-arrow-up-right-from-square"></i></a>
              </div> 
            </div>
            <?php
          endwhile;
          wp_reset_postdata();
        endif;

      } elseif ($content_type === 'category') {
        // If 'categories' is selected, fetch the taxonomy IDs and show the three most recent posts
        $taxonomy_ids = get_sub_field('categories'); // Replace 'taxonomy_ids' with the actual field name
        if ($taxonomy_ids && is_array($taxonomy_ids)) {
          $category_posts = new WP_Query([
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'category__in' => $taxonomy_ids, // Fetch posts by multiple taxonomy IDs
          ]);

          if ($category_posts->have_posts()) : 
            while ($category_posts->have_posts()) : $category_posts->the_post();
              $title = get_the_title();
              $permalink = get_permalink();
              $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'card-cell-header-image']);

              // Get the category
              $categories = get_the_category();
              $category_name = $categories ? esc_html($categories[0]->name) : 'Blog';

              ?>
              <div class="card-cell card-cell-article">
                <div class="card-cell-header">
                  <?php if ($thumbnail): ?>
                    <?php echo $thumbnail; ?>
                  <?php endif; ?>
                </div>
                <div class="card-cell-content">
                  <span><?php echo $category_name; ?></span>
                  <h3><?php echo esc_html($title); ?></h3>
                </div> 
                <div class="card-cell-footer">
                  <a href="<?php echo $permalink; ?>" class=""><i class="fa-sharp fa-light fa-arrow-up-right-from-square"></i></a>
                </div> 
              </div>
              <?php
            endwhile;
            wp_reset_postdata();
          endif;
        }
      }
      ?>
    </div>
  </div>

    </div>