<!doctype html>
<html <?php language_attributes();?>>
<head <?php do_action( 'add_head_attributes' ); ?>>
<meta charset="<?php bloginfo('charset');?>"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>

<?php 
	if(!function_exists('_wp_render_title_tag')){
		function theme_slug_render_title(){
	?>
	
	<title><?php wp_title('|',true,'right');?></title>

	<?php	
		}
		add_action('wp_head','theme_slug_render_title');
	}

	wp_head();
	$header_logo = esc_url(get_theme_mod('header_logo'));
	$favicon_upload = esc_url(get_theme_mod('favicon_upload'));
	$sticked_header = get_theme_mod('sticked_header','sticked_header');
	if($sticked_header){
		$sticked_header = 'sticked_header';
	}
	$email_address = is_email(get_theme_mod('header_email_address'));
	$behance_url = esc_url(get_theme_mod('header_behance_url'));
	$dribbble_url = esc_url(get_theme_mod('header_dribbble_url'));
	$facebook_url = esc_url(get_theme_mod('header_facebook_url'));
	$flickr_url = esc_url(get_theme_mod('header_flickr_url'));
	$github_url = esc_url(get_theme_mod('header_github_url'));
	$googleplus_url = esc_url(get_theme_mod('header_googleplus_url'));
	$instagram_url = esc_url(get_theme_mod('header_instagram_url'));
	$linkedin_url = esc_url(get_theme_mod('header_linkedin_url'));
	$pinterest_url = esc_url(get_theme_mod('header_pinterest_url'));
	$skype_url = sanitize_text_field(get_theme_mod('header_skype_url'));
	$spotify_url = esc_url(get_theme_mod('header_spotify_url'));
	$tumblr_url = esc_url(get_theme_mod('header_tumblr_url'));
	$twitter_url = esc_url(get_theme_mod('header_twitter_url'));
	$vimeo_url = esc_url(get_theme_mod('header_vimeo_url'));
	$youtube_url = esc_url(get_theme_mod('header_youtube_url'));
	$rss_url = get_theme_mod('header_rss_url');
	$search_icon = get_theme_mod('search_icon');
	$animated_loading = get_theme_mod('animated_loading');
	if($animated_loading){
		if(is_home()){
			$animated_loading = 'animated_loading animated_header';
		}else{
			$animated_loading = 'animated_loading';
		}
	}
	$display_to_top_button = get_theme_mod('display_to_top_button',1);
	$content_layout = get_theme_mod('content_layout');
	$body_classes = array($animated_loading,$content_layout,$sticked_header);
?>

<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
<link rel="shortcut icon" type="image/png" sizes="180x180" href="<?php if($favicon_upload){echo $favicon_upload;}else{echo get_template_directory_uri().'/inc/favicon.png';}?>">

</head>

<body <?php body_class($body_classes);?>>

<header id="header" class="original">
<section>

	<?php
        if($header_logo){
			echo '<a id="logo" href="'.esc_url(home_url()).'"><img src="'.$header_logo.'" alt="'.get_bloginfo('name').'"></a>';
		}else{
			echo '<h1><a href="'.esc_url(home_url()).'">'.get_bloginfo('name').'</a></h1>';
		}

        if(!$email_address==''||!$behance_url==''||!$dribbble_url==''||!$facebook_url==''||!$flickr_url==''||!$github_url==''||!$googleplus_url==''||!$instagram_url==''||!$linkedin_url==''||!$pinterest_url==''||!$skype_url==''||!$spotify_url==''||!$tumblr_url==''||!$twitter_url==''||!$vimeo_url==''||!$youtube_url==''||!$rss_url==''||!$search_icon==''){
        	echo '<nav id="social">';if(!$email_address==''){
        	echo '<li><a href="mailto:'.$email_address.'" target="_blank"><i class="icon-mail"></i></a></li>';}if(!$behance_url==''){echo '<li><a href="'.$behance_url.'" target="_blank"><i class="icon-behance"></i></a></li>';}if(!$dribbble_url==''){echo '<li><a href="'.$dribbble_url.'" target="_blank"><i class="icon-dribbble"></i></a></li>';}if(!$facebook_url==''){echo '<li><a href="'.$facebook_url.'" target="_blank"><i class="icon-facebook"></i></a></li>';}if(!$flickr_url==''){echo '<li><a href="'.$flickr_url.'" target="_blank"><i class="icon-flickr"></i></a></li>';}if(!$github_url==''){echo '<li><a href="'.$github_url.'" target="_blank"><i class="icon-github"></i></a></li>';}if(!$googleplus_url==''){echo '<li><a href="'.$googleplus_url.'" target="_blank"><i class="icon-gplus"></i></a></li>';}if(!$instagram_url==''){echo '<li><a href="'.$instagram_url.'" target="_blank"><i class="icon-instagramm"></i></a></li>';}if(!$linkedin_url==''){echo '<li><a href="'.$linkedin_url.'" target="_blank"><i class="icon-linkedin"></i></a></li>';}if(!$pinterest_url==''){echo '<li><a href="'.$pinterest_url.'" target="_blank"><i class="icon-pinterest"></i></a></li>';}if(!$skype_url==''){echo '<li><a href="skype:'.$skype_url.'?chat" target="_blank"><i class="icon-skype"></i></a></li>';}if(!$spotify_url==''){echo '<li><a href="'.$spotify_url.'" target="_blank"><i class="icon-spotify"></i></a></li>';}if(!$tumblr_url==''){echo '<li><a href="'.$tumblr_url.'" target="_blank"><i class="icon-tumblr"></i></a></li>';}if(!$twitter_url==''){echo '<li><a href="'.$twitter_url.'" target="_blank"><i class="icon-twitter"></i></a></li>';}if(!$vimeo_url==''){echo '<li><a href="'.$vimeo_url.'" target="_blank"><i class="icon-vimeo"></i></a></li>';}if(!$youtube_url==''){echo '<li><a href="'.$youtube_url.'" target="_blank"><i class="icon-youtube"></i></a></li>';}if($rss_url){echo '<li><a href="'.get_bloginfo('rss2_url').'"><i class="icon-rss"></i></a></li>';}if(!$search_icon==''){echo '<li class="click-search"><a><i class="icon-search"></i><i class="icon-cancel"></i></a></li>'.get_search_form();}
    	    echo '</nav>';
    	}

		if(has_nav_menu('primary')){
			$defaults = array(
				'theme_location'=>'primary',
				'container'=>'nav',
				'container_id'=>'navigation',
				'container_class'=>false,
				'menu'=>'',
				'menu_id'=>'menu',
				'menu_class'=>false,
			);
			wp_nav_menu($defaults);
		}
	?>

	<a id="click-menu">
		<i class="icon-menu"></i>
		<i class="icon-cancel"></i>
	</a>

</section>
</header>

<?php
    if(has_nav_menu('submenu')){
    	echo '<div id="submenu" class="original"><section>';
        if($header_logo){
			echo '<a id="logo" href="'.esc_url(home_url()).'"><img src="'.$header_logo.'" alt="'.get_bloginfo('name').'"></a>';
		}else{
			echo '<h1><a href="'.esc_url(home_url()).'">'.get_bloginfo('name').'</a></h1>';
		}
        $defaults = array(
            'theme_location'=>'submenu',
            'container'=>'nav',
            'container_id'=>'',
            'container_class'=>'menu',
            'menu'=>'',
            'menu_id'=>'menu-sub-menu',
            'menu_class'=>'menu',
            'depth' => 1
        );
    	wp_nav_menu($defaults);
    	if(!$search_icon==''){
            echo '<li class="click-search"><a><i class="icon-search"></i><i class="icon-cancel"></i></a></li>'.get_search_form();
        }
    	echo '</section></div>';
    }
    if($display_to_top_button){
        echo '<a id="scroll-top"><i class="icon-up-open"></i></a>';
    }
?>