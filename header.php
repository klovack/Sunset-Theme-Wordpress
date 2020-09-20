<?php
/* 
    Template for the header
    @package sunsettheme
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <title><?php wp_title();
            bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="container-fluid pl-0 pr-0">
        <div class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>)">
            <div class="header-content">
                <?php
                if (has_site_icon()) :
                ?>
                    <img src="<?php site_icon_url() ?>" alt="Site Icon" class="site-icon">
                <?php endif; ?>
                <h1 class="site-title text-shadow"><?php bloginfo('name'); ?></h1>
                <h5 class="site-description text-shadow"><?php bloginfo('description') ?></h5>
            </div> <!-- .header-content -->

            <div class="nav-container">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-center navbar-sunset">
                    <?php 
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'navbar-nav navbar-nav-sunset',
                            'walker' => new Sunset_Walker_Nav_Primary(),
                        ));
                    ?>
                </nav>

            </div> <!-- .nav-container -->
        </div> <!-- .header-container -->
    </div> <!-- .container-fluid -->