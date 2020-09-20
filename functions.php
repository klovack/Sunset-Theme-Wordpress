<?php

require get_template_directory() . '/inc/cleanup.php';

require get_template_directory() . '/inc/functions-admin.php';
require get_template_directory() . '/inc/enqueue.php';

include('inc/gutenberg.php');
new SunsetGutenbergInitialer();

require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/nav-walker.php';




