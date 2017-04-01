<?php 
	get_header();
	$category = get_the_category();
	$display_cover = get_theme_mod('display_cover',1);
	$display_vertical_cover = get_theme_mod('display_vertical_cover',0);
	$sidebar_position = get_theme_mod('sidebar_position','sidebar-r');
	$display_progress_bar = get_theme_mod('display_progress_bar');
	$display_related_articles = get_theme_mod('display_related_articles');

	global $post;
	if(has_post_thumbnail()){
		$cover = phase_featured_image_url('cover');
	}else{
		$cover = phase_first_image();
	}
	if($cover){
		list($width,$height) = getimagesize($cover);
		if($width < 600){
			$orientation = 'text';
		}elseif($height > $width){
			$orientation = 'vertical';
		}else{
			$orientation = 'horizontal';
		}
	}else{
		$orientation = 'text';
	}if($orientation == 'vertical'&&$display_vertical_cover == 0){
		$orientation = 'text';
	}
	if($display_progress_bar){
		echo'<div id="progressbar"></div>';
	}
	if($display_cover){
		while(have_posts()):the_post();
			$featured_caption = get_post_thumbnail_caption();
			echo '
			<div id="featured" class="single '.$orientation.'" style="background-image:url('.$cover.')">
				<div class="post-info">
				<h1>'.get_the_title().'</h1>';
				if(!empty($post->post_excerpt)){
					echo '<p>'.the_excerpt().'</p>';
				}else{
					echo '<span>'.__('By','phase_surface').' <a rel="author" href="'.get_author_posts_url($authordata->ID,$authordata->user_nicename).'">'.get_the_author().'</a> / '.__('on','phase_surface').' '.get_the_time('F jS, Y');
					if($category){
						echo' / '.__('in','phase_surface').' '.get_the_category_list('<span>,</span> ','','');
					}
					echo '</span>';
				}
			echo '</div>';
			if($featured_caption){
				echo '<div class="featured-caption">'.$featured_caption.'</div>';
			}
			echo '<div id="gradient"></div><div id="overlay"></div>
			</div>
			</div>';
		endwhile;
	}
?>

<div id="container" class="home single">

	<section id="posts-container" class="sidebar <?php echo $sidebar_position;?>">

		<div id="posts">
			<?php 
				if(have_posts()){
					while(have_posts()):the_post();
						get_template_part('inc/article/article');
						?>
					<div id="meta" class="sidebar">
						<?php get_template_part('inc/article/article-share');?>
					</div>
					<?php 
					endwhile;
				}
				wp_reset_query();
			?>
		</div>

		<?php get_sidebar();?>

	</section>

	<hr class="divider">
	<section id="article-pagination">
		<?php 
			if(get_next_post()){
				$next_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_next_post()->ID));
				echo '<li class="next" style="background-image:url('.$next_featured_image.')"><div class="center"><h2><span>Next article</span><b>'.get_the_title(get_next_post()->ID).'</b></h2><p>'.substr(get_excerpt_by_id(get_next_post()->ID),0,95).'...</p></div><a class="overlay" href="'.get_permalink(get_adjacent_post(false,'',false)).'"></a></li>';
			}
			else{
				echo'<li class="next"><div class="center"><h2><span>Next article</span><b>No articles</b></h2></div></li>';
			}
			if(get_previous_post()){
				$prev_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_previous_post()->ID));
				echo '<li class="prev" style="background-image:url('.$prev_featured_image.')"><div class="center"><h2><span>Previous article</span><b>'.get_the_title(get_previous_post()->ID).'</b></h2><p>'.substr(get_excerpt_by_id(get_previous_post()->ID),0,95).'...</p></div><a class="overlay" href="'.get_permalink(get_adjacent_post(false,'',true)).'"></a></li>';
			}
			else{
				echo'<li class="prev"><div class="center"><h2><span>'. __('Previous article','phase_surface').'</span><b>'. __('No articles','phase_surface').'</b></h2></div></li>';
			}
		?>
	</section>

	<?php 
		$orig_post = $post;
		global $post;
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category);
		$category_ids[] = $individual_category->term_id;
		$args=array('category__in' => $category_ids,'post__not_in' => array($post->ID),'posts_per_page'=>8,'ignore_sticky_posts'=> 1,'orderby'=>'rand');
		$relatedpost = new wp_query($args);
		if($display_related_articles&&$relatedpost->have_posts()){
			echo '<div id="related" class="explore limit"><h2 class="title">'.__('More & Related Articles','phase_surface').'</h2><section>';
			while($relatedpost->have_posts()):$relatedpost->the_post();
				get_template_part('inc/article/article-explore');
			endwhile;
			$post = $orig_post;
			echo '</section></div>';
		}
		wp_reset_query();
	?>
</div>

<?php get_footer();?>