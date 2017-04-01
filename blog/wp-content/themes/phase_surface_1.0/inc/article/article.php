<?php
	if(!is_single()){
		get_template_part('inc/article/article-index');
	}else{
		get_template_part('inc/article/article-single');
	}
?>