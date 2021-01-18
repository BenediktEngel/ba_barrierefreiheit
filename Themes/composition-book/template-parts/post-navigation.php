<?php
/**
 * Template part for displaying the post navigation on single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/
 *
 * @package composition-book
 */

the_post_navigation(
	array(
		'prev_text' => esc_html__( 'Previous: ', 'composition-book' ) . '<span class="post-title">%title</span>',
		'next_text' => esc_html__( 'Next: ', 'composition-book' ) . '<span class="post-title">%title</span>',
	)
); 