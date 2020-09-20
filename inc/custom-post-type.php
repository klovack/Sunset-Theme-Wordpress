<?php

/*
@package sunsettheme

    =======================
        CUSTOM POST TYPE
    =======================
*/

$activateContact = get_option('activate_contact');
if (!empty($activateContact)) {
    add_action( 'init', 'sunset_contact_custom_post_type' );

    add_filter( 'manage_sunset-contact_posts_columns', 'sunset_set_contact_columns' );
    add_action( 'manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2);

    add_action( 'add_meta_boxes', 'sunset_contact_add_meta_box');
    add_action( 'save_post', 'sunset_save_contact_email_data');
}

/* 
    CUSTOM POST TYPE:
        CONTACT
    ================
*/

function sunset_contact_custom_post_type() {
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message',
    );

    $postTypeArgs = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hiearchical'       => false,
        'menu_postition'    => 26,
        'menu_icon'         => 'dashicons-testimonial',
        'supports'          => array('title', 'editor', 'author'),
    );

    register_post_type('sunset-contact', $postTypeArgs);
}

function sunset_set_contact_columns($columns) {
    $newColumns = array(
      'title'       => 'Full Name',
      'message'     => 'Message',
      'email'       => 'Email',
      'date'        => 'Date',
    );
    return $newColumns;
}

function sunset_contact_custom_column($column, $post_id) {
    switch ($column) {
        case 'message':
            echo get_the_excerpt();
            break;
        
        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
            break;
            
        default:
            break;
    }
}

/* 
    ==================
    CONTACT META BOXES
    ==================
*/

function sunset_contact_add_meta_box() {
    add_meta_box('sunset_contact_user_email', 'User Email', 'sunset_contact_email_callback', 'sunset-contact', 'side', 'high');
}

function sunset_contact_email_callback( $post ) {
    wp_nonce_field( 'sunset_save_contact_email_data', 'sunset_contact_email_meta_box_nonce');

    $customMetaBoxValue = get_post_meta($post->ID, '_contact_email_value_key', true);
    
    echo '<label for="sunset_contact_email_field">User Email Address</label>
    <input type="email" name="sunset_contact_email_field" id="sunset_contact_email_field" size="25" value="'. esc_attr($customMetaBoxValue) . '"/>';
}

function sunset_save_contact_email_data( $post_id ) {

    // Check for the contact email nonce to be set
    if ( !isset( $_POST['sunset_contact_email_meta_box_nonce'] ) ) {
        return;
    }

    // Verify the contact email nonce
    if ( !wp_verify_nonce($_POST['sunset_contact_email_meta_box_nonce'], 'sunset_save_contact_email_data')) {
        return;
    }

    // Optional when avoiding autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Make sure the user has permission to edit post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check whether the email address is not null
    if (!isset($_POST['sunset_contact_email_field'])) {
        return;
    }

    $emailData = sanitize_text_field($_POST['sunset_contact_email_field']);

    update_post_meta($post_id, '_contact_email_value_key', $emailData);
}