<article id="post-<?php the_ID();?>" <?php post_class();?>>
<?php
	$display_article_category = get_theme_mod('display_article_category');
	$category = get_the_category();
	if(has_post_thumbnail()){
		$cover = phase_featured_image_url('index');
	}else{
		$cover = phase_first_image();
	}
	if($cover){
		list($width,$height) = getimagesize($cover);
		if($height > $width){
			$orientation = 'vertical';
		}else{
			$orientation = 'horizontal';
		}
	}else{
		$orientation='vertical text';
	}
	$enlarge_article = get_post_meta($post->ID,'enlarge_article',true);
	if($enlarge_article){
		$enlarge_article = ' enlarge';
	}else{
		$enlarge_article = '';
	}
	echo '<div class="block '.$orientation.$enlarge_article.'" style="background-image:url('.$cover.')">';
		if(!$cover){
			echo '<div class="content"><h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2><small>'.get_the_time('M jS, Y').' &#183; '.__('by','phase_surface').' <a rel="author" href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author().'</a>';
			if($category&&$display_article_category){
				echo ' &#183; '.__('in','phase_surface').' <a href="'.get_category_link($category[0]->term_id).'" title="'.sprintf(__("View all posts in %s",'phase_surface'),$category[0]->name).'"'.'>'.$category[0]->name.'</a>';
			}
			echo '</small><p>'.get_the_excerpt().'</p><a class="more" href="'.get_the_permalink().'">'.__('Continue Reading','phase_surface').' <i class="icon-right-open"></i></a></div>';
		}else{
			if($category&&$display_article_category){
			  echo '<a class="category" href="'.get_category_link($category[0]->term_id).'" title="'.sprintf(__('View all posts in %s'.'phase_surface'),$category[0]->name).'"'.'>'.$category[0]->name.'</a>';
			}
		}
		?>
		<div class="info">
			<h2><?php the_title();?></h2>
			<small><?php the_time('M jS, Y');echo ' &#183; by <a rel="author" href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author().'</a>';?></small>
		</div>
		<a class="overlay" href="<?php the_permalink()?>"></a>
	</div>
</article>