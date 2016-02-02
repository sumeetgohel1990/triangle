<?php

/*
 *  consumer : ck_f58732f2270273a2a78cc5bdf69a203c5119d9d8
 *  consumer sercret :cs_5468a32c40b6b17b56ff5dcc5b12565670776aa7

 */
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * 
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['comment_form'] = TimberHelper::get_comment_form();
$context['cat_name']=  get_cat_name(wp_get_post_categories($post->ID ));
$context['cat_link']= get_category_link(wp_get_post_categories($post->ID ));
$archive_year  = get_the_time('Y'); 
$archive_month = get_the_time('m'); 
$archive_day   = get_the_time('d'); 
$context['post_date_archieve_link']=get_day_link( $archive_year, $archive_month, $archive_day);
$get_cmmnets =  get_comment_count($post->ID);
$context['comment_count']= $get_cmmnets['total_comments'];
/* author data */
$context['post_author_bio']['full_name']=get_the_author_meta( 'display_name' );
$context['post_author_bio']['description']=  get_the_author_meta( 'description' );
$context['post_author_bio']['image_src']=  get_avatar_url(get_the_author_meta( 'ID' ));




if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
