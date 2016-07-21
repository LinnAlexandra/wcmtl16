<?php

// Register menu(s)
register_nav_menus(
	array('main-nav' => 'Main Navigation')
);

// Register widgetized area(s)
function felinedesignco_widgets_init() {
	register_sidebar( array(
		'id' => 'blog-widget-area',
		'name' => 'Blog Widget Area',
		'description' => 'Appears on the blog and single posts.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<section class="blog-widget">',
		'after_widget' => '</section><!-- .blog-widget -->',
	) );
}
add_action('widgets_init', 'felinedesignco_widgets_init');

// Register and enqueue styles and scripts
function felinedesignco_styles_and_scripts() {
	wp_enqueue_style('core', get_stylesheet_uri());
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Bitter');
	if ( is_singular() && get_option('thread_comments') && comments_open() ) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'felinedesignco_styles_and_scripts');

// Append ellipsis and continue reading link to automatic excerpts
function felinedesignco_excerpt( $more ) {
	return ' &hellip; <a href="'.get_permalink().'">Continue reading &ldquo;'.get_the_title().'&rdquo; &rarr;</a>';
}
add_filter('excerpt_more', 'felinedesignco_excerpt');

// Register custom image sizes
add_image_size('hero', 1090, 320, true); // cropped to exactly 1090x320 pixels
add_image_size('narrow', 150, 9999, false); // sized to 150 pixels wide by proportional height (up to 9999 pixels tall)

// Add custom sizes to the WordPress Media Library
function felinedesignco_choose_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'hero' => __('Hero'),
		'narrow' => __('Narrow')
	) );
}
add_filter('image_size_names_choose', 'felinedesignco_choose_sizes');

// Remove inline WordPress gallery styles
add_filter('use_default_gallery_style', '__return_false');

// Add support for featured images
add_theme_support('post-thumbnails');

?>