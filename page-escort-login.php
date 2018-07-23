<?php get_header(); ?>

<section class="escort-login-container container-fluid pt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4 login-box">
            <?php
                $page = get_page_by_path($account_slug);
                $page_url = get_page_link($page->ID);
                wp_login_form(['redirect' => $page_url]);
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>