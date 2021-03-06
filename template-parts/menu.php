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

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nb" aria-controls="nb" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="nb">
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
    
    <?php if(is_user_logged_in()): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $account_url; ?>" style="padding: 0 1rem;">
                <button class="btn my-2 my-sm-0" style="background-color: rgb(255, 51, 153) !important; color: white; font-size: 14px; font-weight: bold;">MI CUENTA</button>
            </a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $login_url; ?>" style="padding: 0 1rem;">
                <button class="btn my-2 my-sm-0" style="background-color: white !important; color: black; font-size: 14px; font-weight: bold;">INGRESA</button>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo $subscription_url; ?>" style="padding: 0 1rem;">
                <button class="btn my-2 my-sm-0" style="background-color: rgb(255, 51, 153) !important; color: white; font-size: 14px; font-weight: bold;">ANUNCIATE</button>
            </a>
            </a>
        </li>
    <?php endif; ?>
    </ul>
  </div>

</nav>