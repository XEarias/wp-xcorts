<?php 

    $post_id = $user['ad']['ID'];

    $subscription = get_or_set_subscription($post_id);

    $subscription_name = ($subscription['plan']['name'] == 'free') ? 'Inactiva' : $subscription['plan']['name'];

?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-plan" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="plan" />

    <fieldset>

        <h4>Plan</h4>

        <div class="row" style="margin-top: 25px">

            <div class="col-md-3">
                <div style="background: #54c358; text-align: center; color: white; padding: 10px;">
                    PLAN:
                    <?= strtoupper($subscription_name) ?>
                </div>
            </div>

            <div class="col-md-3">
                <div style="background: #54c358; text-align: center; color: white; padding: 10px;">
                    INICIO:
                    <?= $subscription['pretty_date'] ?>
                </div>
            </div>
            <div class="col-md-3">
                <div style="background: #54c358; text-align: center; color: white; padding: 10px;">
                    USADO:
                    <?= $subscription['days']['used'] ?> dias
                </div>
            </div>
            <div class="col-md-3">
                <div style="background: #54c358; text-align: center; color: white; padding: 10px;">
                    RESTANTE:
                    <?= $subscription['days']['left'] ?> dias
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 25px">
            <?php if ($subscription['status'] == "paid"): ?>
                <?php foreach ($plans as $name => $plan): ?>
                    <?php if ($name != 'free'): ?>
                        <div class="col-md-4">
                            <div class="plan-box">
                                <div class="plan-box-header">
                                    <img src="<?= get_template_directory_uri() . '/assets/img/PLAN_'.strtoupper($name).'.png' ?>);" width="100%" alt="">
                                </div>
                                <div class="plan-box-body">
                                    <div class="rates">
                                        <label for="<?= $name.'_weekly' ?>" data-price="<?= $plan['rates']['weekly'] ?>" class="l <?php if($subscription['plan']['name'] != $name): ?> checked <?php elseif($subscription['plan']['name'] == $name && $subscription['plan']['type'] == 'weekly'): ?> checked <?php endif; ?>">
                                            <?php if ($name == 'free'): ?>
                                                N/A
                                            <?php else: ?>
                                                SEMANAL
                                            <?php endif; ?>
                                        </label>
                                        <label for="<?= $name.'_monthly' ?>" data-price="<?= $plan['rates']['monthly'] ?>" class="r <?php if($subscription['plan']['name'] == $name && $subscription['plan']['type'] == 'monthly'): ?> checked <?php endif; ?>">
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
                                                    <?= $subscription['plan']['value'] ?> $
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
                                        <label for="<?= $name ?>" class="<?php if ($subscription['plan']['name'] == $name) { echo 'selected-plan'; } ?>" <?php if ($subscription['plan']['name'] == $name) { echo 'disabled'; } ?>>
                                        <?php if ($subscription['plan']['name'] == $name): ?>
                                            ACTIVO
                                        <?php else: ?>
                                            ESCOGER
                                        <?php endif; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div style="background: #f44336; text-align: center; color: white; padding: 10px;">
                        Un agente se comunicará pronto con usted a la brevedad para completar el pago de su subscripción
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="visibility: hidden;">
            <?php foreach ($plans as $name => $plan): ?>
                <input type="radio" id="<?= $name ?>" name="new_plan[name]" value="<?= $name ?>" <?php if ($subscription['plan']['name'] == $name) { echo 'checked'; } ?>>
            <?php endforeach; ?>

            <input type="radio" id="weekly" name="new_plan[type]" value="weekly" <?php if ($subscription['plan']['type'] == 'weekly') { echo 'checked'; } ?>>
            <input type="radio" id="monthly" name="new_plan[type]" value="monthly" <?php if ($subscription['plan']['name'] == 'montly') { echo 'checked'; } ?>>
        </div>

        <input type="submit" value="Guardar" />

    </fieldset>
</form>