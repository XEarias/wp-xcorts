<?php
    GLOBAL $hair_colors, $skin_colors, $eyes_colors, $ages, $complexions, $countries, $sexual_orientations, $depilations; 

    $zones = get_escorts_zones(); 
    $services = get_escorts_services(); 


    $hair_color_g = false;
    $skin_color_g = false;
    $eyes_color_g = false;
    $complexion_g = false;
    $sexual_orientation_g = false;
    $depilation_g = false;
    $stature_g = false;
    $age_g = false;
   
    if(isset($_GET['basic_info'])){
        $hair_color_g = isset($_GET['basic_info']['hair_color']) ? $_GET['basic_info']['hair_color'] : false ;
        $skin_color_g = isset($_GET['basic_info']['skin_color']) ? $_GET['basic_info']['skin_color'] : false ;
        $eyes_color_g = isset($_GET['basic_info']['eyes_color']) ? $_GET['basic_info']['eyes_color'] : false ;
        $complexion_g = isset($_GET['basic_info']['complexion']) ? $_GET['basic_info']['complexion'] : false;
        $sexual_orientation_g = isset($_GET['basic_info']['sexual_orientation']) ? $_GET['basic_info']['sexual_orientation'] : false;
        $depilation_g = isset($_GET['basic_info']['depilation']) ? $_GET['basic_info']['depilation'] : false;
        $stature_g = isset($_GET['basic_info']['stature']) ? $_GET['basic_info']['stature'] : false;
        $age_g = isset($_GET['basic_info']['age']) ? $_GET['basic_info']['age'] : false;
    }
    
    $zone_g = isset($_GET['zone']) ? $_GET['zone'] : false;
    $origin_g = isset($_GET['origin']) ? $_GET['origin'] : false;
    $services_g = isset($_GET['services']) ? $_GET['services'] : false;
    

?>

<section class="filterbar-container container">
    <form action="<?php echo home_url();?>" method="GET">

        <input name="s" value=" " type="hidden"/>
        <div class="row" style="margin-top: 25px">
            <div class="col-md-2">
                <select name="basic_info[hair_color]" id="hair_color" class="form-control">
                    <option <?php if($hair_color_g == ''): ?>selected<?php endif; ?> value="">Color de cabello</option>
                    <?php foreach($hair_colors as $hair_color):?>
                        <option value="<?= $hair_color ?>" <?php if($hair_color_g == $hair_color): ?>selected<?php endif; ?>><?= $hair_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="basic_info[skin_color]" id="skin_color" class="form-control">
                    <option <?php if($skin_color_g == ''): ?>selected<?php endif; ?> value="">Color de piel</option>
                    <?php foreach($skin_colors as $skin_color):?>
                        <option value="<?= $skin_color ?>" <?php if($skin_color_g == $skin_color): ?>selected<?php endif; ?>><?= $skin_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="basic_info[complexion]" id="complexion" class="form-control">
                    <option <?php if($complexion_g == ''): ?>selected<?php endif; ?> value="">Complexion</option>
                    <?php foreach($complexions as $complexion):?>
                        <option value="<?= $complexion ?>" <?php if($complexion_g == $complexion): ?>selected<?php endif; ?>><?= $complexion ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="basic_info[stature]" id="stature" class="form-control">
                    <option <?php if($stature_g == ''): ?>selected<?php endif; ?> value="">Estatura</option>
                    <option <?php if($stature_g == 1): ?>selected<?php endif; ?> value="1">Hasta 1,60 mts</option>
                    <option <?php if($stature_g == 2): ?>selected<?php endif; ?> value="2">Hasta 1,70 mts.</option>
                    <option <?php if($stature_g == 3): ?>selected<?php endif; ?> value="3">Sobre 1,70 mts.</option>
                </select>
            </div>
            <div class="col-md-4 text-right">
                <a data-toggle="collapse" href="#extra-filters" role="button" aria-expanded="false" aria-controls="extra-filters" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">
                    <small> MÁS FILTROS</small>
                </a>
                <button type="submit" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">BUSCAR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="collapse pt-1" id="extra-filters">
                    <div style="width:100%; height: 1px; background-color:#999; margin: 10px 0;"></div>
                    <div class="row text-center">
                        <div class="col-md-2 form-group">
                            <select name="basic_info[age]" id="skin_color" class="form-control">
                                <option <?php if($zone_g == ''): ?>selected<?php endif; ?> value="">Edad</option>
                                <?php foreach($ages as $age):?>
                                    <option value="<?= $age ?>" <?php if($age_g == $age): ?>selected<?php endif; ?>><?= $age ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select name="origin" id="origin" class="form-control">
                                <option <?php if($origin_g == ''): ?>selected<?php endif; ?> value="">Pais de origen</option>
                                <?php foreach($countries as $country):?>
                                    <option value="<?= $country ?>" <?php if($origin_g == $country): ?>selected<?php endif; ?>><?= $country ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control" id="zone" name="zone">
                                <option <?php if($zone_g == ''): ?>selected<?php endif; ?> value="">Ciudad</option>
                                <?php foreach($zones as $zone):?>
                                    <?php if(count($zone["childs"])): ?>
                                        <?php $child_zones = $zone["childs"]; ?>
                                        <optgroup label="<?php echo $zone["name"]; ?>">
                                            <?php foreach($child_zones as $child_zone):?>
                                            <option value="<?php echo $child_zone["ID"];?>" <?php if($zone_g == $child_zone["ID"]): ?>selected<?php endif; ?>><?php echo $child_zone["name"];?></option>
                                            <?php endforeach;?>
                                        </optgroup>
                                    <?php else: ?>

                                    <option  value="<?php echo $zone["ID"];?>" <?php if($zone_g == $zone["ID"]): ?>selected<?php endif; ?>><?php echo $zone["name"];?></option>
                                    
                                    <?php endif;?>                                
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select name="basic_info[eyes_color]" id="eyes_color" class="form-control">
                                <option <?php if($eyes_color_g == ''): ?>selected<?php endif; ?> value="">Color de ojos</option>
                                <?php foreach($eyes_colors as $eyes_color):?>
                                    <option value="<?= $eyes_color ?>" <?php if($eyes_color_g == $eyes_color): ?>selected<?php endif; ?>><?= $eyes_color ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select name="basic_info[sexual_orientation]" id="sexual_orientation" class="form-control">
                                <option <?php if($sexual_orientation_g == ''): ?>selected<?php endif; ?> value="">Orientación sexual</option>
                                <?php foreach($sexual_orientations as $sexual_orientation):?>
                                    <option value="<?= $sexual_orientation ?>" <?php if($sexual_orientation_g == $sexual_orientation): ?>selected<?php endif; ?>><?= $sexual_orientation ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select name="basic_info[depilation]" id="depilation" class="form-control">
                                <option <?php if($depilation_g == ''): ?>selected<?php endif; ?> value="">Depilación</option>
                                <?php foreach($depilations as $depilation):?>
                                    <option value="<?= $depilation ?>" <?php if($depilation_g == $depilation): ?>selected<?php endif; ?>><?= $depilation ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            Servicios:
                        </div>
                        <div class="col-md-6 form-group">
                            <?php foreach($services as $service):?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="services[]" id="<?php echo $service["name"];?>" value="<?php echo $service["ID"];?>" <?php if($services_g) { echo (in_array($service["ID"], $services_g)) ? "checked='checked'" : ""; } ?>>
                                    <label class="form-check-label" for="<?php echo $service["name"];?>">
                                        <?php echo $service["name"];?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php
/*Color Cabello , Color de Piel , Complexion, Estatura

Ciudad

Edad

Tarifa

Servicios
*/
?>