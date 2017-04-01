<?php 
	get_header();
	$infinite_scrolling = get_theme_mod('infinite_scrolling');
	$homepage_sidebar = get_theme_mod('homepage_sidebar');
	$sidebar_position = get_theme_mod('sidebar_position','sidebar-r');
?>

<div id="container">

	<?php if(!have_posts()){
		echo '<div id="featured" class="heading not-found"><h1>No Articles found</h1><p><a href="'.home_url().'">'.__('Return home','phase_surface').'</a> <i>&nbsp;&nbsp;or&nbsp;&nbsp;</i> <a class="scroll-post">'.__('Read more','phase_surface').'</a></p></div>';
		}
	?>

	<section id="posts-container" class="grid <?php if($homepage_sidebar){echo ' sidebar '.$sidebar_position.'"';}else{echo ' no-sidebar';}?>">

		<div id="posts">
			<div id="grid" class="grid">
				<?php 
					while(have_posts()):the_post();
						get_template_part('inc/article/article');
					endwhile;
				?>
			</div>
			<?php 
				$prev_link = get_previous_posts_link(__('&laquo; Older Entries','phase_surface'));
				$next_link = get_next_posts_link(__('Newer Entries &raquo;','phase_surface'));if($prev_link||$next_link){?>
				<nav id="pagination">
					<?php if($infinite_scrolling){?>
						<a id="load">
							<span id="more"><?php _e('Load more','phase_surface');?></span>
							<span id="loading">
								<div class="rect1"></div>
								<div class="rect2"></div>
								<div class="rect3"></div>
								<div class="rect4"></div>
							</span>
							<span id="done"><?php _e('No more articles to load','phase_surface');?></span>
						</a>
						<div id="infinite-next">
							<?php next_posts_link('','');?>
						</div>
					<?php }else{?>
						<a class="prev"><i class="icon-left-open"></i></a>
						<a class="next"><i class="icon-right-open"></i></a>
						<?php number_pagination();?>
					<?php }?>
				</nav>
			<?php }?>
		</div>

		<?php 
			if($homepage_sidebar){
				get_sidebar();
			}
		?>

	</section>

</div>

<?php get_footer();?>