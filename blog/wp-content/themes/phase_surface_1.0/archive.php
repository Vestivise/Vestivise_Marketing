<?php 

	get_header();
	$infinite_scrolling = get_theme_mod('infinite_scrolling');
	$homepage_sidebar = get_theme_mod('homepage_sidebar');
	$sidebar_position = get_theme_mod('sidebar_position');

	if(function_exists('phase_taxonomy_image_url')){
		$cover = phase_taxonomy_image_url();
	}

	if($cover){
		$orientation = 'cover';
	}else{
		$orientation = 'no-cover';
	}

?>

<div id="featured" class="heading <?php echo $orientation.'" style="background-image:url('.$cover.')';?>">
	<?php 
		if(is_author()){
			$author_website = esc_url(get_the_author_meta('user_url'));
			$author_behance = esc_url(get_the_author_meta('author_behance'));
			$author_dribbble = esc_url(get_the_author_meta('author_dribbble'));
			$author_facebook = esc_url(get_the_author_meta('author_facebook'));
			$author_flickr = esc_url(get_the_author_meta('author_flickr'));
			$author_github = esc_url(get_the_author_meta('author_github'));
			$author_googleplus = esc_url(get_the_author_meta('author_googleplus'));
			$author_instagram = esc_url(get_the_author_meta('author_instagram'));
			$author_linkedin = esc_url(get_the_author_meta('author_linkedin'));
			$author_pinterest = esc_url(get_the_author_meta('author_pinterest'));
			$author_skype = esc_url(get_the_author_meta('author_skype'));
			$author_spotify = esc_url(get_the_author_meta('author_spotify'));
			$author_tumblr = esc_url(get_the_author_meta('author_tumblr'));
			$author_twitter = esc_url(get_the_author_meta('author_twitter'));
			$author_vimeo = esc_url(get_the_author_meta('author_vimeo'));
			$author_youtube = esc_url(get_the_author_meta('author_youtube'));

			echo get_avatar(get_the_author_meta("email"),120);
			echo '<h1>'.get_the_author().'</h1>';

			if(!get_the_author_meta('description')==''){
				echo '<p>'.get_the_author_meta('description').'</p>';
			}

			if($author_website||$author_youtube||$author_dribbble||$author_facebook||$author_flickr||$author_github||$author_googleplus||$author_instagram||$author_linkedin||$author_pinterest||$author_skype||$author_spotify||$author_tumblr||$author_twitter||$author_vimeo||$author_youtube){
				echo '<div id="author-social">';
				if($author_website){echo '<a href="'.$author_website.'" target="_blank"><i class="icon-globe"></i></a>';}if($author_behance){echo '<a href="'.$author_behance.'" target="_blank"><i class="icon-behance"></i></a>';}if($author_dribbble){echo '<a href="'.$author_dribbble.'" target="_blank"><i class="icon-dribbble"></i></a>';}if($author_facebook){echo '<a href="'.$author_facebook.'" target="_blank"><i class="icon-facebook"></i></a>';}if($author_flickr){echo '<a href="'.$author_flickr.'" target="_blank"><i class="icon-flickr"></i></a>';}if($author_github){echo '<a href="'.$author_github.'" target="_blank"><i class="icon-github"></i></a>';}if($author_googleplus){echo '<a href="'.$author_googleplus.'" target="_blank"><i class="icon-gplus"></i></a>';}if($author_instagram){echo '<a href="'.$author_instagram.'" target="_blank"><i class="icon-instagramm"></i></a>';}if($author_linkedin){echo '<a href="'.$author_linkedin.'" target="_blank"><i class="icon-linkedin"></i></a>';}if($author_pinterest){echo '<a href="'.$author_pinterest.'" target="_blank"><i class="icon-pinterest"></i></a>';}if($author_skype){echo '<a href="skype:'.$author_skype.'?chat" target="_blank"><i class="icon-skype"></i></a>';}if($author_spotify){echo '<a href="'.$author_spotify.'" target="_blank"><i class="icon-spotify"></i></a>';}if($author_tumblr){echo '<a href="'.$author_tumblr.'" target="_blank"><i class="icon-tumblr"></i></a>';}if($author_twitter){echo '<a href="'.$author_twitter.'" target="_blank"><i class="icon-twitter"></i></a>';}if($author_vimeo){echo '<a href="'.$author_vimeo.'" target="_blank"><i class="icon-vimeo"></i></a>';}if($author_youtube){echo '<a href="'.$author_youtube.'" target="_blank"><i class="icon-youtube"></i></a>';}
				echo '</div>';
			}
		}else if(is_category()){
			echo'<h1>Articles categorized in <u>'.single_cat_title('',false).'</u></h1>';
			if(!category_description()==''){
				echo '<p>'.category_description().'</p>';
			}
		}else if(is_tag()){
			echo'<h1>Articles tagged with <u>'.single_tag_title('',false).'</u></h1>';
			if(!tag_description()==''){
				echo '<p>'.tag_description().'</p>';
			}
		}
		else{
			echo'<h1>Articles on <u>'.str_replace(' ', '',wp_title('',false)).'</u></h1>';
		}
	?>
	<div id="overlay"></div>
</div>

<div id="container" class="masonry">

	<section id="posts-container" class="grid <?php if($homepage_sidebar){echo ' sidebar '.$sidebar_position.'"';}else{echo ' no-sidebar';}?>">

		<div id="posts">
			<div id="grid" class="grid">
				<?php 
					if(have_posts()){
						while(have_posts()):the_post();
							get_template_part('inc/article/article-index');
						endwhile;
					}
				?>
			</div>
			<?php 
				$prev_link = get_previous_posts_link(__('&laquo; Older Entries','phase_surface'));
				$next_link = get_next_posts_link(__('Newer Entries &raquo;','phase_surface'));
				if($prev_link||$next_link){?>
					<nav id="pagination">
						<?php if($infinite_scrolling){?>
							<a id="load">
								<span id="more">Load more</span>
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