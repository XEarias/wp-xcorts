<?php get_header(); ?>

<?php  while ( have_posts() ) : the_post(); ?>

    <?php $escort = get_escort($post->ID); ?>
    <?php $media = get_escort_ad_attachments($post->ID); ?>
<?php endwhile;?>

<section class="single-escort-container container pt-5">
    <div class="row">

        <div class="col-md-12 pt-5 pb-5" style="background-color: beige;">
            <div class="your-class">
                <div>
                    <a href="<?= $escort['image'] ?>" rel="light"><img src="<?= $escort['image'] ?>"></a>
                </div>
                <?php foreach ($media['images'] as $value) : ?>
                <div>
                    <a href="<?= $value['url'] ?>" rel="light"><img src="<?= $value['url'] ?>"></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if(count($media['videos'])): ?>
        <div class="col-md-12" style="text-align: center;margin-top: 5px;">
            <video width="400" controls style="max-width:100%">
                <source src="<?= $media['videos'][0]['url'] ?>" type="video/mp4">
                Tu navegador no soporta HTML5 video
            </video>
        </div>
        <?php endif; ?>
    
    </div>

    <!--<div class="row">
        <div class="col-md-12 pt-5 pb-5">
            <?php if($escort["subscription"]["plan"]["badge"]): ?>
            <img style=""  src="<?php echo $escort["subscription"]["plan"]["badge"]; ?>"/>
            <?php endif;?>

            <?php if($escort["is_new"]): ?>
            <img style=""  src="<?php echo get_template_directory_uri() . '/assets/img/badges/new.png'; ?>"/>
            <?php endif;?>

            <?php if(count($escort["videos"])): ?>
            <img style=""  src="<?php echo get_template_directory_uri() . '/assets/img/badges/video.png'; ?>"/>
            <?php endif;?>
        </div>
    </div>-->

    <div class="row">

        <div class="name-phone col-md-8 pt-4 pb-2 pl-0 pr-0">
            <h2 class="single-escort-name"><?= $escort['name'] ?> </h2>
            <h1 class="single-escort-name" style="visibility:hidden;height: 0;margin: 0;width: 0;
    overflow: hidden;">Escort <?= $escort['name'] ?><?php if(count($escort['zone'])): ?>, <?= $escort['zone'][0]['name'] ?><?php endif; ?>, <?= $escort['basic_info']['age'] ?> años </h1>
            <?php if(count($escort['zone'])): ?>
                <p class="single-escort-link"><a href="<?= $escort['zone'][0]['url'] ?>">Escorts en <strong><?= $escort['zone'][0]['name'] ?></strong></a></p>
            <?php else: ?>
                <p class="single-escort-link"><a href="<?= home_url() ?>">Ver mas <strong>chicas</strong></a></p>
            <?php endif; ?>
        </div>
        <div class="name-phone col-md-4 pt-4 pb-2 pl-0 pr-0 text-right"> 
            <span class="single-escort-phone">
                <?= ($escort['basic_info']['phone']['value']) ? $escort['basic_info']['phone']['value'] : 'N/A'; ?>
            </span>

            <br>

            <p style="margin-top: 30px;"><?= $escort['basic_info']['phone']['permission'] ?></p>
        </div>

    </div>

    <div class="row">
        <div class="name-phone col-md-12 pt-4 pb-2 pl-0 pr-0">
            <h4 style="color:#F39" class="text-center">¡Evas Escorts México, #VerdaderasAmigas!</h4>
            <p style="text-align: justify; font-size: 13px;"><?= ($escort['description']) ? $escort['description'] : '...' ?></p>
        </div>
    </div>

    <div class="row">
        <div class="basic-info col-md-4 pl-0 pr-3 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">INFORMACION Y DATOS</div>
                <ul>
                    <li>Edad <span><?= $escort['basic_info']['age'] ?> años</span></li>
                    <li>Pais de origen <span><?= $escort['basic_info']['origin'] ?></span></li>
                    <li>
                        Idiomas 
                        <span>
                            <?php $langs_escort = $escort["basic_info"]["langs"]; ?>
                            <?php $last_lang = end($langs_escort); ?>
                            <?php foreach($langs_escort as $lang): ?>

                                <?php 
                                    echo $lang;
                                    echo ($lang === $last_lang) ? "" : ",";
                                ?>

                            <?php endforeach;?>    
                        </span>
                    </li>
                    <li>Orientación sexual <span><?= $escort['basic_info']['sexual_orientation'] ?></span></li>
                    <li>Color de pelo <span><?= $escort['basic_info']['hair_color'] ?></span></li>
                    <li>Color de ojos <span><?= $escort['basic_info']['eyes_color'] ?></span></li>
                    <li>Color de piel <span><?= $escort['basic_info']['skin_color'] ?></span></li>
                    <li>Complexión <span><?= $escort['basic_info']['complexion'] ?></span></li>
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
        <div class="basic-info col-md-4 pl-3 pr-3 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">SERVICIOS</div>
                <?php $services = $escort["services"]; ?>
                <?php foreach($services as $service): ?>

                    <p class="single-escort-service-tag"> <a href="<?= $service['url']; ?>"><?= $service['name']; ?></a> </p>

                <?php endforeach;?>    
            </div>
        </div>
        <div class="basic-info col-md-4 pl-3 pr-0 mb-3">
            <div class="single-escort-info-card p-2">
                <div class="single-escort-info-card-header">TARIFAS</div>
                <ul>
                    <?php $rates = $escort["rates"]; ?>
                    <?php foreach($rates as $rate): ?>

                        <li><?= $rate['label'] ?> <span><?php if($rate['value']){ echo $rate['value']; } else { echo 'CONSULTAR'; } ?></span></li>

                    <?php endforeach;?>     
                    
                    <li>Dias disponibles<span><?= $escort['working_days'] ?></span></li>

                    <?php $paymethods = $escort["payment_methods"]; ?>
                    
                    <li>Metodos de pago <span>
                    <?php foreach($paymethods as $i => $pay): ?>

                        <?= ($i != 'others') ? $pay : $pay.', ' ?>

                    <?php endforeach;?></span>
                    </li>     
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pt-4 pb-2 pl-0 pr-0">
            <h5 class="text-center">Si las fotos de esta ficha son falsas, puedes denunciarlas aquí. ¿Dónde has visto estas fotos?</h5>
            <div>
                <form method="POST" action="<?php echo admin_url('/admin-post.php');?>" class="form-inline" style="justify-content: center;">
                    <input type="hidden" name="action" value="report_image"/>
                    <input type="hidden" name="id" value="<?php echo $escort["ID"]; ?>"/>
                    <?php wp_nonce_field("escort-report-image", "report_nonce"); ?>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="denuncia" name="url" placeholder="https://">
                    </div>
                    <button type="submit" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">REPORTAR</button>
                </form>
            </div>
            <div class="mt-4 mb-4" style="background-color: #EDEDED; height: 5px;"></div>
        </div>
    </div>
</section>

<?php prepare_escorts(['limit' => 5]); ?>

<?php get_template_part( 'template-parts/escort-list' ); ?>

<section class="single-escort-container container">

    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn mb-2" href="<?= $escort['zone'][0]['url'] ?>" style="background-color: #f39; color: white; border-radius:0;">VER MAS ESCORTS</a>
        </div>
    </div>

</section>

<?php get_footer(); ?>