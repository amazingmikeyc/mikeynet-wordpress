<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
<?php $pagelist = get_pages(array('child_of'=>$post->post_parent)); 

if (sizeof($pagelist)>1) {
?>

<h2>Other pages:</h2>
<?php
 }
//'parent='.$post->post_parent.'&sort_column=menu_order&sort_order=asc');
$pages = array();



?><ul><?php
foreach ($pagelist as $page) {

   $pages[] += $page->ID;

}
if (count($pages)>1) {
foreach ($pages as $page) {
	?><li><a href="<?php echo get_permalink($page); ?>" 
 title="<?php echo get_the_title($page); ?>"><?php echo get_the_title($page); ?></a></li>
	<?php

}
?></ul>
<?php } ?>
	
			<?php //dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>