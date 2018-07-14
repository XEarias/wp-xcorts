<?php $escorts = get_query_var('escorts'); ?>

<section class="escorts-container container-fluid">
    <div class="row">
    <?php foreach($escorts as $key => $escort): ?>
    
        <?php $langs = $escort["basic_info"]["langs"]; ?>
        <div data-escort-id="<?php echo $escort['ID'];?>" class="escort-item col-md-2 <?php echo ($key == 0 or $key == 5) ? 'offset-md-1' : '';?>">
            <a href="<?php echo $escort['url'];?>">
                <div class="escort-item-internal">
                    <svg viewBox="0 0 100 170" class="hidden-background escort-item-internal-image"
                    style="background-image: url(<?php echo $escort['image'];?>"
                    data-images="<?php echo str_replace('"', "\'", json_encode(['https://img1.hottescorts.es/guia-55079.jpg','https://img1.hottescorts.es/guia-61615.jpg','https://img1.hottescorts.es/guia-61144.jpg','https://img1.hottescorts.es/guia-53165.jpg'], JSON_FORCE_OBJECT)); ?>"
                    data-image-index="0">
                    </svg>
                    <div class="escort-info-container">
                        <div class="escort-info-header">
                            <div class="escort-info-header-left">
                                <a href="#" class="escort-info-header-link" style="color: #666;"><strong><?php echo $escort['name'];?></strong></a>
                                <br>
                                <p>Ciudad</p>
                            </div>
                            <div class="escort-info-header-right">
                                <p class="escort-info-header-time">
                                    <span class="escort-principal-rate"><strong><?php echo ($escort['principal_rate']["value"]) ? $escort['principal_rate']["value"] : "CONSULTAR";?></strong></span>
                                    <br>
                                    <?php echo $escort['principal_rate']["label"];?>
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

                                    <?php $last_lang = end($langs); ?>
                                    <?php foreach($langs as $lang): ?>

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
       
    <?php endforeach; ?>
    </div>
</section>
