<?php
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

	echo '<div class="entry '.$orientation.'"><a class="cover" style="background-image:url('.$cover.')" href="'.get_the_permalink().'"></a><div class="content"><h2>'.get_the_title().'</h2><p>'.get_the_excerpt().'</p></div></div>';
?>