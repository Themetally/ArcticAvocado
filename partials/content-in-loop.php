<?php
/**
 * Template part for displaying results in search pages
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Unstyled
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php unstyled_the_category_list(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<?php the_post_thumbnail( 'unstyled-blog' ) ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-meta">
		<?php unstyled_posted_on(); ?>
	</footer><!-- .entry-footer -->

	<a href="<?php the_permalink() ?>" class="read-more"><?php esc_html_e( 'Read More', 'MELON_TXT' ); ?></a>

</article><!-- #post-<?php the_ID(); ?> -->
