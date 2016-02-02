<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
$data['my_sidebar']='';
if(is_active_sidebar('sidebar-content-box')):
    $data['my_sidebar']= dynamic_sidebar('sidebar-content-box');
endif;
Timber::render( array( 'sidebar.twig' ), $data );
