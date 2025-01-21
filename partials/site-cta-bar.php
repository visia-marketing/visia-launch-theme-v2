<?php 

$hide_cta = get_field('hide_cta');
if ( get_field('cta_background_image') ): $cta_background_image = get_field('cta_background_image'); else: $cta_background_image = get_field('cta_background_image', 'options'); endif;
if ( get_field('cta_content') ): $cta_content = get_field('cta_content'); else: $cta_content = get_field('cta_content', 'options'); endif;
if ( get_field('cta_link') ): $cta_link = get_field('cta_link'); else: $cta_link = get_field('cta_link', 'options'); endif;

?>

<?php if( ! $hide_cta):?>
<section class="cta-bar">
	<div class="row">
		<div class="small-12 medium-8 columns">
			<div class="row" data-equalizer>
		   	<div class="small-12 medium-8 columns">
			   <?php echo $cta_content; ?>
		   	</div>
				<div class="small-12 medium-4 columns">
					<?php if( $cta_link ): 
						$link_url = $cta_link['url'];
						$link_title = $cta_link['title'];
						$link_target = $cta_link['target'] ? $link['target'] : '_self';
						?>
						<a class="button large" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
		   	</div>
		  </div>
		</div>
  </div>
	<?php if( !empty( $cta_background_image ) ): ?>
		<img src="<?php echo esc_url($cta_background_image['url']); ?>" alt="<?php echo esc_attr($cta_background_image['alt']); ?>" class="cta-bar-background" />
	<?php endif; ?>
</section>
<? endif; ?>