<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&mdash;', true, 'right'); bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body>
		<header>
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" />
			<?php bloginfo('name'); ?>
			<nav>
				<?php wp_nav_menu( array('theme_location' => 'main-nav') ); ?>
			</nav>
		</header>
		<section class="main">
		<div class="container">
			<?php // If we do not have content...
			if ( ! have_posts() ) {
				// ...then show an error message: ?>
				<h1>Not Found</h1>
				<p>Sorry, nothing found.</p>
			<?php // Otherwise, if we do have content...
			} else {
				// ...as long as there is content to show...
				if ( ! is_page() ) { ?>
					<section class="primary">
				<?php }
				while ( have_posts() ) {
					// ...set up each piece of content so we can grab stuff from it:
					the_post();
					if ( is_front_page() ) {
						the_content();
						$latestPost = new WP_Query('posts_per_page=1');
						if ( $latestPost->have_posts() ) {
							// If there is a post to show, add a title before starting the loop: ?>
							<h2>Latest from the blog...</h2>
							<?php while ( $latestPost->have_posts() ) {
								$latestPost->the_post(); ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="metadata">Posted on <?php the_time('F jS Y'); ?> at <?php the_time('g:i A'); ?> in <?php the_terms($post->ID, 'category'); ?></p>
								<?php the_excerpt();
							} // end while
						} // end if
					} elseif ( is_page() ) {
						// If this is a regular page, just display the title and content: ?>
						<h1><?php the_title(); ?></h1>
						<?php the_content();
					} else {
						// Otherwise, display the title and content plus the metadata
						if ( is_single() ) {
							// If you're viewing a single post, display the title as h1: ?>
							<h1><?php the_title(); ?></h1>
						<?php } else {
							// Otherwise, display the title as h2 and link it to the full post: ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php } ?>
						<p class="metadata">Posted on <?php the_time('F jS Y'); ?> at <?php the_time('g:i A'); ?> in <?php the_terms($post->ID, 'category'); ?></p>
						<?php the_content(); ?>
						<p class="navigation">
							<?php next_posts_link('&larr; Older posts');
							previous_posts_link('Newer posts &rarr;'); ?>
						</p>
						<?php comments_template();
					} // end if
				} // end while
			} // end if
			if ( ! is_page() ) { ?>
				</section><!-- .primary --><aside class="secondary">
					<?php dynamic_sidebar('blog-widget-area'); ?>
				</aside><!-- .secondary -->
			<?php } ?>
		</div><!-- .container -->
		</section><!-- .main -->
		<footer>
		    <p>Site by <a href="http://drollic.ca">Linn</a></p>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
