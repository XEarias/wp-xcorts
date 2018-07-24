<?php 

    $post_id = $user['ad']['ID'];

    $meta_rates = (get_post_meta($post_id, "escort_rates", true)) ? get_post_meta($post_id, "escort_rates", true) : [];
?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-info" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="plan" />

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
                            <div class="description">
                                <div class="price">
                                    <h4 class="price">
                                        <?php if ($name == 'free'): ?>
                                            <span style="color: green">GRATIS</span>
                                        <?php else: ?>
                                            <?= $plan['rates']['weekly'] ?> $
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <?= $plan['description'] ?>
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

        <input type="submit" value="Guardar" />

    </fieldset>
</form>