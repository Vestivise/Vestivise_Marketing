<aside id="sidebar">
	<?php 
		if(is_single()||is_page()){
			dynamic_sidebar('sidebar-single');
		}else{
			dynamic_sidebar('sidebar-home');
		}
	?>
</aside>