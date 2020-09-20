jQuery(document).ready( function($) {
    var updateCSS = function() {
        $('#sunset_custom_css').val(editor.getSession().getValue());

        console.log("Submitted");
        console.log($('#sunset_custom_css').val);
    };


    $('#save-custom-css-form').submit( updateCSS );
});

var editor = ace.edit("sunset-custom-css-editor");
editor.getSession().setMode("ace/mode/css");
editor.setTheme("ace/theme/monokai");
editor.setWrapBehavioursEnabled(true);