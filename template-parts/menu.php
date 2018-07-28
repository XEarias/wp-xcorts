<?php 
GLOBAL $subscription_slug, $account_slug, $login_slug;

$menu_items = get_single_menu("principal-menu");

$subscription_page = get_page_by_path($subscription_slug);
$subscription_url = get_page_link($subscription_page->ID);

$account_page = get_page_by_path($account_slug);
$account_url = get_page_link($account_page->ID);

$login_page = get_page_by_path($login_slug);
$login_url = get_page_link($login_page->ID);

?>

<nav class="navbar navbar-expand-lg navbar-dark  bg-dark" style="background-color: black !important;" id="principal-menu">
  <?php get_template_part('template-parts/custom-logo'); ?>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto" style="margin: auto;">
    <?php if($menu_items):?>
        <?php foreach($menu_items as $key => $menu_item):?>
            
            <?php if(!$menu_item->childrens or !count($menu_item->childrens)): ?>
            <li class="nav-item nav-item-<?php echo $menu_item->ID;?> <?php echo implode(" ", $menu_item->classes);?>">
                <a class="nav-link" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
            </li>
            <?php else: ?>

            <?php $item_childrens = $menu_item->childrens;?>

            <li class="nav-item dropdown nav-item-<?php echo $menu_item->ID;?> dropdown <?php echo implode(" ", $menu_item->classes);?>">
                <a class="nav-link dropdown-toggle" href="<?php echo $menu_item->url; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $menu_item->title; ?>
                </a>
                <div class="dropdown-menu">
                <?php foreach($item_childrens as $item_children):?>
                    <a class="dropdown-item" href="<?php echo $item_children->url; ?> <?php echo implode(" ", $menu_item->classes);?>"><?php echo $item_children->title ?></a>
                <?php endforeach;?>
                </div>
            </li>
            <?php endif;?>

        <?php endforeach;?>
    <?php endif; ?>
    </ul>

    <?php if(is_user_logged_in()): ?>
        <a href="<?php echo $account_url; ?>">
        <button class="btn my-2 my-sm-0" style="background-color: rgb(255, 51, 153) !important; color: white; font-size: 14px; font-weight: bold;">MI CUENTA</button>
        </a>
    <?php else: ?>
        <a href="<?php echo $login_url; ?>">
            <button class="btn my-2 my-sm-0" style="background-color: white !important; color: black; font-size: 14px; font-weight: bold;margin-right: 5px;">INGRESA</button>
        </a>

        <a href="<?php echo $subscription_url; ?>">
        <button class="btn my-2 my-sm-0" style="background-color: rgb(255, 51, 153) !important; color: white; font-size: 14px; font-weight: bold;">ANUNCIATE</button>
        </a>
    <?php endif; ?>
  </div>

</nav>