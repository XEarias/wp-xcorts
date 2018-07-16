<?php $menu_items = get_single_menu("principal-menu");?>

<nav class="navbar navbar-expand-lg navbar-dark  bg-dark" style="background-color: black !important;" id="principal-menu">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    MENU
  </a>

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

    
    <a>
      <button class="btn my-2 my-sm-0" style="background-color: rgb(255, 51, 153) !important; color: white; font-size: 14px; font-weight: bold;">ANUNCIATE</button>
    </a>
  </div>

</nav>