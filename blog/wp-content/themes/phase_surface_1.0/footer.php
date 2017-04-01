<?php
	$footer_credit = wp_kses_post(get_theme_mod('footer_credit'));
	$email_address = is_email(get_theme_mod('footer_email_address'));
	$behance_url = esc_url(get_theme_mod('footer_behance_url'));
	$dribbble_url = esc_url(get_theme_mod('footer_dribbble_url'));
	$facebook_url = esc_url(get_theme_mod('footer_facebook_url'));
	$flickr_url = esc_url(get_theme_mod('footer_flickr_url'));
	$github_url = esc_url(get_theme_mod('footer_github_url'));
	$googleplus_url = esc_url(get_theme_mod('footer_googleplus_url'));
	$instagram_url = esc_url(get_theme_mod('footer_instagram_url'));
	$linkedin_url = esc_url(get_theme_mod('footer_linkedin_url'));
	$pinterest_url = esc_url(get_theme_mod('footer_pinterest_url'));
	$skype_url = sanitize_text_field(get_theme_mod('footer_skype_url'));
	$spotify_url = esc_url(get_theme_mod('footer_spotify_url'));
	$tumblr_url = esc_url(get_theme_mod('footer_tumblr_url'));
	$twitter_url = esc_url(get_theme_mod('footer_twitter_url'));
	$vimeo_url = esc_url(get_theme_mod('footer_vimeo_url'));
	$youtube_url = esc_url(get_theme_mod('footer_youtube_url'));
	$rss_url = get_theme_mod('footer_rss_url');
?>

<footer id="footer">

	<?php 
		if(is_active_sidebar('footer')){
			echo '<section id="widgets">';
				dynamic_sidebar('footer');
			echo '</section><hr class="divider">';
		}
	?>

	<section id="connect">
		<?php 
			if(!$email_address==''||!$behance_url==''||!$dribbble_url==''||!$facebook_url==''||!$flickr_url==''||!$github_url==''||!$googleplus_url==''||!$instagram_url==''||!$linkedin_url==''||!$pinterest_url==''||!$skype_url==''||!$spotify_url==''||!$tumblr_url==''||!$twitter_url==''||!$vimeo_url==''||!$youtube_url==''||!$rss_url==''){
				echo '<nav id="social">';
					if(!$email_address==''){echo '<li><a href="mailto:'.$email_address.'" target="_blank"><i class="icon-mail"></i></a></li>';}if(!$behance_url==''){echo '<li><a href="'.$behance_url.'" target="_blank"><i class="icon-behance"></i></a></li>';}if(!$dribbble_url==''){echo '<li><a href="'.$dribbble_url.'" target="_blank"><i class="icon-dribbble"></i></a></li>';}if(!$facebook_url==''){echo '<li><a href="'.$facebook_url.'" target="_blank"><i class="icon-facebook"></i></a></li>';}if(!$flickr_url==''){echo '<li><a href="'.$flickr_url.'" target="_blank"><i class="icon-flickr"></i></a></li>';}if(!$github_url==''){echo '<li><a href="'.$github_url.'" target="_blank"><i class="icon-github"></i></a></li>';}if(!$googleplus_url==''){echo '<li><a href="'.$googleplus_url.'" target="_blank"><i class="icon-gplus"></i></a></li>';}if(!$instagram_url==''){echo '<li><a href="'.$instagram_url.'" target="_blank"><i class="icon-instagramm"></i></a></li>';}if(!$linkedin_url==''){echo '<li><a href="'.$linkedin_url.'" target="_blank"><i class="icon-linkedin"></i></a></li>';}if(!$pinterest_url==''){echo '<li><a href="'.$pinterest_url.'" target="_blank"><i class="icon-pinterest"></i></a></li>';}if(!$skype_url==''){echo '<li><a href="skype:'.$skype_url.'?chat" target="_blank"><i class="icon-skype"></i></a></li>';}if(!$spotify_url==''){echo '<li><a href="'.$spotify_url.'" target="_blank"><i class="icon-spotify"></i></a></li>';}if(!$tumblr_url==''){echo '<li><a href="'.$tumblr_url.'" target="_blank"><i class="icon-tumblr"></i></a></li>';}if(!$twitter_url==''){echo '<li><a href="'.$twitter_url.'" target="_blank"><i class="icon-twitter"></i></a></li>';}if(!$vimeo_url==''){echo '<li><a href="'.$vimeo_url.'" target="_blank"><i class="icon-vimeo"></i></a></li>';}if(!$youtube_url==''){echo '<li><a href="'.$youtube_url.'" target="_blank"><i class="icon-youtube"></i></a></li>';}if($rss_url){echo '<li><a href="'.get_bloginfo('rss2_url').'"><i class="icon-rss"></i></a></li>';}
				echo '</nav>';
			}
		?>
		<div id="credit">
			<?php 
				if($footer_credit==''){
					echo '&copy; '.date('Y ');
					bloginfo('name');
					echo '  ';
				}else{
					echo $footer_credit.' - ';
				}
			?>
		</div>
	</section>

</footer>

<?php wp_footer();?>

</body>
</html>