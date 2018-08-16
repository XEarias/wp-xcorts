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
            <form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" enctype="multipart/form-data" class="escort-form" id="escort-subscription" novalidate>

                <fieldset>

                    <h4>Tu cuenta y datos personales</h4>

                    <?php wp_nonce_field("escort-register-account", "escort_nounce"); ?>
                    <input type="hidden" name="action" value="add_new_escort"></input>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-6 form-group">
                            <label for="username">Nombre de usuario (*)</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="password">Contraseña (*)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="password_repeat">Confirmar contraseña (*)</label>
                            <input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Confirmar Contraseña">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="first_name">Nombres (*) </label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombres">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Apellidos (*)</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email">Email (*) </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="phone">Télefono (*)</label>
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
                        <div class="col-md-6 form-group">
                            <div class="form-check">
                                <input class="form-check-input isChecked" type="checkbox" name="politics" id="politics">
                                <label class="form-check-label" for="politics">
                                    Lorem ipsum
                                </label>
                            </div>
                            <!--<label id="politics_error" class="hidden" for="politics"> </label>-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <small><strong>Estos datos no son publicos, Son para uso interno del Sitio</strong></small>
                        </div>
                    </div>

                    <input type="button" data-step="1" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>

                <fieldset>

                    <h4>Datos de tu anuncio</h4>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-4 form-group">
                            <label for="visible_name">Nombre con el cual deseas ser publicada (*)</label>
                            <input type="text" class="form-control" id="visible_name" name="visible_name" placeholder="Nombre visible en el sitio">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="age">Elige tu edad</label>
                            <select class="form-control" id="age" name="age">
                                <?php foreach($ages as $age):?>
                                    <option value="<?php echo $age;?>"><?php echo $age;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="stature">Estatura (*)</label>
                            <input type="text" class="form-control" id="stature" name="stature" placeholder="Cm">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="weight">Peso (*)</label>
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Kg">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description">Texto que aparecerá en tu anuncio (*)</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Descripcion"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="langs">Que idiomas hablas</label>
                            <?php foreach($langs as $key => $lang):?>
                                <div class="form-check">
                                    <input class="form-check-input isOneCheckedI"type="checkbox" name="langs[<?php echo $key;?>]" id="<?php echo $key;?>">
                                    <label class="form-check-label" for="<?php echo $key;?>">
                                        <?php echo $lang;?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                            <label id="langs_error" class="hidden" for="langs"> Debe seleccionar al menos un idioma</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="origin">Que nacionalidad tienes?</label>
                            <select class="form-control" id="origin" name="origin">
                                <?php foreach($countries as $country):?>
                                    <option value="<?= $country ?>"><?= $country ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="hair_color">Color de cabello</label>
                            <select class="form-control" id="hair_color" name="hair_color">
                                <?php foreach($hair_colors as $hair_color):?>
                                    <option value="<?php echo $hair_color;?>"><?php echo $hair_color;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="skin_color">Color de piel</label>
                            <select class="form-control" id="skin_color" name="skin_color">
                                <?php foreach($skin_colors as $skin_color):?>
                                    <option value="<?php echo $skin_color;?>"><?php echo $skin_color;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="eyes_color">Color de ojos</label>
                            <select class="form-control" id="eyes_color" name="eyes_color">
                                <?php foreach($eyes_colors as $eyes_color):?>
                                    <option value="<?php echo $eyes_color;?>"><?php echo $eyes_color;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="sexual_orientation">Orientación Sexual</label>
                            <select class="form-control" id="sexual_orientation" name="sexual_orientation">
                                <?php foreach($sexual_orientations as $sexual_orientation):?>
                                    <option value="<?= $sexual_orientation ?>"><?= $sexual_orientation ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="complexion">Complexión</label>
                            <select class="form-control" id="complexion" name="complexion">
                                <?php foreach($complexions as $complexion):?>
                                    <option value="<?php echo $complexion;?>"><?php echo $complexion;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="depilation">Depilación</label>
                            <select class="form-control" id="depilation" name="depilation">
                                <?php foreach($depilations as $depilation):?>
                                    <option value="<?php echo $depilation;?>"><?php echo $depilation;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="chest">Medidas</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" id="chest" name="measure[chest]" placeholder="Pechos">
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" id="waist" name="measure[waist]" placeholder="Cintura">
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" id="hip" name="measure[hip]" placeholder="Caderas">
                        </div>
                    </div>

                    <input type="button" data-step="1" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" data-step="2" name="next" class="next-step action-button" value="Siguiente" />

                </fieldset>

                <fieldset>

                    <h4>Imagen principal y galeria</h4>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-12">
                            <label for="featured_image">Foto destacada (*)</label>
                            <div class="row featured-image-box">
                                <label for="featured_image"></label>
                                <div class="col-md-2 offset-md-5 item">
                                    <label for="featured_image" style="min-height: 130px">
                                        <img src="https://cdn.onlinewebfonts.com/svg/img_212908.png" style="max-height:100%; max-width:100%;" alt="">
                                    <label/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="file" id="featured_image" name="featured_image" style="visibility:hidden; height: 1px;display: block;"><br>
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
                        <div class="col-md-12">
                            <input type="file" id="images" name="images[]" style="visibility:hidden; height: 1px;display: block;" multiple>
                        </div>
                        <div class="col-md-12">
                            <small><strong>En movil:</strong> Manten presionada cada imagen que desees subir una tras otra y asi puedes subir multiples imagenes</small> <br>
                            <small><strong>En escritorio:</strong> Manten presionado (Ctrl) y al mismo tiempo sin soltarlo haces clic en cada imagen que desees subir y asi puedes subir multiples imagenes</small>
                        </div>
                    </div>

                    <input type="button" data-step="2" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" data-step="3" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>

                <fieldset>

                    <h4>Zona, Servicios, Tarifas y Metodos de pago</h4>

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
                                    <?php else: ?>
                                    
                                    <option  value="<?php echo $zone["ID"];?>"><?php echo $zone["name"];?></option>
                                    
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="zone">Dias de atención</label>
                            <select class="form-control" id="working_days" name="working_days">
                                <?php foreach($working_days as $working_day):?>
                                    <option value="<?php echo $working_day;?>"><?php echo $working_day;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="services">Servicios (*)</label>
                            <?php foreach($services as $service):?>
                                <div class="form-check">
                                    <input class="form-check-input isOneCheckedS"type="checkbox" name="services[]" id="<?php echo $service["name"];?>" value="<?php echo $service["ID"];?>">
                                    <label class="form-check-label" for="<?php echo $service["name"];?>">
                                        <?php echo $service["name"];?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                            <label id="services_error" class="hidden" for="services"> Debe seleccionar al menos un servicio</label>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-12">
                            <h5 class="text-center">Tarifas</h5>
                            <small>Los campos que dejes vacíos se pondrá a "consultar"  Y la opcion que no aplique para tu servicio escribir "No"</small>
                            <br>
                            <br>
                        </div>
                    </div>
                    <?php $i = 1; ?>
                    <?php foreach($rates as $key => $rate):?>
                        <?php if($i == 1): ?><div class="row"><?php endif;?>
                            <div class="col-md-4 form-group">
                                <label for="<?php echo $rate; ?>"><?php echo $rate; ?></label>
                                <input type="text" class="form-control" id="<?php echo $rate; ?>" name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>">
                            </div>
                        <?php if ($i == 3 || $rate == "Viajes") { $i = 1; echo '</div>'; } else { $i++; } ?>
                    <?php endforeach;?>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Que Metódos de pago aceptas? (*)</label>
                            <?php foreach($payment_methods as $key => $payment_method): ?>
                                <div class="form-check">
                                    <input class="form-check-input"type="checkbox" name="payment_methods[<?php echo $key;?>]" id="<?php echo $payment_method;?>">
                                    <label class="form-check-label" for="<?php echo $payment_method;?>">
                                        <?php echo $payment_method;?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                            <label id="payment_methods_error" class="hidden" for="payment_methods"> Debe seleccionar al menos un metodo</label>
                        </div>
                    </div>

                    <input type="button" data-step="3" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="button" data-step="4" name="next" class="next-step action-button" value="Siguiente" />
                </fieldset>

                <fieldset> 

                    <h4>Plan</h4>

                    <div class="row" style="margin-top: 25px">
                        <?php foreach ($plans as $name => $plan): ?>
                            <?php if ($name != 'free'): ?>
                            <div class="col-md-4">
                                <div class="plan-box">
                                    <div class="plan-box-header">
                                        <img src="<?= get_template_directory_uri() . '/assets/img/PLAN_'.strtoupper($name).'.png' ?>);" width="100%" alt="">
                                    </div>
                                    <div class="plan-box-body">
                                        <div class="rates">
                                            <label for="<?= $name.'_weekly' ?>" data-price="<?= $plan['rates']['weekly'] ?>" class="l checked">
                                                <?php if ($name == 'free'): ?>
                                                    N/A
                                                <?php else: ?>
                                                    SEMANAL
                                                <?php endif; ?>
                                            </label>
                                            <label for="<?= $name.'_monthly' ?>" data-price="<?= $plan['rates']['monthly'] ?>" class="r">
                                                <?php if ($name == 'free'): ?>
                                                    N/A
                                                <?php else: ?>
                                                    MENSUAL
                                                <?php endif; ?>
                                            </label>
                                        </div>
                                        <div class="prices">
                                            <h4 class="price week">
                                                <?php if ($name == 'free'): ?>
                                                    <span style="color: green">GRATIS</span>
                                                <?php else: ?>
                                                    <?= $plan['rates']['weekly'] ?> $
                                                <?php endif; ?>
                                            </h4>
                                            <h4 class="price month">
                                                <?php if ($name == 'free'): ?>
                                                    <span style="color: green">GRATIS</span>
                                                <?php else: ?>
                                                    <?= $plan['rates']['monthly'] ?> $
                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                        <div class="description">
                                            <?= $plan['description'] ?>
                                        </div>
                                        <div class="items">
                                            <ul>
                                                <?php foreach ($plan['items'] as $key => $val): ?>
                                                    <li> <?= $val ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <!--<div class="select-button">
                                            <label for="<?= $name ?>" class="<?php if ($name == 'free') { echo 'selected-plan'; } ?>">ESCOGER</label>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <div style="visibility: hidden;">
                        <?php foreach ($plans as $name => $plan): ?>
                            <input type="radio" id="<?= $name ?>" name="plan[name]" value="<?= $name ?>" <?php if ($name == 'free') { echo 'checked'; } ?>>
                        <?php endforeach; ?>

                        <input type="radio" id="weekly" name="plan[type]" value="weekly" checked>
                        <input type="radio" id="monthly" name="plan[type]" value="monthly">
                    </div>

                    <input type="button" data-step="4" name="previous" class="previous-step action-button" value="Anterior" />
                    <input type="submit" data-step="5" value="Enviar" />
                </fieldset>
            </form>
        </div>
    </div>
</section>

<div class="overlay">
    Cargando...
</div>

<?php get_footer(); ?>