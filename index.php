<?php get_header(); ?>

<?php get_template_part( 'template-parts/escort-slider' ); ?>
<?php get_template_part( 'template-parts/escort-filterbar' ); ?>

<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="height: 5px; background-color: #999; margin: 25px 0;"></div>
            <h4 style="color: #f39; text-align:center">¡TU GUÍA DE PROFESIONALES DEL SEXO!</h4>
            <p style="text-align:center">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.</p>
        </div>
    </div>
</section>

<?php prepare_escorts(); ?>

<?php get_template_part( 'template-parts/escort-list' ); ?>

<?php get_footer(); ?>
