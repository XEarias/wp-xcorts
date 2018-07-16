<div class="custom-logo-container">
    <?php if(!has_custom_logo()) : ?>
        <a class="custom-logo-link" href="<?php echo get_home_url(); ?>">
            <img height="60" class="custom-logo" src="<?php echo get_template_directory_uri() . '/assets/img/logo-principal.png'; ?>" />
        </a>
    <?php else: ?>
        <?php echo get_custom_logo(); ?>
    <?php endif; ?>
</div>