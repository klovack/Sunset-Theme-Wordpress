<h1>Sunset Sidebar Options</h1>

<?php settings_errors() ?>

<?php 
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option("last_name"));
    $fullName = $firstName . ' ' . $lastName;
    $userDescription = esc_attr(get_option('user_description'));
    $profilePicture = esc_attr(get_option('profile_picture'));

    $hasProfilePicture = ( empty($profilePicture) ? 'no-display' : '');
?>

<section id="sunset-general-form">
    <div class="sunset-sidebar-preview">
        <p class="sunset-sidebar-preview-text">Preview</p>
        <div class="sunset-sidebar">
            <div class="image-container">
                <div id="sunset-profile-picture-preview" class="sunset-profile-picture <?php echo $hasProfilePicture ?>" style="background-image: url(<?php echo $profilePicture; ?>);">
                </div>
            </div>
            <h1 class="sunset-username"><?php echo $fullName; ?></h1>
            <h2 class="sunset-description"><?php echo $userDescription ?></h2>
            <div class="sunset-social-icons">
            </div>
        </div>
    </div>
    
    <form class="sunset-sidebar-form" action="options.php" method="POST">
        <?php settings_fields("sunset-settings-group"); ?>
        <?php do_settings_sections("rizki_sunset"); ?>
        <?php submit_button(); ?>
    </form>
</section>

