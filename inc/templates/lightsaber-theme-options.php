<h1>LightSaber Theme Options</h1>
<?php settings_errors(); ?>


<form method="post" action="options.php" class="ls-general-form">
    <?php
        settings_fields('ls-theme-option-group');
        do_settings_sections('lightsaber_theme_options_page'); 
        submit_button();
    ?>
</form>