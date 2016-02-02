<?php
 /*
Template Name: Blog
*/
if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['foo'] = 'bar';
$templates = array( 'blog.twig');
Timber::render($templates, $context);
?>
