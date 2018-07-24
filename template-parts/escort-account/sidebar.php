<ul class="escort-account-sidebar list-group">
    <li class="list-group-item <?php if ($_GET['p'] == 'dash'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=dash'; ?>">DASHBOARD</a>
    </li>
    <li class="list-group-item <?php if ($_GET['p'] == 'info'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=info'; ?>">Mi información</a>
    </li>
    <li class="list-group-item <?php if ($_GET['p'] == 'services'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=services'; ?>">Mi zona y servicios</a>
    </li>
    <li class="list-group-item <?php if ($_GET['p'] == 'rates'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=rates'; ?>">Mis tarifas y metodos de pago</a>
    </li>
    <li class="list-group-item <?php if ($_GET['p'] == 'photos'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=photos'; ?>">Mis fotos</a>
    </li>
    <li class="list-group-item <?php if ($_GET['p'] == 'plan'): ?> active <?php endif; ?>">
        <a href="<?= get_home_url().'/escort-account?p=plan'; ?>">Mi Plan</a>
    </li>
    <li class="list-group-item">
        <?php
            $page = get_page_by_path($login_slug);
            $page_url = get_page_link($page->ID); 
        ?>
        <a href="<?= wp_logout_url( $page_url ); ?>">Salir</a>
    </li>
</ul>