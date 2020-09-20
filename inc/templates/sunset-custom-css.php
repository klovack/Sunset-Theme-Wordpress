<h1>Sunset Theme Options</h1>

<?php settings_errors() ?>

<?php 
    // $firstName = esc_attr(get_option('first_name'));
    // $lastName = esc_attr(get_option("last_name"));
    // $fullName = $firstName . ' ' . $lastName;
    // $userDescription = esc_attr(get_option('user_description'));
    // $profilePicture = esc_attr(get_option('profile_picture'));
?>

<form id="save-custom-css-form" class="sunset-sidebar-form" action="options.php" method="POST">
    <?php settings_fields("sunset-custom-css-options-group"); ?>
    <?php do_settings_sections('rizki_sunset_css'); ?>
    <?php submit_button(); ?>
</form>
