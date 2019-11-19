<h1>Light Saber Theme Options</h1>

<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php
        settings_fields('lightsaber-settings-group');
        do_settings_sections('light_saber'); 
        submit_button();
    ?>
</form>

