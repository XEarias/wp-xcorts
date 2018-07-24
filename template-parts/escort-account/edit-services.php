<?php 

    $post_id = $user['ad']['ID'];

    $meta_rates = (get_post_meta($post_id, "escort_rates", true)) ? get_post_meta($post_id, "escort_rates", true) : [];

?>


<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-info" novalidate>
    
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
                            <option value="<?php echo $child_zone["ID"];?>"><?php echo $child_zone["name"];?></option>
                            <?php endforeach;?>
                        </optgroup>
                        <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="services">Servicios (*)</label>
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

        <input type="submit" value="Guardar" />

    </fieldset>
</form>