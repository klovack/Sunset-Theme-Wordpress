<h1>Sunset Contact Form</h1>
<?php settings_errors() ?>

<form class="sunset-sidebar-form" action="options.php" method="POST">
    <?php settings_fields("sunset-contact-options-group"); ?>
    <?php do_settings_sections("rizki_sunset_contact"); ?>
    <?php submit_button(); ?>
</form>