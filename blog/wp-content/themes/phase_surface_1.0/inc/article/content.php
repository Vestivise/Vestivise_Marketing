<?php 
	$display_cover = get_theme_mod('display_cover',1);

	if(!$display_cover){
		if(has_post_thumbnail()){
			$cover = phase_featured_image_url('full');
		}else{
			$cover = first_image();
		}if(!$cover == ''){
			list($width,$height) = getimagesize($cover);
			if($height > $width){
				$orientation = 'vertical';
			}else{
				$orientation = 'horizontal';
			}
		}else{
			$orientation='vertical text';
		}
		echo '<div class="media"><img src="'.$cover.'" class="cover"></div>';
	}
?>