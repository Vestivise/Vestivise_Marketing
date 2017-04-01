<?php
	$disqus_username = get_theme_mod('disqus_username');
	if(post_password_required()){return;}
	wp_enqueue_script('comment-reply');
?>

<?php if(comments_open()){?>

	<hr class="divider">

	<section id="comments">
	<?php 
		if(!$disqus_username){
			if(have_comments()){
			?>
				<h3><?php comments_number('No Comments','One Comment','% Comments');?></h3>
				<ol class="comment-list">
					<?php
						wp_list_comments(array(
							'callback' => 'phase_comments',
							'style' => 'ol',
							'short_ping' => true,
							'avatar_size' => 40,
						));
					?>
				</ol>

				<hr class="divider">

				<?php if(get_comment_pages_count()>1&& get_option('page_comments')){?>
					<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
						<hr class="divider">
						<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments'.'phase_surface'));?></div><div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;'.'phase_surface'));?></div>
					</nav>
					
					<hr class="divider">
				<?php 
				}
			}

			$commenter = wp_get_current_commenter();
			$req = get_option('require_name_email');
			$aria_req = ($req ?" aria-required='true'":'');
			$required_text = ' *';

			$fields =  array(
				'author'=>'<p class="comment-form-author"><label for="author">'.__('Name','domainreference' ).'</label> ' .'<input id="author" placeholder="Name'.($req?$required_text:'').'" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.'/></p>',
				'email'=>'<p class="comment-form-email"><label for="email">'.__('Email','domainreference').'</label>'.'<input id="email" placeholder="Email'.($req?$required_text:'').'" name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req.' /></p>',
				'url'=>'<p class="comment-form-url"><label for="url">'.__('Website','domainreference').'</label>'.'<input id="url"  placeholder="Website (optional)" name="url" type="text" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></p>',
			);

			$comments_args = array(
			    'title_reply'=>'Leave a comment',
			    'title_reply_to'=>'Leave a reply to %s &#183;',
			    'cancel_reply_link'=>'Cancel',
			    'comment_notes_before'=>'',
			    'comment_notes_after' =>'',
			    'comment_field' =>'<p class="comment-form-comment"><label for="comment">'._x( 'Comment', 'noun' ) . '</label><textarea id="comment" placeholder="Leave a comment here" name="comment" aria-required="true"></textarea></p>',
				'fields' => apply_filters('comment_form_default_fields',$fields),
			    'label_submit'=>'Submit Comment'
				);

			comment_form($comments_args);

		}else{
		?>

		<script type="text/javascript">
			var disqus_url="<?php the_permalink();?>";
			var disqus_title ="<?php the_title();?>";
		</script>
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			var disqus_identifier=<?php the_ID();?>;
			(function(){
				var dsq = document.createElement('script');
				dsq.type = 'text/javascript';
				dsq.async = true;
				dsq.src = 'http://<?php echo $disqus_username;?>.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>
			Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=<?php echo $disqus_username;?>">comments powered by Disqus.</a>
		</noscript>

	<?php }?>
	</section>

	<a id="click-comment"><?php comments_number('Leave a comment','Show one comment','Show % comments');?></a>

<?php }?>