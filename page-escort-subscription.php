<?php get_header(); ?>

<?php 

$zones = get_escorts_zones(); 
$services = get_escorts_services(); 

?>

<section class="escort-login-container container-fluid pt-5">
    <div class="row">
        <div class="col-md-12">
            <ul id="progressbar">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="col-md-8 offset-md-2">
            <form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" target="_blank" enctype="multipart/form-data" id="escort-subscription">

                <fieldset>

                    <h4>Tu cuenta y datos personales</h4>

                    <?php wp_nonce_field("escort-register-account", "escort_nounce"); ?>
                    <input type="hidden" name="action" value="add_new_escort"></input>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-6 form-group">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="password_repeat">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Confirmar Contraseña">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="first_name">Nombes</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombres">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Apellidos</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email">Confirmar contraseña</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="phone">Télefono</label>
                            <input type="text" class="form-control" id="phone" name="phone[value]" placeholder="Télefono">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone_permission">¿Como quieres que tus clientes te contacten?</label>
                            <select class="form-control" id="phone_permission" name="phone[permission]">
                                <?php foreach($phone_permissions as $key => $phone_permission):?>
                                    <option value="<?php echo $key; ?>"><?php echo $phone_permission;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>


                <fieldset>

                    <h4>Datos de tu anuncio</h4>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="visible_name">Nombre visible en el sitio</label>
                            <input type="text" class="form-control" id="visible_name" name="visible_name" placeholder="Nombre visible en el sitio">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="age">Edad</label>
                            <select class="form-control" id="age" name="age">
                                <?php foreach($ages as $age):?>
                                    <option><?php echo $age;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="stature">Estatura</label>
                            <input type="text" class="form-control" id="stature" name="stature" placeholder="Estatura">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="weight">Peso</label>
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Peso">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Descripcion"></textarea>
                        </div>
                    </div>
                    <!-- DESCRIPTION DEL ANUNCIO -->
                    <label><b>Descripcion:</b></label>
                    <textarea id="description" type="text" placeholder="Descripcion" name="description" required/></textarea>
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

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />

                </fieldset>

                <fieldset>
                    <!-- FEATURED IMAGE -->
                    <label><b> Foto destacada: </b></label>
                    <input type="file" name="featured_image">
                    <br>

                    <!-- FOTOS DE PERFIL -->
                    <label><b> Fotos de perfil: </b></label>
                    <input type="file" name="images[]" multiple>
                    <br>

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>


                <fieldset>
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
                    <input type="checkbox" name="services[]" value="<?php echo $service["ID"];?>">
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


                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>

                <fieldset> 
                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="submit" value="Enviar" />
                </fieldset>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>