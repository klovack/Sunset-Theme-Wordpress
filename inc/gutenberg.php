<?php 

/**
 * Custom Gutenberg functions
 * 
 */

class SunsetGutenbergInitialer {

    function __construct()
    {
        add_action('init', array($this, 'RegisterCustomTypes'));
        add_action('enqueue_block_editor_assets', array($this, 'RegisterCustomStyle'));
        add_action('init', array($this, 'AddBlockPatterns'));
        add_action('after_setup_theme', [$this, 'AddColorPalette']);
    }

    function RegisterCustomTypes() {
        wp_register_script('icon-text-js', get_template_directory_uri() . '/js/blocks/out/icon-text.js', array('wp-blocks', 'wp-block-editor', 'wp-components'));
        wp_register_style('sunset-blocks-style', get_stylesheet_directory_uri() . '/css/blocks.css');

        register_block_type('sunset/icon-text', array(
            'editor_script' => 'icon-text-js',
            'editor_style'  => 'sunset-blocks-style',
            'style'         => 'susnet-blocks-style',
        ));
    }

    function RegisterCustomStyle() {
        wp_enqueue_script('sunset-blocks-scripts', get_stylesheet_directory_uri() . '/js/blocks/out/sunset-blocks.js', array('wp-blocks'), '0.0.1', true);
    }

    function AddColorPalette() {
        add_theme_support('editor-color-palette', [
            [
                'name'      => _( 'Primary Brown', 'Sunset'),
                'slug'      => 'primary-brown',
                'color'     => '#CA9768',
            ],
            [
                'name'      => _( 'Secondary Dark Brown', 'Sunset'),
                'slug'      => 'secondary-dark-brown',
                'color'     => '#604635',
            ],
            [
                'name'      => _( 'Accent Yellow', 'Sunset'),
                'slug'      => 'accent-yellow',
                'color'     => '#FFC508',
            ],
            [
                'name'      => _( 'Text Dark', 'Sunset'),
                'slug'      => 'text-dark',
                'color'     => '#141414',
            ],
            [
                'name'      => _( 'Text Light', 'Sunset'),
                'slug'      => 'text-light',
                'color'     => '#FFFFFF',
            ],
        ]);
    }

    function AddBlockPatterns() {
        register_block_pattern(
            'sunset/about-us-pattern',
            array(
                'title'       => __( 'About Us Section', 'sunset' ),
                'description' => _x( 'A Heading, descriptions and gallery inside nicely theme wrapper', 'Block pattern description', 'sunset' ),
                'content'     => "<!-- wp:group {\"className\":\"is-style-sunset-about-us-section\"} -->\n<div class=\"wp-block-group is-style-sunset-about-us-section\"><div class=\"wp-block-group__inner-container\"><!-- wp:group {\"className\":\"is-style-sunset-wrapper\"} -->\n<div class=\"wp-block-group is-style-sunset-wrapper\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"className\":\"is-style-sunset-heading\",\"textColor\":\"text-light\"} -->\n<h2 class=\"is-style-sunset-heading has-text-light-color has-text-color\">Über Sunset!</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"textColor\":\"text-light\"} -->\n<p class=\"has-text-light-color has-text-color\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"className\":\"is-style-sunset-left-figcaption\"} -->\n<figure class=\"wp-block-image is-style-sunset-left-figcaption\"><img alt=\"\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"is-style-sunset-quote-column is-style-sunset-quote-group\"} -->\n<div class=\"wp-block-column is-style-sunset-quote-column is-style-sunset-quote-group\"><!-- wp:paragraph -->\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group -->\n</div></div>\n<!-- /wp:group -->",
            )
        );
    }
}



?>