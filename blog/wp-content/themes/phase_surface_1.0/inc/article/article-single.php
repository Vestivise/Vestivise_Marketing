<?php
	$viewcount = phase_get_post_views($post->ID);

	$category = get_the_category();
	$display_cover = get_theme_mod('display_cover');
	$stylized_first_paragraph = get_theme_mod('stylized_first_paragraph');if($stylized_first_paragraph){$stylized_first_paragraph = 'style_paragraph';}
	$stylized_first_letter = get_theme_mod('stylized_first_letter');if($stylized_first_letter){$stylized_first_letter = 'style_letter';}
	$display_categories_and_tags = get_theme_mod('display_categories_and_tags');
	$display_article_view_counts = get_theme_mod('display_article_view_counts');
	$classes = array('entry',$stylized_first_paragraph,$stylized_first_letter);

	if(has_post_thumbnail()){
		$cover = phase_featured_image_url('full');
	}else{
		$cover = phase_first_image();
	}

	echo get_template_part('inc/article/content',get_post_format());
?>

<article id="post-<?php the_ID();?>" <?php post_class($classes);?>>
<?php 
	if(!$display_cover){
		echo '<header><h1>'.get_the_title().'</h1><span>By <a rel="author" href="'.get_author_posts_url($authordata->ID,$authordata->user_nicename).'">'.get_the_author().'</a> / on '.get_the_time('F jS, Y');if($category){echo' / in <a href="'.get_the_category_list('<span>,</span> ','','');}echo '</span></header>';
	}

	the_content();

	if(!empty($post->post_excerpt)||(has_category()||has_tag())&&$display_categories_and_tags||$display_article_view_counts){
		echo '<div id="post-info">';
		if(!empty($post->post_excerpt)){
			echo '<b>By </b><a class="author" style="font-weight:700" href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author().'</a><b> on '.get_the_time('F jS, Y');
			echo '</b>&nbsp;&nbsp;<span>/</span>&nbsp;&nbsp;';
		}
		if((has_category()||has_tag())&&$display_categories_and_tags){
			if(has_category()){
				echo'<b>Categories: </b>'.get_the_category_list('<span>,</span> ','','');
				if(has_tag()){
					echo '&nbsp;&nbsp;<span>/</span>&nbsp;&nbsp;';
				}
			}
			echo get_the_tag_list('<b>Tags:</b> ','<span>,</span> ','');
			if($display_article_view_counts){
				echo '&nbsp;&nbsp;<span>/</span>&nbsp;&nbsp;';
			}
		}
		if($display_article_view_counts){
			echo '<b>Views:</b><span> '.$viewcount.'</span>';
		}
		echo '</div>';
	}
	echo '<div id="meta" class="article">';
	get_template_part('inc/article/article-share');
	echo '</div>';
	comments_template();
?>
</article>