<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//If this is the parent page, load the first page instead
if ($post->post_parent==0) {

	$pages = get_pages(array('child_of'=>$post->ID));

	$post = $pages[0];
	setup_postdata( $post );

;
}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php if ($post->post_parent) { echo get_the_title($post->post_parent).' - '; } ?><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>

<?php
//Previous and next pages


$pagelist = get_pages(array('child_of'=>$post->post_parent));
//'parent='.$post->post_parent.'&sort_column=menu_order&sort_order=asc');
$pages = array();


foreach ($pagelist as $page) {

   $pages[] += $page->ID;

}


$current = array_search(get_the_ID(), $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];
?>

<div class="navigation">
<?php if (!empty($prevID)) { ?>
<div class="alignleft">
<a href="<?php echo get_permalink($prevID); ?>"
  title="<?php echo get_the_title($prevID); ?>">&lt; <?php echo get_the_title($prevID); ?></a>
</div>
<?php }
if (!empty($nextID)) { ?>
<div class="alignright">
<a href="<?php echo get_permalink($nextID); ?>" 
 title="<?php echo get_the_title($nextID); ?>"><?php echo get_the_title($nextID); ?> &gt;</a>
</div>
<?php } ?>
</div><!-- .navigation -->
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>

		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->