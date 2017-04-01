<?php 
	get_header();
	$infinite_scrolling = get_theme_mod('infinite_scrolling');
	$homepage_sidebar = get_theme_mod('homepage_sidebar');
	$sidebar_position = get_theme_mod('sidebar_position');
?>

<div id="container">

	<div id="featured" class="heading cover not-found">
		<h1><?php _e('Sorry, this page does not exist','phase_surface');?></h1>
		<p><a href="<?php echo esc_url(home_url());?>"><?php _e('Return home','phase_surface');?></a> <i>&nbsp;&nbsp;<?php _e('or','phase_surface');?>&nbsp;&nbsp;</i> <a class="scroll-post"><?php _e('Read more','phase_surface');?></a></p>
		<div id="overlay"></div>
	</div>

	<section id="posts-container" class="grid <?php if($homepage_sidebar){echo ' sidebar '.$sidebar_position.'"';}else{echo ' no-sidebar';}?>">

		<div id="posts">
			<div id="grid" class="grid">
				<?php 
					while(have_posts()):the_post();
						get_template_part('inc/article/article');
					endwhile;
				?>
			</div>
		</div>

		<?php 
			if($homepage_sidebar){
				get_sidebar();
			}
		?>

	</section>

</div>

<?php get_footer();?>