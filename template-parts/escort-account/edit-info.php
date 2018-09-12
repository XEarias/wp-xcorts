<?php 

    $post_id = $user['ad']['ID'];
    //Escort Metas
    $meta_age = get_post_meta($post_id, "escort_age", true);
    $meta_stature = get_post_meta($post_id, "escort_stature", true);
    $meta_weight = get_post_meta($post_id, "escort_weight", true);
    $meta_langs = (get_post_meta($post_id, "escort_langs", true)) ? get_post_meta($post_id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($post_id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($post_id, "escort_hair_color", true);
    $meta_profession = get_post_meta($post_id, "escort_profession", true);
    $meta_measure = get_post_meta($post_id, "escort_measure", true) ? get_post_meta($post_id, "escort_measure", true) : [];
    $meta_phone = get_post_meta($post_id, "escort_phone", true) ? get_post_meta($post_id, 
    "escort_phone", true) : []; 

    $meta_eyes_color = get_post_meta($post_id, "escort_eyes_color", true);
    $meta_complexion = get_post_meta($post_id, "escort_complexion", true);
    $meta_origin = get_post_meta($post_id, "escort_origin", true);
    $meta_sexual_orientation = get_post_meta($post_id, "escort_sexual_orientation", true);
    $meta_depilation = get_post_meta($post_id, "escort_depilation", true);

?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-info" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="info" />

    <fieldset>

        <h4>INFORMACION PRINCIPAL</h4>

        <div class="row" style="margin-top: 25px">
            <div class="col-md-4 form-group">
                <label for="visible_name">Nombre visible en el sitio (*)</label>
                <input type="text" class="form-control" id="visible_name" name="visible_name" placeholder="Nombre visible en el sitio" value="<?= $user['ad']['display_name'] ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="age">Elige tu edad</label>
                <select class="form-control" id="age" name="age">
                    <?php foreach($ages as $age):?>
                        <option value="<?= $age ?>" <?php echo ($meta_age == $age) ?  "selected='selected'" : ""; ?>><?= $age ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label for="stature">Estatura (*)</label>
                <input type="text" class="form-control" id="stature" name="stature" placeholder="Cm" value="<?= $meta_stature ?>">
            </div>
            <div class="col-md-2 form-group">
                <label for="weight">Peso (*)</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="Kg" value="<?= $meta_weight ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="phone">Télefono (*)</label>
                <input type="text" class="form-control" id="phone" name="phone[value]" placeholder="Télefono" value="<?php echo (isset($meta_phone['value'])) ? $meta_phone['value'] : "";?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="phone_permission">¿Como quieres que tus clientes te contacten?</label>
                <select class="form-control" id="phone_permission" name="phone[permission]">
                    <?php foreach($phone_permissions as $key => $phone_permission):?>
                        <option value="<?php echo $key; ?>" <?php echo (isset($meta_phone["permission"]) && $meta_phone["permission"] == $key) ?  "selected='selected'" : "" ?> value="<?php echo $key; ?>"><?php echo $phone_permission;?></option>
                    <?php endforeach;?>
                    
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="description">Descripción (*)</label>
                <textarea class="form-control" id="description" name="description" placeholder="Descripcion"><?= $user['ad']['description'] ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <label for="age">Que idiomas hablas</label>
                <?php foreach($langs as $key => $lang):?>
                    <div class="form-check">
                        <input class="form-check-input"type="checkbox" name="langs[<?= $key ?>]" id="<?= $key ?>" <?php echo (in_array($key, $meta_langs)) ? "checked='checked'" : ""; ?>>
                        <label class="form-check-label" for="<?= $key ?>">
                            <?= $lang ?>
                        </label>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="col-md-3 form-group">
                <label for="origin">Que nacionalidad tienes?</label>
                <select class="form-control" id="origin" name="origin">
                    <?php foreach($countries as $country):?>
                        <option value="<?= $country ?>" <?php echo ($meta_origin == $country) ?  "selected='selected'" : "" ?>><?= $country ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="hair_color">Color de cabello</label>
                <select class="form-control" id="hair_color" name="hair_color">
                    <?php foreach($hair_colors as $hair_color):?>
                        <option value="<?= $hair_color ?>" <?php echo ($meta_hair_color == $hair_color) ?  "selected='selected'" : "" ?>><?= $hair_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="skin_color">Color de piel</label>
                <select class="form-control" id="skin_color" name="skin_color">
                    <?php foreach($skin_colors as $skin_color):?>
                        <option value="<?= $skin_color ?>" <?php echo ($meta_skin_color == $skin_color) ?  "selected='selected'" : "" ?>><?= $skin_color ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <label for="eyes_color">Color de ojos</label>
                <select class="form-control" id="eyes_color" name="eyes_color">
                    <?php foreach($eyes_colors as $eyes_color):?>
                        <option value="<?php echo $eyes_color;?>" <?php echo ($meta_eyes_color == $eyes_color) ?  "selected='selected'" : "" ?>><?php echo $eyes_color;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="sexual_orientation">Orientación Sexual</label>
                <select class="form-control" id="sexual_orientation" name="sexual_orientation">
                    <?php foreach($sexual_orientations as $sexual_orientation):?>
                        <option value="<?= $sexual_orientation ?>" <?php echo ($meta_sexual_orientation == $sexual_orientation) ?  "selected='selected'" : "" ?>><?= $sexual_orientation ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="complexion">Complexión</label>
                <select class="form-control" id="complexion" name="complexion">
                    <?php foreach($complexions as $complexion):?>
                        <option value="<?php echo $complexion;?>" <?php echo ($meta_complexion == $complexion) ?  "selected='selected'" : "" ?>><?php echo $complexion;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="depilation">Depilación</label>
                <select class="form-control" id="depilation" name="depilation">
                    <?php foreach($depilations as $depilation):?>
                        <option value="<?php echo $depilation;?>" <?php echo ($meta_depilation == $depilation) ?  "selected='selected'" : "" ?>><?php echo $depilation;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="chest">Medidas</label>
            </div>
            <div class="col-md-3 form-group">
                <input type="text" class="form-control" id="chest" name="measure[chest]" placeholder="Pechos" value="<?php echo ($meta_measure && isset($meta_measure['chest'])) ? $meta_measure['chest'] : "" ?>">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" class="form-control" id="waist" name="measure[waist]" placeholder="Cintura" value="<?php echo ($meta_measure && isset($meta_measure['waist'])) ? $meta_measure['waist'] : "" ?>">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" class="form-control" id="hip" name="measure[hip]" placeholder="Caderas" value="<?php echo ($meta_measure && isset($meta_measure['hip'])) ? $meta_measure['hip'] : "" ?>">
            </div>
        </div>

        <input type="submit" value="Guardar" />

    </fieldset>
</form>