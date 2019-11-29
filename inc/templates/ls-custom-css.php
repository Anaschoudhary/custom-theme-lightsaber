<h2>LightSaber Custom CSS</h2>
<?php settings_errors(); ?>


<form id="save-custom-css-form" method="post" action="options.php" class="ls-general-form">
    <?php   
        settings_fields('ls-custom-css-options'); //settings_fields($option_group)
        do_settings_sections('light_saber_css'); 
        submit_button();
    ?>
</form>