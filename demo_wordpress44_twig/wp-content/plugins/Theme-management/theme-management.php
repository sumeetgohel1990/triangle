<?php
/*
  Plugin Name: Theme configration
  Description: Theme basic configration
  Version: 1.0
  Author: Goldy Faldu
 */

add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
    add_theme_page('Configration', 'Configration', 'edit_theme_options', 'theme-configration', 'theme_configration');
}

if (isset($_GET['page']) && $_GET['page'] == 'theme-configration') {
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles', 'my_admin_styles');
}

function theme_configration() {
    if ($_POST['submit']) {
        foreach ($_POST as $k => $v) {
            if ($k != 'submit') {
                update_option($k, $v);
            }
        }
    }
    ?>
    <script src="<?php echo plugins_url(); ?>/Theme-management/jquery-1.7.1.min.js"></script>
    <div class="wrap">
        <h2>General Settings</h2>
        <form method="post"  >

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="telephone">Contact number</label></th>
                        <td><input name="telephone" type=tel id="telephone" value="<?php echo get_option('telephone'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="telephone">Office number</label></th>
                        <td><input name="office_number" type=tel id="telephone" value="<?php echo get_option('office_number'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="telephone">Mobile number</label></th>
                        <td><input name="mobile_number" type=tel id="telephone" value="<?php echo get_option('mobile_number'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="inquiry_mail">Inquiry Mail</label></th>
                        <td><input name="inquiry_mail" type="email" id="inquiry_mail" value="<?php echo get_option('inquiry_mail'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="address">Address</label></th>
                        <td><textarea cols="40" id="address" name="address"><?php echo get_option('address'); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="copyright">Copyright message</label></th>
                        <td><textarea  cols="40"  id="copyright" name="copyright"><?php echo get_option('copyright'); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="upload_image">Logo</label></th>
                        <td><input id="upload_image" type="text" size="36" name="upload_image" value="<?php echo get_option('upload_image'); ?>" />
                            <input id="upload_image_button" type="button" value="Upload Image" />   <br /> <img class="upload_image_display" src="<?php echo get_option('upload_image'); ?>"   width="200px;"/>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="menu_upload_image">Menu Logo</label></th>
                        <td><input id="menu_upload_image" type="text" size="36" name="menu_upload_image" value="<?php echo get_option('menu_upload_image'); ?>" />
                            <input id="menu_upload_image_button" type="button" value="Menu Upload Image" />   <br /> <img class="menu_upload_image_display" src="<?php echo get_option('menu_upload_image'); ?>"   width="200px;"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="banner_image">Banner Image</label></th>
                        <td><input id="banner_image" type="text" size="36" name="banner_image" value="<?php echo get_option('banner_image'); ?>" />
                            <input id="banner_image_image_button" type="button" value="Banner Image" />   <br /> <img class="banner_image_display" src="<?php echo get_option('banner_image'); ?>"   width="200px;"/>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="footer_text">Banner text</label></th>
                        <td><textarea cols="40" rows="5" id="banner_text" name="banner_text"><?php echo stripslashes(get_option('banner_text')); ?></textarea></td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="footer_text">Footer text</label></th>
                        <td><textarea cols="40" rows="5" id="footer_text" name="footer_text"><?php echo stripslashes(get_option('footer_text')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                        <td style="padding: 0;"><h3>Social Setting</h3> </td>

                    </tr>
                    <tr>
                        <th scope="row"><label for="facebook">Facebook</label></th>
                        <td><input name="facebook" type="url" id="facebook" value="<?php echo get_option('facebook'); ?>" class="regular-text"></td>
                    </tr>
<!--                    <tr>
                        <th scope="row"><label for="google">Google + </label></th>
                        <td><input name="google" type="url" id="google" value="<?php echo get_option('google'); ?>" class="regular-text"></td>
                    </tr>-->
                    <tr>
                        <th scope="row"><label for="linkedin">Linkedin </label></th>
                        <td><input name="linkedin" type="url" id="linkedin" value="<?php echo get_option('linkedin'); ?>" class="regular-text"></td>
                    </tr>
<!--                    <tr>
                        <th scope="row"><label for="pinterest">Pinterest </label></th>
                        <td><input name="pinterest" type="url" id="pinterest" value="<?php echo get_option('pinterest'); ?>" class="regular-text"></td>
                    </tr>-->
                    <tr>
                        <th scope="row"><label for="Instagram">Instagram </label></th>
                        <td><input name="Instagram" type="url" id="Instagram" value="<?php echo get_option('Instagram'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="twitter">Twitter</label></th>
                        <td><input name="twitter" type="url" id="twitter" value="<?php echo get_option('twitter'); ?>" class="regular-text"></td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="twitter_post_to_display">Tweets to Display</label></th>
                        <td><input name="twitter_post_to_display" type="text" id="twitter_post_to_display" value="<?php echo get_option('twitter_post_to_display'); ?>" class="regular-text"></td>
                    </tr>
                 <tr>
                        <td style="padding: 0;"><h3>Paypal Setting</h3> </td>

                    </tr>
                    <tr>
                        <th scope="row"><label for="facebook">Paypal Client ID</label></th>
                        <td><input name="paypal_client" type="text" id="paypal_client" value="<?php echo get_option('paypal_client'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="facebook">Paypal Client Secret</label></th>
                        <td><input name="paypal_secret" type="text" id="paypal_secret" value="<?php echo get_option('paypal_secret'); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="facebook">Paypal Mode</label></th>
                        <td><input name="paypal_mode" type="text" id="paypal_mode" value="<?php echo get_option('paypal_mode'); ?>" class="regular-text"></td>
                    </tr>
                    
                </tbody></table>


            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p></form>

    </div>
    <script>
        jQuery(document).ready(function() {
            $('#upload_image_button').click(function(e) {
                e.preventDefault();
                var custom_uploader = wp.media({
                    title: 'Custom Image',
                    button: {
                        text: 'Upload Image'
                    },
                    multiple: false  // Set this to true to allow multiple files to be selected
                })
                        .on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('.upload_image_display').attr('src', attachment.url);
                    $('#upload_image').val(attachment.url);

                })
                        .open();
            });
            $('#banner_image_image_button').click(function(e) {
                e.preventDefault();
                var custom_uploader = wp.media({
                    title: 'Banner Image',
                    button: {
                        text: 'Upload Image'
                    },
                    multiple: false  // Set this to true to allow multiple files to be selected
                })
                        .on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('.banner_image_display').attr('src', attachment.url);
                    $('#banner_image').val(attachment.url);

                })
                        .open();
            });

             $('#menu_upload_image_button').click(function(e) {
                e.preventDefault();
                var custom_uploader = wp.media({
                    title: 'Custom Image',
                    button: {
                        text: 'Upload Image'
                    },
                    multiple: false  // Set this to true to allow multiple files to be selected
                })
                        .on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('.menu_upload_image_display').attr('src', attachment.url);
                    $('#menu_upload_image').val(attachment.url);

                })
                        .open();
            });

        });
    </script>
    <?php
}

function my_admin_scripts() {
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
}
?>
