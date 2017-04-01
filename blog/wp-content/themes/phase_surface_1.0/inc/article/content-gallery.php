<?php
	$args = array(
	    'post_type' => 'attachment',
	    'numberposts' => -1,
	    'post_status' => null,
	    'orderby' => 'menu_order',
	    'post_parent' => $post->ID
	);

	$attachments = get_posts($args);

	if($attachments){?>
		<ul id="slider" class="media">
			<?php
				foreach($attachments as $attachment){
					echo '<li>'.wp_get_attachment_image($attachment->ID,'full').'</li>';
				}
			?>
		</ul>
	<?php 
	}
?>