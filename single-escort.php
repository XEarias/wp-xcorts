<?php get_header(); ?>

<?php  while ( have_posts() ) : the_post(); ?>

    <?php $escort = get_escort($post->ID); ?>

<?php endwhile;?>

<section class="single-escort-container container pt-5">
    <div class="row">

        <div class="col-md-12 pt-5 pb-5 bg-primary">
            <h5 class="text-center pt-5 pb-5 mt-5 mb-5">IMAGENES</h5>            
        </div>
    
    </div>

    <div class="row">

        <div class="col-md-8 pt-4 pb-2 pl-0 pr-0">
            <h2 class="single-escort-name"><?= $escort['name'] ?></h2>
            <?php if(count($escort['zone'])): ?>
                <p class="single-escort-link"><a href="<?= $escort['zone'][0]['url'] ?>">Escorts en <strong><?= $escort['zone'][0]['name'] ?></strong></a></p>
            <?php else: ?>
                <p class="single-escort-link"><a href="<?= home_url() ?>">Ver mas <strong>chicas</strong></a></p>
            <?php endif; ?>
        </div>
        <div class="col-md-4 pt-4 pb-2 pl-0 pr-0 text-right"> 
            <span class="single-escort-phone">
                123-234-XXX <span>MOSTRAR</span>
            </span>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 pt-4 pb-2 pl-0 pr-0">
            <h4 style="color:#F39" class="text-center">¡Tu guía de putas de lujo!</h4>
            <p style="text-align: justify; font-size: 13px;"><?= $escort['description'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 pl-0 pr-3 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">INFORMACION Y DATOS</div>
                <ul>
                    <li>Edad <span><?= $escort['basic_info']['age'] ?> años</span></li>
                    <li>
                        Idiomas 
                        <span>
                            <?php $langs = $escort["basic_info"]["langs"]; ?>
                            <?php $last_lang = end($langs); ?>
                            <?php foreach($langs as $lang): ?>

                                <?php 
                                    echo $lang;
                                    echo ($lang === $last_lang) ? "" : ",";
                                ?>

                            <?php endforeach;?>    
                        </span>
                    </li>
                    <li>Color de pelo <span><?= $escort['basic_info']['hair_color'] ?></span></li>
                    <li>Color de ojos <span><?= $escort['basic_info']['skin_color'] ?></span></li>
                    <li>Estatura <span><?= $escort['basic_info']['stature'] ?></span></li>
                    <li>Peso <span><?= $escort['basic_info']['weight'] ?></span></li>
                    <li>
                        Medidas
                        <span>
                            <?php $measures = $escort["basic_info"]["measure"]; ?>
                            <?php foreach($measures as $k => $measure): ?>

                                <?php 
                                    echo $measure;
                                    echo ($k === 'hip') ? "" : " - ";
                                ?>

                            <?php endforeach;?>    
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 pl-3 pr-3 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">SERVICIOS</div>
                <?php $services = $escort["services"]; ?>
                <?php foreach($services as $service): ?>

                    <p class="single-escort-service-tag"> <a href="<?= $service['url']; ?>"><?= $service['name']; ?></a> </p>

                <?php endforeach;?>    
            </div>
        </div>
        <div class="col-md-4 pl-3 pr-0 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">TARIFAS</div>
                <ul>
                    <?php $rates = $escort["rates"]; ?>
                    <?php foreach($rates as $rate): ?>

                        <li><?= $rate['label'] ?> <span><?php if($rate['value']){ echo $rate['value']; } else { echo 'CONSULTAR'; } ?></span></li>

                    <?php endforeach;?>     
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pt-4 pb-2 pl-0 pr-0">
            <h5 class="text-center">Si las fotos de esta ficha son falsas, puedes denunciarlas aquí. ¿Dónde has visto estas fotos?</h5>
            <div>
                <form class="form-inline" style="justify-content: center;">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="denuncia" placeholder="https://">
                    </div>
                    <button type="submit" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">DENUNCIAR</button>
                </form>
            </div>
            <div class="mt-4 mb-4" style="background-color: #EDEDED; height: 5px;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">VER MAS PUTAS</a>
        </div>
    </div>

</section>

<?php get_footer(); ?>