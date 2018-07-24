<?php 

    $post_id = $user['ad']['ID'];

    $meta_rates = (get_post_meta($post_id, "escort_rates", true)) ? get_post_meta($post_id, "escort_rates", true) : [];
    $meta_payment_methods = (get_post_meta($post_id, "escort_payment_methods", true)) ? get_post_meta($post_id, "escort_payment_methods", true) : [] ;

?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-info" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="rates" />

    <fieldset>

        <h4>Tarifas y metodos de pago</h4>

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
                    <input type="text" class="form-control" id="<?php echo $rate; ?>" name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>" value="<?php echo ($meta_rates && isset($meta_rates[$key])) ? $meta_rates[$key] : "" ;?>">
                </div>
            <?php if ($i == 3) { $i = 1; echo '</div>'; } else { $i++; } ?>
        <?php endforeach;?>
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Metódos de pago (*)</label>
                <?php foreach($payment_methods as $key => $payment_method): ?>
                    <div class="form-check">
                        <input class="form-check-input"type="checkbox" name="payment_methods[<?php echo $key;?>]" id="<?php echo $payment_method;?>" <?php echo (in_array($key, $meta_payment_methods)) ? "checked='checked'" : ""; ?>>
                        <label class="form-check-label" for="<?php echo $payment_method;?>">
                            <?php echo $payment_method;?>
                        </label>
                    </div>
                <?php endforeach;?>
                <label id="payment_methods_error" class="hidden" for="payment_methods"> Debe seleccionar al menos un metodo</label>
            </div>
        </div>


        <input type="submit" value="Guardar" />

    </fieldset>
</form>