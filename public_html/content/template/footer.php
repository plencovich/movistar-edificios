<?php if (!isset($class_body)) { ?>
            <div class="footer white-bg">
                <div class="pull-left"><?php echo FOOTER_COPY.' <span class="hidden-xs">-</span><br class="visible-xs"> '.FOOTER_AUTHOR; ?></div>
                <div class="pull-right"><?php echo FOOTER_TEXT; ?></div>
            </div>
        </div>
    </div>
<?php } ?>
    <script type="text/javascript" src="//cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script type="text/javascript" src="<?php echo APP_FOLDER.'assets/js/bundle.js?'.APP_VERSION;?>"></script>
    <?php if (isset($load_gmaps)) { ?>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY;?>"></script>
<?php } ?>
</body>
</html>
