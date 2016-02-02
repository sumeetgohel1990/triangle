<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
 global $paged;
    if (!isset($paged) || !$paged){
        $paged = 1;
    }
$custom_args = array(
    'post_status' => 'publish',
     'paged' => $paged,
    'meta_query' => array(
         array(
            'key' => '_show_front_page',
            'value' => 'yes',
            'compare' => '='
        ) 
    ),
);
 $my_args=new WP_Query($custom_args);
// echo "<pre>";
// print_r($my_args);
// echo "</pre>";
//$my_query= new WP_Query($custom_args);
$context['homepageposts'] = Timber::get_posts($custom_args);
$context['pagination'] = Timber::get_pagination();
$context['gallery'] = Timber::get_posts('post_type=gallery');
$context['gallery_archieve_link'] =  site_url().'/gallery';

$templates = array( 'page-' . $post->post_name . '.twig', 'page.twig' );
//Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );
/* Snippets */
if ( is_home()  || is_front_page()) {
    $templates = array(  'home.twig' );
}
Timber::render( $templates, $context );
/* End of snippets */