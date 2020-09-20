<?php 
/* 
    @package sunsettheme

    ===============================
    REMOVE GENERATOR VERSION NUMBER
    ===============================
*/

/**
 * Remove the wordpress version from the enqueued scripts and styles.
 */
function sunset_remove_wp_versions( $src) {
    global $wp_version;
    parse_str( parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}
add_filter('script_loader_src', 'sunset_remove_wp_versions');
add_filter('style_loader_src', 'sunset_remove_wp_versions');


/**
 * Remove the generated meta tag that has the wordpress version
 * to hide the vulnerability of the wordpress for that version.
 */
function sunset_remove_meta_version() {
    return '';
}

add_filter('the_generator', 'sunset_remove_meta_version');