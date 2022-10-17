<?php
/**
 * add custom post type
 */

$custom_post_type = new \Ddoc_custom_post_type\Ddoc_Custom_Post_type;
$taxonomy = new \Ddoc_custom_post_type\Ddoc_Taxonomies;

$custom_post_type->ddoc_post_type('video-docs', 'Video Doc', 'Video Docs', array('title', 'editor', 'author', 'thumbnail', 'excerpt'));
$taxonomy->ddoc_taxonomy( 'video-category', 'Category', 'Categories', 'video-docs');