<?php get_header(); ?>

<?php 

$zones = get_escorts_zones(); 
$services = get_escorts_services(); 

?>

<section class="escort-login-container container-fluid pt-5" style="min-height: 800px;">
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
        <div class="col-md-10 offset-md-1">
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

                    <div class="row" style="margin-top: 25px">
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
                            <label for="profession">Profesion</label>
                            <input type="text" class="form-control" id="profession" name="profession" placeholder="Profesion">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Descripcion"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="age">Idiomas</label>
                            <?php foreach($langs as $key => $lang):?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="langs[<?php echo $key;?>]" id="<?php echo $key;?>">
                                    <label class="form-check-label" for="<?php echo $key;?>">
                                        <?php echo $lang;?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="hair_color">Color de cabello</label>
                            <select class="form-control" id="hair_color" name="hair_color">
                                <?php foreach($hair_colors as $hair_color):?>
                                    <option><?php echo $hair_color;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="skin_color">Color de piel</label>
                            <select class="form-control" id="skin_color" name="skin_color">
                                <?php foreach($skin_colors as $skin_color):?>
                                    <option><?php echo $skin_color;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="chest">Medidas</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" id="chest" name="measure[chest]" placeholder="Pechos">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" id="waist" name="measure[waist]" placeholder="Cintura">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" id="hip" name="measure[hip]" placeholder="Caderas">
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />

                </fieldset>

                <fieldset>

                    <h4>Imagen principal y galeria</h4>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-12">
                            <label for="featured_image">Foto destacada</label>
                            <div class="row featured-image-box">
                                <label for="featured_image"></label>
                                <div class="col-md-2 offset-md-5 item">
                                    <label for="featured_image" style="min-height: 130px">
                                        <img src="https://cdn.onlinewebfonts.com/svg/img_212908.png" style="max-height:100%; max-width:100%;" alt="">
                                    <label/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-12">
                            <label for="images">Galeria</label>
                            <div class="row images-box">
                                <label for="images"></label>
                                <div class="col-md-2 item main">
                                    <label for="images" style="height: 130px; cursor: pointer">
                                        <img src="https://cdn.onlinewebfonts.com/svg/img_212908.png" style="max-height:100%; max-width:100%;" alt="">
                                    <label/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>


                <fieldset>

                    <h4>Zona, Servicios y Metodos de pago</h4>

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
                            <label for="services">Servicios</label>
                            <?php foreach($services as $service):?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="services[<?php echo $service["name"];?>]" id="<?php echo $service["name"];?>" value="<?php echo $service["ID"];?>">
                                    <label class="form-check-label" for="<?php echo $service["name"];?>">
                                        <?php echo $lang;?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-12">
                            <h5 class="text-center">Tarifas</h5>
                        </div>
                    </div>
                    <?php $i = 1; ?>
                    <?php foreach($rates as $key => $rate):?>
                        <?php if($i == 1): ?><div class="row"><?php endif;?>
                            <div class="col-md-4 form-group">
                                <label for="<?php echo $rate; ?>"><?php echo $rate; ?></label>
                                <input type="text" class="form-control" id="<?php echo $rate; ?>" name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>">
                            </div>
                        <?php if ($i == 3) { $i = 1; echo '</div>'; } else { $i++; } ?>
                    <?php endforeach;?>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Metódos de pago</label>
                            <?php foreach($payment_methods as $key => $payment_method): ?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="payment_methods[<?php echo $key;?>]" id="<?php echo $payment_method;?>">
                                    <label class="form-check-label" for="<?php echo $payment_method;?>">
                                        <?php echo $payment_method;?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>

                <fieldset> 

                    <h4>Plan</h4>

                    <div class="row" style="margin-top: 25px">
                        <?php foreach ($plans as $name => $plan): ?>
                            <div class="col-md-3">
                                <div class="plan-box">
                                    <div class="plan-box-header">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/PLAN_'.strtoupper($name).'.png' ?>);" width="100%" alt="">
                                    </div>
                                    <div class="plan-box-body">
                                        <div class="rates">
                                            <label for="<?= $name.'_weekly' ?>" class="checked">Semanal</label>
                                            <label for="<?= $name.'_monthly' ?>">Mensual</label>
                                        </div>
                                        <div class="description">
                                            <?= $plan['descripcion'] ?>
                                        </div>
                                        <div class="items">
                                            <ul>
                                                <?php foreach ($plan['items'] as $key => $val): ?>
                                                    <li> <?= $val ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="select-button">
                                            <label for="<?= $name ?>" class="<?php if ($name == 'free') { echo 'selected-plan'; } ?>">ESCOGER</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div style="visibility: hidden;">
                        <?php foreach ($plans as $name => $plan): ?>
                            <input type="radio" id="<?= $name ?>" name="plan[name]" value="<?= $name ?>" <?php if ($name == 'free') { echo 'checked'; } ?>>
                        <?php endforeach; ?>

                        <input type="radio" id="weekly" name="plan[type]" value="weekly" checked>
                        <input type="radio" id="monthly" name="plan[type]" value="monthly">
                    </div>

                    <input type="button" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="submit" value="Enviar" />
                </fieldset>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>