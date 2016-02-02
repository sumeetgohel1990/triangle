<?php
/*
 * Template Name: FAQ
 *  */
$context = Timber::get_context();
$post = Timber::get_posts('post_type=faq');
$context['post'] = $post;

Timber::render(array('page-faq.twig'), $context);
?>