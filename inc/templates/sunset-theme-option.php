<h1>Sunset Theme Options</h1>

<?php settings_errors() ?>

<?php 
    // $firstName = esc_attr(get_option('first_name'));
    // $lastName = esc_attr(get_option("last_name"));
    // $fullName = $firstName . ' ' . $lastName;
    // $userDescription = esc_attr(get_option('user_description'));
    // $profilePicture = esc_attr(get_option('profile_picture'));
?>

<form class="sunset-sidebar-form" action="options.php" method="POST">
    <?php settings_fields("sunset-theme-options-group"); ?>
    <?php do_settings_sections('rizki_sunset_theme'); ?>
    <?php do_settings_sections("rizki_sunset_contact"); ?>
    <?php submit_button(); ?>
</form>
