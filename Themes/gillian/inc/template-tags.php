<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gillian
 */

if ( ! function_exists( 'gillian_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the author, current post-date/time, 
 * comments, categories, and tags.
 */
function gillian_entry_meta() {
	

	/* Fehler aus Prüfschritt 1.3.1b und 2.4.4a durch hinzufügen einer DefinitionList für die Meta-Daten behoben. */
// byline
echo '<dl><dt class="screen-reader-text">';
_e( 'by ', 'gillian' );
	echo '</dt><dd>';
the_author_posts_link();
echo '</dd>';

// date
echo '<dt class="screen-reader-text">Published on</dt><dd><i class="fa fa-calendar-o" aria-hidden="true"></i>';
the_time(get_option('date_format'));

// time
	echo '<i class="fa fa-clock-o" aria-hidden="true" style="padding-left: 20px;"></i>';
the_time();
echo '</dd>';


// categories if they exist
if(has_category()) {
	echo '<dt class="screen-reader-text">Category</dt><dd><i class="fa fa-bookmark" aria-hidden="true"></i>';
	the_category(', ');
	echo '</dd>';
}

// tags if they exist
if(has_tag()) {
	echo '<dt class="screen-reader-text">Tags</dt><dd>';
	the_tags('<i class="fa fa-tag" aria-hidden="true"></i> ', ', ');
	echo '</dd>';
}
	echo '</dl>';
// comments
	echo '<p style="padding-right:20px;"><i class="fa fa-comment" aria-hidden="true"></i>';
/* translators: %s: post title */
comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'gillian' ), get_the_title() ) );
echo '</p>';
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gillian_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'gillian_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'gillian_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gillian_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gillian_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gillian_categorized_blog.
 */
function gillian_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gillian_categories' );
}
add_action( 'edit_category', 'gillian_category_transient_flusher' );
add_action( 'save_post',     'gillian_category_transient_flusher' );

/* extra menus */

function gillian_top_menu() {
    if ( has_nav_menu( 'top-menu' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'top-menu',
			'menu_id'		  => 'top-menu',
			'fallback_cb'     => '',
		)
	);
    }
}

function gillian_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu-social',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);
    }
}