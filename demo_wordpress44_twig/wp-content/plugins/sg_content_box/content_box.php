<?php
/*
* Plugin Name: Content Box Widget
* Description: A widget that allows you to add image, title and content textarea
* Version: 1.0
* Author: Sumeet Gohel
* License: GPL2

Copyright 2015  Sumeet gohel

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License,
version 2, as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
/**
 * Register the Widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget("Content_Box_Widget");' ) );
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Adds Content Box_Widget widget.
 */
class Content_Box_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'sg_custom_content_box_widget', // Base ID
                __('Content Box', 'text_domain'), // Name
                array('description' => __('A Content Box Widget', 'text_domain'),) // Args
        );
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
    }
    
    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_media();
        wp_enqueue_script('upload_media_widget', plugin_dir_url(__FILE__)  . 'upload-media.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['image'])) {
            echo $args['before_image'] . "<img src='".$instance['image']."' alt='test' />" . $args['after_image'];
        }
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if (!empty($instance['widget_content'])) {
            echo $args['before_widget_content'] .$instance['widget_content']. $args['after_widget_content'];
        }
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        //$image_path = !empty($instance['image_path']) ? $instance['image_path'] : __('', 'text_domain');
        $title = !empty($instance['title']) ? $instance['title'] : __('New title', 'text_domain');
        $widget_content = !empty($instance['widget_content']) ? $instance['widget_content'] : __('', 'text_domain');
        $image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }
        ?>
<!--        <p>
            <label for="<?php echo $this->get_field_id('image_path'); ?>"><?php _e('Image Path:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('image_path'); ?>" name="<?php echo $this->get_field_name('image_path'); ?>" type="text" value="<?php echo esc_attr($image_path); ?>">
        </p>-->
        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat widefat_image" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
        <p>
        <?php
            if ( $instance['image'] != '' ) :
                echo '<img class="custom_media_image" src="' . $instance['image'] . '" style="margin:0;padding:0;max-width:100px;width:100%;display:inline-block" /><br />';
            endif;
        ?>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('widget_content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea id="<?php echo $this->get_field_id('widget_content'); ?>" cols="46" rows="15" name="<?php echo $this->get_field_name('widget_content'); ?>"><?php echo $widget_content; ?></textarea>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['image'] = (!empty($new_instance['image']) ) ? strip_tags($new_instance['image']) : '';
        $instance['widget_content'] = (!empty($new_instance['widget_content']) ) ? strip_tags($new_instance['widget_content']) : '';
        return $instance;
    }

}

// class Content Box_Widget
?>
