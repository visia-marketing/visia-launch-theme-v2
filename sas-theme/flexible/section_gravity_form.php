<div class="fc-section-gravity-form">
  <?php get_template_part('flexible/section_header'); ?>
  <div class="row">
    <div class="small-12 large-10 columns">
      <?php echo do_shortcode('[gravityform id="' . get_sub_field('gf_form_id') . '" title="false"]');?>
    </div>
  </div>
</div>