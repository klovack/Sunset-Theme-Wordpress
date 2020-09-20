<?php

/*
@package sunsettheme

    =================
        ADMIN PAGE
    =================
*/

// Declaration of the pages and sub pages in the admin panel
function sunset_add_admin_page() {
    // Generate sunset admin page
    add_menu_page("Sunset Theme Options", "Sunset", "manage_options", "rizki_sunset", "sunset_theme_create_page", get_template_directory_uri() . "/img/sunset-icon.png", 110);

    // Generate sunset admin subpages
    add_submenu_page("rizki_sunset", "Sunset Sidebar Options", "Sidebar", "manage_options", "rizki_sunset", "sunset_theme_create_page");
    add_submenu_page('rizki_sunset', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'rizki_sunset_theme', 'sunset_theme_options');

    // Separate contact page, which we don't really need
    // add_submenu_page('rizki_sunset', 'Sunset Contact Options', 'Contact Options', 'manage_options', 'rizki_sunset_contact', 'sunset_contact_options');

    add_submenu_page("rizki_sunset", "Sunset CSS Options", "Custom CSS", "manage_options", "rizki_sunset_css", "sunset_theme_custom_css");

    // Activate custom settings
    add_action("admin_init", "sunset_custom_settings");
    
}
add_action("admin_menu", "sunset_add_admin_page");

// Template submenu functions
function sunset_theme_create_page() {
    // Generate the admin page
    require_once( get_template_directory() . "/inc/templates/sunset-admin.php");
}

// Template for the custom css
function sunset_theme_custom_css() {
    // Generate the setting page
    require_once( get_template_directory() . '/inc/templates/sunset-custom-css.php');
}

function sunset_theme_options() {
    require_once( get_template_directory() . '/inc/templates/sunset-theme-option.php');
}

function sunset_contact_options() {
    require_once( get_template_directory() . '/inc/templates/sunset-contact-option.php' );
}

function sunset_custom_settings() {
    // Sidebar Options
    register_setting('sunset-settings-group', 'profile_picture');

    register_setting("sunset-settings-group", "first_name");
    register_setting("sunset-settings-group", "last_name");
    register_setting("sunset-settings-group", "user_description");

    register_setting("sunset-settings-group", "twitter_account", 'sunset_sanitize_social_media');
    register_setting("sunset-settings-group", "facebook_account");
    register_setting("sunset-settings-group", "instagram_account");


    add_settings_section("sunset-sidebar-options", "Sidebar Options", "sunset_sidebar_options_section", "rizki_sunset");

    add_settings_field("sidebar-profile-picture", "Profile Picture", "sunset_sidebar_profile_picture", "rizki_sunset", "sunset-sidebar-options");
    
    add_settings_field("sidebar-name", "Full Name", "sunset_sidebar_name", "rizki_sunset", "sunset-sidebar-options");
    add_settings_field("sidebar-user-description", "Description", "sunset_sidebar_user_description", "rizki_sunset", "sunset-sidebar-options");
    
    add_settings_field("sidebar-twitter", "Twitter", "sunset_sidebar_social_media", "rizki_sunset", "sunset-sidebar-options", array(
        'option_name' => 'twitter_account',
        'placeholder_uri' => 'https://twitter.com/username',
        'description' => 'Enter your twitter account without the @ symbol'
    ));
    add_settings_field("sidebar-facebook", "Facebook", "sunset_sidebar_social_media", "rizki_sunset", "sunset-sidebar-options", array(
        'option_name' => 'facebook_account',
        'placeholder_uri' => 'https://facebook.com/username'
    ));
    add_settings_field("sidebar-instagram", "Instagram", "sunset_sidebar_social_media", "rizki_sunset", "sunset-sidebar-options", array(
        'option_name' => 'instagram_account',
        'placeholder_uri' => 'https://instagram.com/username'
    ));
    // END Sidebar Options


    // Theme Options
    register_setting('sunset-theme-options-group', 'post_formats');
    register_setting('sunset-theme-options-group', 'custom_header');
    register_setting('sunset-theme-options-group', 'custom_background');

    add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options_section', 'rizki_sunset_theme');
    add_settings_field('options-post-formats', 'Post Formats', 'sunset_post_formats', 'rizki_sunset_theme', 'sunset-theme-options');
    add_settings_field('options-custom-header', 'Custom Header', 'sunset_custom_header', 'rizki_sunset_theme', 'sunset-theme-options');
    add_settings_field('options-custom-background', 'Custom Background', 'sunset_custom_background', 'rizki_sunset_theme', 'sunset-theme-options');
    // END Theme Options


    // Contact Form Options
    register_setting('sunset-theme-options-group', 'activate_contact');

    // Change the page to rizki_sunset_contact if you want to match the page slug
    add_settings_section('sunset-contact-options', 'Contact Options', '', 'rizki_sunset_theme');
    add_settings_field('activate-contact', 'Activate Contact Form', 'sunset_activate_contact', 'rizki_sunset_theme', 'sunset-contact-options');
    // END Contact Form Options

    
    // Custom CSS Options
    register_setting('sunset-custom-css-options-group', 'sunset_custom_css', 'sunset_sanitize_custom_css');

    add_settings_section('sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section_callback', 'rizki_sunset_css');
    add_settings_field('sunset-custom-css', 'Insert your Custom CSS', 'sunset_custom_css_callback', 'rizki_sunset_css', 'sunset-custom-css-section');
}

/*
    ==============
        SIDEBAR
    ==============
*/
function sunset_sidebar_options_section() {
    echo "Customize your Sidebar Information";
}

function sunset_sidebar_profile_picture() {
    $profilePic = esc_attr(get_option('profile_picture'));
    
    if ( empty($profilePic) ) {
        echo '<input class="button button-secondary" type="button" value="Upload Profile Picture" id="sunset-upload-profile-picture-button">';
        echo '<input type="hidden" name="profile_picture" value="'. $profilePic .'" id="sunset-input-profile-picture" />';
    } else {
        echo '<input class="button button-secondary" type="button" value="Replace Profile Picture" id="sunset-upload-profile-picture-button"> 
        <input class="button button-delete" type="button" value="Remove" id="sunset-remove-profile-picture-button"/>';
        echo '<input type="hidden" name="profile_picture" value="'. $profilePic .'" id="sunset-input-profile-picture" />';
    }
}

function sunset_sidebar_name() {
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option("last_name"));
    echo '<input type="text" name="first_name" value="'. $firstName . '" placeholder="Max" />';
    echo '<input type="text" name="last_name" value="'. $lastName . '" placeholder="Mustermann" />';
}

function sunset_sidebar_user_description() {
    $userDescription = esc_attr(get_option('user_description'));
    echo '<textarea name="user_description" rows="3" cols="44" placeholder="I was once a cool guy">'. $userDescription .'</textarea>';
}

function sunset_sidebar_social_media(array $args) {
    $optionName = $args['option_name'];
    $placeholder_uri = $args['placeholder_uri'];
    $socialAccount = esc_attr(get_option($optionName));
    echo '<input type="text" name="'. $optionName .'" value="'. $socialAccount . '" placeholder="'. $placeholder_uri .'" />';

    if (array_key_exists('description', $args)) {
        $description = $args['description'];
        echo '<p class="description">'. $description .'</p>';
    }
}

function sunset_sanitize_social_media($input) {
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}


/*
    =====================
        THEME OPTIONS
    =====================
*/
function sunset_theme_options_section() {
    echo 'Activate and Deactivate specific Theme Support Options';
}

function sunset_post_formats() {
    $options = get_option('post_formats');
    $formats = array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
    );
    $output = '';

    foreach ($formats as $format) {
        // $output .= '<li><label><input type="checkbox" name="'.$format.'" id="cb-'.$format.'" value="1">'.$format.'</label></li>';
        $checked = (@$options[$format] == 1 ? 'checked' : '');
        
        $output .= '<label><input type="checkbox" name="post_formats['.$format.']" id="cb-'.$format.'" value="1" '.$checked.'>'.$format.'</label><br>';
    }

    echo $output;
    // echo '<ul>'.$output.'</ul>';
}

function sunset_custom_header() {
    $options = get_option('custom_header');
    $checked = ( empty($options) ? '' : 'checked');
    echo '<label><input type="checkbox" name="custom_header" id="cb-custom_header" value="1" '.$checked.'>Use Custom Header</label><br>';
    echo 'Toggle the Header menu in appearance setting';
}

function sunset_custom_background() {
    $options = get_option('custom_background');
    $checked = ( empty($options) ? '' : 'checked');
    echo '<label><input type="checkbox" name="custom_background" id="cb-custom_background" value="1" '.$checked.'>Use Custom Background</label><br>';
    echo 'Toggle the Background menu in appearance setting';
}


/*
    ==============
        CONTACT
    ==============
*/

function sunset_activate_contact() {
    $options = get_option('activate_contact');
    $checked = ( empty($options) ? '' : 'checked');
    echo '<input type="checkbox" name="activate_contact" id="cb-activate_contact" value="1" '.$checked.'>';
}


/*
    =================
        CUSTOM CSS  
    =================
*/

function sunset_custom_css_section_callback() {
    echo 'Customize sunset theme with your css';
}

function sunset_custom_css_callback() {
    $customCSS = get_option('sunset_custom_css');
    $customCSS = (empty($customCSS) ? '/* Sunset Theme Custom CSS */' : $customCSS);
    echo '<div id="sunset-custom-css-editor">'. $customCSS .'</div> <textarea id="sunset_custom_css" name="sunset_custom_css" style="display:none;visibility:hidden">'. $customCSS .'</textarea>';
}

function sunset_sanitize_custom_css($input) {
    $output = esc_textarea($input);
    return $output;
}