<?php

	/*

		Template Name: Page: Right Sidebar

	*/

	get_header();
	$display_popular_articles_page = get_theme_mod('display_popular_articles_page');
	if(has_post_thumbnail()){
		$cover = phase_featured_image_url('full');
	}else{
		$cover = '';
	}
	if($cover){
		$orientation = 'cover';
	}else{
		$orientation = 'no-cover';
	}

	echo '<div id="featured" class="heading page '.$orientation.'" style="background-image:url('.$cover.')"><h1>'.get_the_title().'</h1><div id="overlay"></div></div>';
?>

<div id="container" class="single page">

	<section id="posts-container" class="sidebar sidebar-l">

		<div id="posts">
			<article class="entry">
				<?php 
					if(have_posts()){
						while(have_posts()):the_post();
							the_content();
						endwhile;
					}
				?>
			</article>
		</div>

		<?php get_sidebar();?>

	</section>

</div>

<?php 
    $query = new WP_Query(array('posts_per_page'=>8,'ignore_sticky_posts'=>1,'order'=>'DESC'));
    if($display_popular_articles_page&&$query->have_posts()){
    ?>
        <div id="popular" class="explore exceed">
            <section>
                <h2 class="title"><?php _e('Latest Articles','phase_surface');?></h2>
                <?php 
                    while($query->have_posts()):$query->the_post();
                        get_template_part('inc/article/article-explore');
                    endwhile;
                    wp_reset_postdata();
                ?>
            </section>
            <a id="explore-more"><?php _e('Explore More','phase_surface');?></a>
        </div>
    <?php 
    }
    get_footer();
?>