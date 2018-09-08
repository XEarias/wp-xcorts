<?php 

    $post_id = $user['ad']['ID'];

    $escort_services = get_escort_ad_services($post_id);
    $escort_zones = get_escort_ad_zones($post_id);
?>


<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-services" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="services" />

    <fieldset>
        
        <h4>Zona y Servicios</h4>

        <div class="row" style="margin-top: 25px">
            <div class="col-md-4 form-group">
                <label for="zone">Ciudad</label>
                <select class="form-control" id="zone" name="zone">
                    <?php foreach($zones as $zone):?>
                        <?php if(count($zone["childs"])): ?>
                            <?php $child_zones = $zone["childs"]; ?>
                        <optgroup label="<?php echo $zone["name"]; ?>">
                            <?php foreach($child_zones as $child_zone):?>
                            <option  value="<?php echo $child_zone["ID"];?>" <?php echo ($escort_zones[0]['name'] == $child_zone["name"]) ?  "selected='selected'" : "" ?>><?php echo $child_zone["name"];?></option>
                            <?php endforeach;?>
                        </optgroup>
                        <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="zone">Dias de atención</label>
                <select class="form-control" id="working_days" name="working_days">
                    <?php foreach($working_days as $working_day):?>
                        <option value="<?php echo $working_day;?>" <?php checked($working_day, $user['ad']['working_days']); ?>><?php echo $working_day;?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="services">Servicios (*)</label>
                <?php foreach($services as $service):?>

                    <?php 
                        $checked = false;
                        foreach($escort_services as $escort_service) {
                            if($service["ID"] == $escort_service["ID"]){
                                $checked = true;
                            }
                        }
                    ;?>
                    <div class="form-check">
                        <input class="form-check-input"type="checkbox" name="services[]" id="<?php echo $service["name"];?>" value="<?php echo $service["ID"];?>" <?php echo ($checked) ? "checked='checked'" : ""; ?>>
                        <label class="form-check-label" for="<?php echo $service["name"];?>">
                            <?php echo $service["name"];?>
                        </label>
                    </div>
                <?php endforeach;?>
                <label id="services_error" class="hidden" for="services"> Debe seleccionar al menos un servicio</label>
            </div>
        </div>

        <input type="submit" value="Guardar" />

    </fieldset>
</form>