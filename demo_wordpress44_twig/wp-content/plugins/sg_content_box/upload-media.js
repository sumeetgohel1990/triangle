/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//jQuery(document).ready(function($) {
//    jQuery(document).on("click", ".upload_image_button", function() {
//
//        jQuery.data(document.body, 'prevElement', $(this).prev());
//
//        window.send_to_editor = function(html) {
//            var imgurl = jQuery('img',html).attr('src');
//            var inputText = jQuery.data(document.body, 'prevElement');
//            
//            if(inputText != undefined && inputText != '')
//            {
//                inputText.val(imgurl);
//            }
//
//            tb_remove();
//        };
//
//        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
//        return false;
//    });
//});

jQuery(function($){
 //   $('.upload_image_button').click(function(e) {
      $('body').on('click','.upload_image_button',function(e) {

        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Title',
            button: {
                text: 'Custom Button Text',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $("#preview_image").attr('src', attachment.url);
            $("#preview_image").show();
            $('.widefat_image').val(attachment.url);
              $('.custom_media_image').attr('src',attachment.url).css('display','block');
            //$('.custom_media_id').val(attachment.id);
        })
        .open();
    });
});