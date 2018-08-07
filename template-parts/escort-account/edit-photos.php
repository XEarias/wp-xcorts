<?php 

    $post_id = $user['ad']['ID'];

    $featured_image = get_the_post_thumbnail_url($post_id);
    $media = get_escort_ad_attachments($post_id);

?>

<form action="<?php echo admin_url('/admin-post.php'); ?>" method="POST" class="escort-form" id="escort-edit-photos" enctype="multipart/form-data" novalidate>
    
    <input type="hidden" name="action" value="update_escort_ad" />
    <input type="hidden" name="redirect_p" value="photos" />

    <fieldset>


        <h4>Imagen principal y galeria</h4>

        <div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <label for="featured_image">Foto destacada (*)</label>
                <div class="row featured-image-box">
                    <label for="featured_image"></label>
                    <div class="col-md-2 offset-md-5 item">
                        <label for="featured_image" style="min-height: 130px">
                            <img src="<?= $featured_image ?>" style="max-height:100%; max-width:100%;" alt="">
                        <label/>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="file" id="featured_image" name="featured_image" style="visibility:hidden; height: 1px"><br>
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
                <input type="file" id="images" name="images[]" style="visibility:hidden; height: 1px" multiple>
            </div>
        </div>

        <div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <label>Actuales <small>(seleccione para eliminar)</small></label>
                <div class="row images-box actuals">
                    <label></label>
                    <?php foreach($media['images'] as $image): ?>
                    <div class="col-md-2 item main">
                        <label for="images" style="height: 130px; cursor: pointer; position: relative">
                            <img src="<?= $image['url'] ?>" style="max-height:100%; max-width:80%;" alt="">
                            <input class="form-check-input"type="checkbox" name="delete_images[]" id="<?php echo $image["ID"];?>" value="<?php echo $image["ID"];?>" style="    position: absolute; top: 0; left: 25px;">
                        <label/>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 25px">
            <div class="col-md-12">
                <label>Video</label>
                <div class="custom-file">
                    <input type="file" name="video" id="video" style="visibility: visible">
                </div>
                <?php if(count($media['videos'])): ?>
                <div style="text-align: center;margin-top: 5px;">
                    <video width="400" controls>
                        <source src="<?= $media['videos'][0]['url'] ?>" type="video/mp4">
                        Tu navegador no soporta HTML5 video
                    </video>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <input type="submit" value="Guardar" />

    </fieldset>
</form>