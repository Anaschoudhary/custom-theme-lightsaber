<h1>Light Saber Theme Options</h1>

<?php
$picture = esc_attr(get_option('profile_picture'));
$firstName = esc_attr(get_option('first_name'));
$lastName = esc_attr(get_option('last_name'));
$fullName = $firstName .' '. $lastName; 
$description = esc_attr(get_option('user_description'));
?>

<div class="ls-sidebar-preview">
    <div class="ls-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php echo $picture; ?>);"></div>
        </div>
        <h1 class="ls-username"><?php echo $fullName; ?></h1>
        <h2 class="ls-description"><?php echo $description; ?></h2>
        <div class="icons-wrapper">

        </div>
    </div>
</div>

<?php settings_errors(); ?>
<form method="post" action="options.php" class="ls-general-form">
    <?php
        settings_fields('lightsaber-settings-group');
        do_settings_sections('light_saber'); 
        submit_button();
    ?>
</form>

