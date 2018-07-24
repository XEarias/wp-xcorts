<section class="filterbar-container container-fluid">
    <form action="<?php echo home_url();?>" method="GET">
        <div class="row" style="margin-top: 25px">
            <div class="col-md-2 offset-md-1 form-group">
                <select name="hair_color" id="hair_color" class="form-control">
                    <option selected>Color de cabello</option>
                    <option>Negro</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="skin_color" id="skin_color" class="form-control">
                    <option selected>Color de piel</option>
                    <option>Negra</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="complexion" id="complexion" class="form-control">
                    <option selected>Complexion</option>
                    <option>Delgada</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="stature" id="stature" class="form-control">
                    <option selected>Estatura</option>
                    <option>Baja</option>
                </select> 
            </div>
            <div class="col-md-2 form-group text-center">
                <button type="submit" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">BUSCAR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a data-toggle="collapse" href="#extra-filters" role="button" aria-expanded="false" aria-controls="extra-filters" class="btn mb-2" style="background-color: #f39; color: white; border-radius:0;">
                    <small> Más filtros</small>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="collapse pt-3" id="extra-filters">
                    <div class="row text-center">
                        EDAD, CIUDAD, TARIFA, SERVICIOS
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php
/*Color Cabello , Color de Piel , Complexion, Estatura

Ciudad

Edad

Tarifa

Servicios
*/
?>