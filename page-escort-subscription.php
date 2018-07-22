<?php get_header(); ?>

<?php 

$zones = get_escorts_zones(); 
$services = get_escorts_services(); 

?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" target="_blank" enctype="multipart/form-data">

    <?php wp_nonce_field("escort-register-account", "escort_nounce"); ?>
    <input type="hidden" name="action" value="add_new_escort"></input>

    <label><b>Nombre de Usuario:</b></label>
    <input id="username" type="text" placeholder="Nombre de Usuario" name="username" required/>
    <br>

    <label><b>Contraseña:</b></label>
    <input id="password" type="password" placeholder="Contraseña" name="password" required/>
    <br>

    <label><b>Confirmar Contraseña:</b></label>
    <input id="password_repeat" type="password" placeholder="Confirmar contraseña" name="password_repeat" required></input>
    <br>

    <!-- Email -->
    <label for="email"><b>Email:</b></label>
    <input id="email" type="email" placeholder="Email" name="email" required/>
    <br>

    <label><b>Nombre:</b></label>
    <input id="first_name" type="text" placeholder="Nombre" name="first_name" required/>
    <br>

    <label><b>Apellido:</b></label>
    <input id="last_name" type="text" placeholder="Apellido" name="last_name" required/>
    <br>

    <!-- TELEFONO -->
    <label for="phone"><b>Télefono:</b></label>
    <input id="phone" type="text" placeholder="Télefono" name="phone[value]" required/>
    <br>

    <!-- PERMISOS TELEFONO -->
    <label for="phone_permission"><b>Permisos de télefono:</b></label>
    <select id="phone_permission" name="phone[permission]">
    <?php foreach($phone_permissions as $key => $phone_permission):?>
        <option value="<?php echo $key; ?>"><?php echo $phone_permission;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- NOMBRE VISIBLE DEL ANUNCIO -->
    <label><b>Nombre visible en el sitio:</b></label>
    <input id="visible_name" type="text" placeholder="Nombre visible en el sitio" name="visible_name" required/>
    <br>

    <!-- DESCRIPTION DEL ANUNCIO -->
    <label><b>Descripcion:</b></label>
    <textarea id="description" type="text" placeholder="Descripcion" name="description" required/></textarea>
    <br>

    <!-- FEATURED IMAGE -->
    <label><b> Foto destacada: </b></label>
    <input type="file" name="featured_image">
    <br>

    <!-- FOTOS DE PERFIL -->
    <label><b> Fotos de perfil: </b></label>
    <input type="file" name="images[]" multiple>
    <br>


    <!-- EDAD -->
    <label for="edad"><b>Edad:</b></label>
    <select id="edad" name="age" required>
    <?php foreach($ages as $age):?>
        <option><?php echo $age;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- ESTATURA -->
    <label for="stature"><b>Estatura:</b></label>
    <input id="stature" type="text" placeholder="Estatura" name="stature" required/>
    <br>

    <!-- PESO -->
    <label for="weight"><b>Peso:</b></label>
    <input id="weight" type="text" placeholder="Peso" name="weight" required/>
    <br>

    <!-- IDIOMAS -->
    <label><b>Idiomas:</b></label>
    <?php foreach($langs as $key => $lang):?>
    <label><?php echo $lang;?>:</label>
    <input type="checkbox" name="langs[<?php echo $key;?>]">
    <?php endforeach;?>
    <br>

    <!-- COLOR DE PELO -->
    <label for="cabello"><b>Color de cabello:</b></label>
    <select id="cabello" name="hair_color">
    <?php foreach($hair_colors as $hair_color):?>
        <option><?php echo $hair_color;?></option>
    <?php endforeach;?>
    </select>
    <br>
    <!-- COLOR DE PIEL -->
    <label for="piel"><b>Color de piel:</b></label>
    <select id="piel" name="skin_color">
    <?php foreach($skin_colors as $skin_color):?>
        <option><?php echo $skin_color;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- PROFESION -->
    <label for="profession"><b>Profesión:</b></label>
    <input type="text" placeholder="Profesión" name="profession" required/>
    <br>

    <!-- MEDIDAS -->
    <label><b>Medidas:</b></label>
    <input type="text" placeholder="Pecho" name="measure[chest]" required/>
    <input type="text" placeholder="Cintura" name="measure[waist]" required/>
    <input type="text" placeholder="Caderas" name="measure[hip]" required/>
    <br>


    <!-- Zona de Servicio -->
    <label for="zone"><b>Ciudad:</b></label>
    <select id="zone" name="zone">
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
    <br>

    <!-- Zona de Servicio -->
    <label for="services"><b>Servicios:</b></label>
    <?php foreach($services as $service):?>
    <label><?php echo $service["name"];?>:</label>
    <input type="checkbox" name="langs[]" value="<?php echo $service["ID"];?>">
    <?php endforeach;?>
    <br>

    <!--TARIFAS-->

    <?php foreach($rates as $key => $rate):?>
        <label><b><?php echo $rate; ?></b></label>
        <input name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>">
        <br>
    <?php endforeach;?>
    
    <label><b>Metódos de Pago:</b></label>
    <?php foreach($payment_methods as $key => $payment_method): ?>
        <label><?php echo $payment_method;?></label>
        <input type="checkbox" name="payment_methods[<?php echo $key;?>]"/>
    <?php endforeach; ?>


    <button type="submit">Enviar</button>
</form>
