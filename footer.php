    
    <footer class="footer-container container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row">
                        <div style="display: block;width:100%;margin-bottom:10px;">
                            <?php get_template_part('template-parts/custom-logo'); ?>
                        </div>

                        <ul class="site-map">
                            <li><a href="#">HOME</a></li>
                            <li><a href="#">LINK</a></li>
                            <li><a href="#">LINK</a></li>
                            <li><a href="#">LINK</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row">
                        <?php dynamic_sidebar('escorts_footer_1'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row">
                        <?php dynamic_sidebar('escorts_footer_2'); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    </body>
</html>