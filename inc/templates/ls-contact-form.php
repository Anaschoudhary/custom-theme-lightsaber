<h1>LightSaber Conact Form</h1>
<?php settings_errors(); ?>


<form method="post" action="options.php" class="ls-general-form">
    <?php   
        settings_fields('ls-contact-setting-group'); //settings_fields($option_group)
        do_settings_sections('ls_theme_contact_page'); 
        submit_button();
    ?>
</form>