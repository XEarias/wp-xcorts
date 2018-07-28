<?php
    GLOBAL $hair_colors, $skin_colors, $ages; 

    $zones = get_escorts_zones(); 
    $services = get_escorts_services(); 
?>

<section class="filterbar-container container">
    <form action="<?php echo home_url();?>" method="GET">
        <div class="row" style="margin-top: 25px">
            <div class="col-md-2 form-group">
                <select name="basic_info[hair_color]" id="hair_color" class="form-control">
                    <option selected>Color de cabello</option>
                    <?php foreach($hair_colors as $hair_color):?>
                        <option value="<?= $hair_color ?>"><?= $hair_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="basic_info[skin_color]" id="skin_color" class="form-control">
                    <option selected>Color de piel</option>
                    <?php foreach($skin_colors as $skin_color):?>
                        <option value="<?= $skin_color ?>"><?= $skin_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="basic_info[complexion]" id="complexion" class="form-control">
                    <option selected>Complexion</option>
                    <option>Delgada</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="basic_info[stature]" id="stature" class="form-control">
                    <option selected>Estatura</option>
                    <option>Baja</option>
                </select>
            </div>
            <div class="col-md-4 form-group text-right">
                <a data-toggle="collapse" href="#extra-filters" role="button" aria-expanded="false" aria-controls="extra-filters" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">
                    <small> MÁS FILTROS</small>
                </a>
                <button type="submit" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">BUSCAR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="collapse pt-3" id="extra-filters">
                    <div style="width:100%; height: 1px; background-color:#999; margin: 10px 0;"></div>
                    <div class="row text-center">
                        <div class="col-md-2 offset-md-4 form-group">
                            <select name="basic_info[skin_color]" id="skin_color" class="form-control">
                                <option selected>Edad</option>
                                <?php foreach($ages as $age):?>
                                    <option value="<?= $age ?>"><?= $age ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <select class="form-control" id="zone" name="basic_info[zone]">
                                <option selected>Ciudad</option>
                                <?php foreach($zones as $zone):?>
                                    <?php if(count($zone["childs"])): ?>
                                        <?php $child_zones = $zone["childs"]; ?>
                                        <optgroup label="<?php echo $zone["name"]; ?>">
                                            <?php foreach($child_zones as $child_zone):?>
                                            <option value="<?php echo $child_zone["ID"];?>"><?php echo $child_zone["name"];?></option>
                                            <?php endforeach;?>
                                        </optgroup>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-right form-group" style="display:flex; justify-content: flex-end; align-items: center">
                            Tarifa:
                            <input type="text" id="" name="" class="form-control" placeholder="Min" style="width:100px;margin-left:4px;margin-right:4px"> - <input type="text" id="" name="" class="form-control" placeholder="Max" style="width:100px;;margin-left:4px">
                        </div>
                        <div class="col-md-6 form-group">
                            <?php foreach($services as $service):?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="services[]" id="<?php echo $service["name"];?>" value="<?php echo $service["ID"];?>">
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