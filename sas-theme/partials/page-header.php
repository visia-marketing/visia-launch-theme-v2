<?php 
  $image = get_field('page_header_image');
  $size = 'full'; // (thumbnail, medium, large, full or custom size)
?>
<header class="page-header <?php if( $image ) { echo 'page-header-image'; } else { echo 'page-header-no-image'; }?>">
  <?php 
  if( $image ) {
      echo wp_get_attachment_image( $image, $size, false, array( "class" => "page-header-image" ) );
  }
  ?>
  <div class="page-header-content-wrapper">
    <div class="row">
      <div class="small-12 columns">
        <div class="page-header-content">
          <?php 
          $header_content = get_field('page_header_content');
          if ( $header_content ): 
          ?>
            <?php if ( !empty($header_content['page_header_subtitle']) ): ?>
              <span class="g-section-subtitle">
                <?php echo esc_html($header_content['page_header_subtitle']); ?>
              </span>
            <?php endif; ?>
            <h1 class="g-section-title">
              <?php if ( $header_content['page_header_title'] ): echo esc_html($header_content['page_header_title']); else: the_title(); endif; ?>
            </h1>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>