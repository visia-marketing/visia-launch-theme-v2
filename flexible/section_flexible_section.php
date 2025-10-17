<?php if (have_rows('flexible_section')): ?>
    <?php while (have_rows('flexible_section')) : the_row(); ?>

        <?php $row_fields = get_row(); ?>
        <?php get_template_part('flexible/' . $row_fields['acf_fc_layout']); ?>

    <?php endwhile; ?>
<?php endif; ?>