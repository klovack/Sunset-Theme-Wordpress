jQuery(document).ready(function($) {
    let mediaUploader;

    $('#sunset-upload-profile-picture-button').on('click', function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture',
            },
            multiple: false,
        });

        mediaUploader.on('select', function() {
            let attachment = mediaUploader.state().get('selection').first().toJSON();
            
            $('#sunset-input-profile-picture').val(attachment.url);
            let profilePic = $('#sunset-profile-picture-preview'); 
            profilePic.css('background-image', 'url(' + attachment.url + ')');
            profilePic.removeClass('no-display');
        });

        mediaUploader.open();
    });

    $( '#sunset-remove-profile-picture-button' ).on('click', function(e) {
        e.preventDefault();
        
        let answer = confirm("Do you want to remove the profile picture?");
        if (answer) {
            $('#sunset-input-profile-picture').val('');
            $('#sunset-profile-picture-preview').addClass('no-display');

            this.value = "Save changes to permanently remove the image";
            this.disabled = true;
        }
    });
});