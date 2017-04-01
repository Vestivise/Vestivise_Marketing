<?php
/*  Frameworks  */

	$tempdir = get_template_directory();
	require_once($tempdir.'/inc/functions/list.php');
	require_once($tempdir.'/inc/functions/metaboxes.php');
	require_once($tempdir.'/inc/functions/customize.php');
	require_once($tempdir.'/inc/functions/archive.php');

	load_theme_textdomain('phase_surface',$tempdir.'/languages');

/*  End Frameworks  */

/*  Add Theme Features */

	function phase_theme_setup(){
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
		add_theme_support('post-formats',array('gallery','audio','video'));
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_image_size('index',600,920,false);
		add_image_size('cover',2000,1600,false);
	}

	add_action('after_setup_theme','phase_theme_setup');

	function add_to_author_profile($contactmethods){
		$contactmethods['author_behance'] = 'Behance Profile URL';
		$contactmethods['author_dribbble'] = 'Dribbble Profile URL';
		$contactmethods['author_facebook'] = 'Facebook Profile URL';
		$contactmethods['author_flickr'] = 'Flickr Profile URL';
		$contactmethods['author_github'] = 'Github Profile URL';
		$contactmethods['author_googleplus'] = 'Google+ Profile URL';
		$contactmethods['author_instagram'] = 'Instagram Profile URL';
		$contactmethods['author_linkedin'] = 'Linkedin Profile URL';
		$contactmethods['author_pinterest'] = 'Pinterest Profile URL';
		$contactmethods['author_skype'] = 'Skype Profile URL';
		$contactmethods['author_spotify'] = 'Spotify Profile URL';
		$contactmethods['author_tumblr'] = 'Tumblr Profile URL';
		$contactmethods['author_twitter'] = 'Twitter Profile URL';
		$contactmethods['author_vimeo'] = 'Vimeo Profile URL';
		$contactmethods['author_youtube'] = 'Youtube Profile URL';
		return $contactmethods;
	}

	add_filter('user_contactmethods','add_to_author_profile',10,1);

	function phase_set_post_views($postID){
		$count_key = 'phase_post_views_count';
	    $count = get_post_meta($postID,$count_key,true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID,$count_key);
	        add_post_meta($postID,$count_key,'0');
	    }else{
	        $count++;
	        update_post_meta($postID,$count_key,$count);
	    }
	}
	remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);

	function phase_track_post_views($post_id){
	    if(!is_single()){
	    	return;
	    }
	    if(empty($post_id)){
	        global $post;
	        $post_id = $post->ID;    
	    }
	    phase_set_post_views($post_id);
	}
	add_action('wp_head','phase_track_post_views');

	function phase_get_post_views($postID){
	    $count_key = 'phase_post_views_count';
	    $count = get_post_meta($postID,$count_key,true);
	    if($count==''){
	        delete_post_meta($postID,$count_key);
	        add_post_meta($postID,$count_key,'0');
	        return '0';
	    }
	    return $count;
	}

	function get_excerpt_by_id($post_id){
		$the_post = get_post($post_id);
		$the_excerpt = strip_tags($the_post->post_content);
		return $the_excerpt;
	}

/*  End Add Theme Features */

/*  Theme Adjustments  */

	if(!isset($content_width)){
		$content_width = 690;
	}

	function phase_excerpt_length($length){return 28;}add_filter('excerpt_length','phase_excerpt_length',999);

	function phase_excerpt_more($more){return '...';}add_filter('excerpt_more','phase_excerpt_more');

	function next_l_a(){return'class="exist next"';}
	function prev_l_a(){return'class="exist prev"';}

	add_filter('next_posts_link_attributes','next_l_a');
	add_filter('previous_posts_link_attributes','prev_l_a');
	 
	function next_p_a($output){$code = 'class="exist"';return str_replace('<a href=', '<a '.$code.' href=', $output);}
	function prev_p_a($output){$code = 'class="exist"';return str_replace('<a href=', '<a '.$code.' href=', $output);}

	add_filter('next_post_link','next_p_a');
	add_filter('previous_post_link','prev_p_a');

	if(!function_exists('number_pagination')){
		function number_pagination(){
			$prev_arrow = is_rtl() ? '<i class="icon-right-open"></i>' : '<i class="icon-left-open"></i>';
			$next_arrow = is_rtl() ? '<i class="icon-left-open"></i>' : '<i class="icon-right-open"></i>';
			global $wp_query;
			$total = $wp_query->max_num_pages;
			$big = 999999999;
			if($total > 1){
				if(!$current_page = get_query_var('paged'))
					$current_page = 1;
					if(get_option('permalink_structure')){
					 $format = 'page/%#%/';
				 	}else{
					$format = '&paged=%#%';
				}
				echo paginate_links(array(
					'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'		=> $format,
					'current'		=> max( 1, get_query_var('paged') ),
					'total' 		=> $total,
					'end_size'		=> 0,
					'mid_size'		=> 2,
					'type' 			=> 'plain',
					'prev_text'		=> $prev_arrow,
					'next_text'		=> $next_arrow,
				 ) );
			}
		}
	}

	function phase_comments($comment,$args,$depth){
		$GLOBALS['comment'] = $comment;
		switch($comment->comment_type){
		case 'pingback':
		case 'trackback': ?>
		<li <?php comment_class();?> id="comment<?php comment_ID();?>">
			<?php break;default:?>
			<li <?php comment_class();?> id="comment-<?php comment_ID();?>">
			<div <?php comment_class();?> class="comment">
				<?php echo get_avatar($comment,100);?>
				<div class="comment-context">
					<div class="comment-info">
						<span class="author-name">
							<?php comment_author_link();?>
						</span>
						<time <?php comment_time( 'c' ); ?> class="comment-time"> &#183; <?php comment_date();?> at <?php comment_time();?></time>
						<?php comment_reply_link(array_merge($args,array( 
							'reply_text' => ' &#183; Reply',
							'depth' => $depth,
							'max_depth' => $args['max_depth'] 
						)));?>
					</div>
				 <?php comment_text() ?>
				</div>
			</div>
		<?php break;}
	}

	function phase_social_meta(){
		global $post;
		if(!is_singular()){
			$meta_description = substr(esc_attr(get_bloginfo('description')),0,155);
			echo '
			<meta name="description" content="'.$meta_description.'">
        	';
		}else{
			$meta_description = substr(esc_attr(get_excerpt_by_id($post->ID)),0,155);
			if(has_post_thumbnail()){
				$meta_image = esc_url_raw(phase_featured_image_url('full'));
			}else{
				$meta_image = esc_url_raw(phase_first_image());
			}
			echo '
			<meta name="description" content="'.$meta_description.'">
			<meta name="twitter:card" value="summary">
			<meta name="twitter:title" content="'.get_the_title().'">
			<meta name="twitter:description" content="'.$meta_description.'">
			<meta name="twitter:image" content="'.$meta_image.'">
        	<meta property="og:title" content="'.get_the_title().'"/>
        	<meta property="og:type" content="article"/>
        	<meta property="og:url" content="'.get_permalink().'"/>
        	<meta property="og:site_name" content="'.get_bloginfo('name').'"/>
        	<meta property="og:description" content="'.$meta_description.'"/>
        	<meta property="og:image" content="'.$meta_image.'"/>
        	';
        }
	}
	add_action('wp_head','phase_social_meta',5);

/*  End Theme Adjustments  */

/*  Post Functions  */

	function phase_first_image(){
		global $post,$posts;
		$phase_first_image = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
		if($output){
			$phase_first_image = $matches [1] [0];
		}
		return $phase_first_image;
	}

	function phase_featured_image_url($phase_featured_img_size){
		$phase_image_id = get_post_thumbnail_id();
		$phase_image_url = wp_get_attachment_image_src($phase_image_id,$phase_featured_img_size);
		$phase_image_url = $phase_image_url[0];
		return $phase_image_url;
	}

	function get_post_thumbnail_caption(){
		if($thumb = get_post_thumbnail_id()){
			return get_post($thumb)->post_excerpt;
		}
	}

/*  End Post Functions  */

/*  Register Built-in Features  */

	function register_theme_menus(){

		register_nav_menus(
			array(
				'primary'=>__('Primary Menu'),
				'submenu'=>__('Submenu'),
				)
			);

		}

	add_action('init','register_theme_menus');

	function register_widgets(){
		register_sidebar(
			array(
				'name' => __('Footer','phase'),	 
				'id' => 'footer',
				'description' => __('Displays on the footer of your site.','phase'),
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h2>',
				'after_title' => '</h2>'
			)
		);
		register_sidebar(
			array(
				'name' => __('Sidebar Homepage','phase'),	 
				'id' => 'sidebar-home',
				'description' => __('idgets that displays on the homepage of your sidebar.','phase'),
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h2>',
				'after_title' => '</h2>'
			)
		);
		register_sidebar(
			array(
				'name' => __('Sidebar Single','phase'),	 
				'id' => 'sidebar-single',
				'description' => __('Widgets that displays in single pages of your sidebar.','phase'),
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h2>',
				'after_title' => '</h2>'
			)
		);
	}

	add_action('widgets_init','register_widgets');

/*  End Register Built-in Features  */

/*  Register External Scripts  */

	function phase_theme_styles(){
		wp_enqueue_style('normalize_css',get_template_directory_uri().'/inc/css/normalize.css');
		wp_enqueue_style('icon_css',get_template_directory_uri().'/inc/css/phase-embedded.css');
		wp_enqueue_style('main_css',get_template_directory_uri().'/style.css');
		}

	add_action('wp_enqueue_scripts','phase_theme_styles');

	function phase_theme_js(){
	    wp_enqueue_script('library',get_template_directory_uri().'/inc/js/library.js',array('jquery'),true);
    	wp_enqueue_script('main_js',get_template_directory_uri().'/inc/js/scripts.js',array('jquery'),'',true);
		}

	add_action('wp_enqueue_scripts','phase_theme_js');

/*  End Register External Scripts  */
?>