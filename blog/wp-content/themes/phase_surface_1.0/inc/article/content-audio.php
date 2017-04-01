<?php
	$audio_url = get_post_meta($post->ID,'audio_url',true);
	$getValues = wp_remote_fopen('http://soundcloud.com/oembed?format=js&url='.$audio_url.'&iframe=true');
	$sc_id = json_decode(substr($getValues,1,-2));
	$sc_string01 = array('height="400"','&show_artwork=true');
	$sc_string02 = array('height="320"','&show_artwork=true&amp;show_comments=false');
	$sc_iframe = str_replace($sc_string01,$sc_string02,$sc_id->html);

	if($audio_url){
		echo '<div class="media">'.$sc_iframe.'</div>';
	}
?>