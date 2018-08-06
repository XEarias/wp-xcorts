<?php $escorts = get_query_var('escorts'); ?>

<section class="escorts-container container-fluid pt-5">

    <?php $offset = 1; ?>

    <?php foreach($escorts as $key => $escort): ?>

        <?php if($offset == 1): ?>
        <div class="row">
        <?php endif; ?>

        <?php $langs_escort = $escort["basic_info"]["langs"]; ?>
        <div data-escort-id="<?php echo $escort['ID'];?>" class="escort-item col-12 col-sm-12 col-md-4 <?php echo ($offset == 1) ? 'offset-md-1' : ''; ?> col-lg-2">
            <a href="<?php echo $escort['url'];?>">
                <div class="escort-item-internal">
                    <!--IMAGEN DE PLAN-->
                    <?php if($escort["subscription"]["plan"]["badge"]): ?>
                    <img style="position: absolute;width: 25%;right: 4%;bottom: 84%;"  src="<?php echo $escort["subscription"]["plan"]["badge"]; ?>"/>
                    <?php endif;?>

                    <?php if($escort["is_new"]): ?>
                    <img style="position: absolute;width: 25%;right: 4%;bottom: 68%;"  src="<?php echo get_template_directory_uri() . '/assets/img/badges/new.png'; ?>"/>
                    <?php endif;?>

                    <?php if(count($escort["videos"])): ?>
                    <img style="position: absolute;width: 25%;right: 4%;bottom: 52%;"  src="<?php echo get_template_directory_uri() . '/assets/img/badges/video.png'; ?>"/>
                    <?php endif;?>

                    <?php 
                        $gallery_images = [];
                        foreach($escort["gallery"] as $image_gallery){
                            $gallery_images[] = $image_gallery["url"];
                        }
                    ?>

                    <?php $images_array = array_merge([$escort['image']], $gallery_images);?>
                    <svg viewBox="0 0 100 170" class="hidden-background escort-item-internal-image"
                    style="background-image: url(<?php echo $escort['image'];?>"
                    data-images="<?php echo implode(';', $images_array); ?>"
                    data-image-index="0">
                    </svg>
                    <div class="escort-info-container">
                        <div class="escort-info-header">
                            <div class="escort-info-header-left">
                                <a href="#" class="escort-info-header-link" style="color: #666;"><strong><?php echo $escort['name'];?></strong></a>
                                <br>
                                <p><?php echo (count($escort['zone'])) ? $escort['zone'][0]['name'] : "" ?></p>
                            </div>
                            <div class="escort-info-header-right">
                                <p class="escort-info-header-time">
                                    <span class="escort-principal-rate"><strong><?php echo ($escort['principal_rate']["value"]) ? $escort['principal_rate']["value"] : "CONSULTAR";?></strong></span>
                                    <br>

                                    <?php echo (is_array($escort['principal_rate']["label"])) ? $escort['principal_rate']["label"]["label"] : $escort['principal_rate']["label"];?>
                                </p>
                            </div>
                        </div>
                        <div class="escort-info-body">
                            <div class="escort-description">
                                <?php echo $escort['description'];?>
                            </div>
                            <div class="escort-extra-data">
                                <div>
                                    <b>Idiomas:</b>

                                    <?php $last_lang = end($langs_escort); ?>
                                    <?php foreach($langs_escort as $lang): ?>

                                        <?php 
                                        
                                            echo $lang;
                                            echo ($lang === $last_lang) ? "" : ",";
                                        ?>

                                    <?php endforeach;?>
                                </div>
                                <div>
                                    <b>Edad:</b>
                                    <?php echo $escort['basic_info']["age"];?> Años
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <?php if($offset == 5): ?>
        </div>
        <?php endif; ?>

        <?php if ($offset == 5) { $offset = 1; } else { $offset++; } ?>
    
    <?php endforeach; ?>
</section>
