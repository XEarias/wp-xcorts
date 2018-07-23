<?php 

    $langs = get_query_var('langs');
    $langs = get_query_var('langs');
    $langs = get_query_var('langs');
    $langs = get_query_var('langs');

    $post_id = 30;
    //Escort Metas
    $meta_email = get_post_meta($post_id, "escort_email", true);
    $meta_age = get_post_meta($post_id, "escort_age", true);
    $meta_stature = get_post_meta($post_id, "escort_stature", true);
    $meta_weight = get_post_meta($post_id, "escort_weight", true);
    $meta_langs = (get_post_meta($post_id, "escort_langs", true)) ? get_post_meta($post_id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($post_id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($post_id, "escort_hair_color", true);
    $meta_profession = get_post_meta($post_id, "escort_profession", true);
    $meta_measure = get_post_meta($post_id, "escort_measure", true) ? get_post_meta($post_id, "escort_measure", true) : [];
    $meta_phone = get_post_meta($post_id, "escort_phone", true) ? get_post_meta($post_id, "escort_phone", true) : []; 

?>

    <!-- TELEFONO -->
    <label for="email"><b>Email:</b></label>
    <input id="email" type="email" placeholder="Email" name="email" value="<?php echo $meta_email;?>"></input>
    <br>

    <!-- TELEFONO -->
    <label for="phone"><b>Télefono:</b></label>
    <input id="phone" type="text" placeholder="Télefono" name="phone[value]" value="<?php echo (isset($meta_phone['value'])) ? $meta_phone['value'] : "";?>"></input>
    <br>

    <!-- PERMISOS TELEFONO -->
    <label for="phone_permission"><b>Permisos de télefono:</b></label>
    <select id="phone_permission" name="phone[permission]">
    <?php foreach($phone_permissions as $key => $phone_permission):?>
        <option <?php echo (isset($meta_phone["permission"]) && $meta_phone["permission"] == $key) ?  "selected='selected'" : "" ?> value="<?php echo $key; ?>"><?php echo $phone_permission;?></option>
    <?php endforeach;?>
    </select>
    <br>


    <!-- EDAD -->
    <label for="edad"><b>Edad:</b></label>
    <select id="edad" name="age">
    <?php foreach($ages as $age):?>
        <option <?php echo ($meta_age == $age) ?  "selected='selected'" : "" ?>><?php echo $age;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- ESTATURA -->
    <label for="stature"><b>Estatura:</b></label>
    <input id="stature" type="text" placeholder="Estatura" name="stature" value="<?php echo $meta_stature;?>"></input>
    <br>

    <!-- PESO -->
    <label for="weight"><b>Peso:</b></label>
    <input id="weight" type="text" placeholder="Peso" name="weight" value="<?php echo $meta_weight;?>"></input>
    <br>

    <!-- IDIOMAS -->
    <label><b>Idiomas:</b></label>
    <?php foreach($langs as $key => $lang):?>
    <label><?php echo $lang;?>:</label>
    <input type="checkbox" name="langs[<?php echo $key;?>]" <?php echo (in_array($key, $meta_langs)) ? "checked='checked'" : ""; ?>>
    <?php endforeach;?>
    <br>

    <!-- COLOR DE PELO -->
    <label for="cabello"><b>Color de cabello:</b></label>
    <select id="cabello" name="hair_color">
    <?php foreach($hair_colors as $hair_color):?>
        <option <?php echo ($meta_hair_color == $hair_color) ?  "selected='selected'" : "" ?>><?php echo $hair_color;?></option>
    <?php endforeach;?>
    </select>
    <br>
    <!-- COLOR DE PIEL -->
    <label for="piel"><b>Color de piel:</b></label>
    <select id="piel" name="skin_color">
    <?php foreach($skin_colors as $skin_color):?>
        <option <?php echo ($meta_skin_color == $skin_color) ?  "selected='selected'" : "" ?>><?php echo $skin_color;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- PROFESION -->
    <label for="profession"><b>Profesión:</b></label>
    <input type="text" placeholder="Profesión" name="profession" value="<?php echo $meta_profession;?>"></input>
    <br>

    <!-- MEDIDAS -->
    <label><b>Medidas:</b></label>
    <input type="text" placeholder="Pecho" name="measure[chest]" value="<?php echo ($meta_measure && isset($meta_measure['chest'])) ? $meta_measure['chest'] : "" ?>">
    <input type="text" placeholder="Cintura" name="measure[waist]" value="<?php echo ($meta_measure && isset($meta_measure['waist'])) ? $meta_measure['waist'] : "" ?>">
    <input type="text" placeholder="Caderas" name="measure[hip]" value="<?php echo ($meta_measure && isset($meta_measure['hip'])) ? $meta_measure['hip'] : "" ?>">