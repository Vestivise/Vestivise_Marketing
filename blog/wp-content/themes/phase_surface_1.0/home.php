<?php 
	get_header();
	$infinite_scrolling = get_theme_mod('infinite_scrolling');
	$homepage_sidebar = get_theme_mod('homepage_sidebar');
	$sidebar_position = get_theme_mod('sidebar_position','sidebar-r');
	$display_popular_articles_home = get_theme_mod('display_popular_articles_home');
	// $category_slug_01 = esc_attr(get_theme_mod('category_slug_01'));
	// $category_slug_02 = esc_attr(get_theme_mod('category_slug_02'));
	// $category_slug_03 = esc_attr(get_theme_mod('category_slug_03'));
	// $category_slug_04 = esc_attr(get_theme_mod('category_slug_04'));
	// $category_slug_05 = esc_attr(get_theme_mod('category_slug_05'));
	// $category_slug_06 = esc_attr(get_theme_mod('category_slug_06'));
?>

<div id="container" class="home">

	<?php 
		$query = new WP_Query(array('category_name'=>'featured','posts_per_page'=>6));
		if($query->have_posts()){
			echo '<div id="featured" class="featured-slide"><section id="featured-slides">';
			while($query->have_posts()):$query->the_post();
			?>
			<li>
				<h2><?php the_title();?></h2>
				<a class="overlay" href="<?php the_permalink()?>"></a>
				<div class="image" style="background-image:url(<?php if(has_post_thumbnail()){$cover = phase_featured_image_url('index');}else{$cover = phase_first_image();}echo $cover;?>)"></div>
			</li>
		<?php 
			endwhile;
			wp_reset_postdata();
			echo '</section></div>';
		}
	?>

	<section id="posts-container" class="<?php if($homepage_sidebar){echo ' sidebar '.$sidebar_position.'"';}else{echo ' no-sidebar';}?>">

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

	<?php
		// $category_slugs = array($category_slug_01,$category_slug_02,$category_slug_03,$category_slug_04,$category_slug_05,$category_slug_06);
		// $category_slugs = array_filter($category_slugs);
		// if(!empty($category_slugs)){
		// 	echo '<div id="category">';
		// 	foreach($category_slugs as $category_slug){
		// 		if(!empty($category_slug)){					
		// 			$category_term = get_term_by('slug',$category_slug,'category');
		// 			$category_id = $category_term->term_id;
		// 			$category_name = get_cat_name($category_id);
		// 			$category_description = category_description($category_id);
		// 			$category_link = get_category_link($category_id);
		// 			$categorypost = new WP_Query('category_name='.$category_name.'&posts_per_page=4');
		// 			if($categorypost->have_posts()){
		// 			echo '<hr class="divider"><section>
		// 				<h2 class="title">More from '.$category_name.'<small><a href="'.$category_link.'">Explore more <i class="icon-right-open"></i></a></small></h2>';
		// 				while($categorypost->have_posts()):$categorypost->the_post();get_template_part('inc/article/article-category');endwhile;
		// 			echo '</section>';
		// 			}
		// 			wp_reset_postdata();
		// 		}
		// 	}
		// 	echo '</div>';
		// }
		if($display_popular_articles_home){
			$popular_weeks_ago = get_theme_mod('popular_weeks_ago',4);
			$popularpost = new WP_Query(array('posts_per_page'=>8,'meta_key'=>'phase_post_views_count','ignore_sticky_posts'=>1,'orderby'=>'meta_value_num','order'=>'DESC','date_query'=>array('after' => $popular_weeks_ago.' week ago')));
			if($popularpost->have_posts()){
			?>
			<div id="popular" class="explore exceed">
				<section>
					<h2 class="title"><?php _e('Popular & Trending Articles','phase_surface');?></h2>
					<?php 
						while($popularpost->have_posts()):
							$popularpost->the_post();
							get_template_part('inc/article/article-explore');
						endwhile;
						wp_reset_postdata();
					?>
				</section>
				<a id="explore-more"><?php _e('Explore More','phase_surface');?></a>
			</div>
			<?php 
			}
		}
	?>
</div>

<?php get_footer();?>