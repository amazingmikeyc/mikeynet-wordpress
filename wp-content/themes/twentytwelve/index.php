<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<style>
	#blocks {
		float:left;
		left:440px;
		top:200px;
		
	}

	.main-page {
		display:inline-block;
		width:200px;
		padding:20px;
		
	}
</style>

	<div id="primary" class="site-content" style="width:100%">
		<div id="content" role="main">
				
			<div id="blocks">	

<!--			-->

		<ul>
		<?php 
			
			$pages = get_pages(['parent'=>0, 'sort_column'=>'post_modified', 'sort_order'=>'desc', 'number'=>20 
				]);
			foreach ($pages as $page) {
				?><li class="main-page"><img style='display:inline; float:left' src='<?=$page->post_icon;?>' /><a href='<?=get_page_link( $page->ID ); ?>'><?=$page->post_title; ?></a> <br />
					<?=$page->post_excerpt;?>
				</li><?php 
			}

		?>
		</ul>

		</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>