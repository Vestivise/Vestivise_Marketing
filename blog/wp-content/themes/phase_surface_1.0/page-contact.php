<?php 

	/*

		Template Name: Contact Page

	*/

    get_header();
    $display_popular_articles_page = get_theme_mod('display_popular_articles_page');
    if(has_post_thumbnail()){
        $cover = phase_featured_image_url('full');
    }else{
        $cover = '';
    }
    if($cover){
        $orientation = 'cover';
    }else{
        $orientation = 'no-cover';
    }

    $response = "";

    function my_contact_form_generate_response($type, $message){
        global $response;
        if($type == "success"){
            $response = "<div class='success'>{$message}</div>";
        }else{
            $response = "<div class='error'>{$message}</div>";
        }
    }

    $not_human       = "Human verification incorrect.";
    $missing_content = "Please supply all information.";
    $email_invalid   = "Email Address Invalid.";
    $message_unsent  = "Message was not sent. Try Again.";
    $message_sent    = "Thanks! Your message has been sent.";

    if(isset($_POST['message_name'])){
        $name = $_POST['message_name'];
    }
    if(isset($_POST['message_email'])){
        $email = $_POST['message_email'];
    }else{
        $email = '';
    }
    if(isset($_POST['message_text'])){
        $message = $_POST['message_text'];
    }
    if(isset($_POST['message_human'])){
        $human = $_POST['message_human'];
    }
    if(get_option('admin_email')){
        $to = get_option('admin_email');
    }

    $subject = 'Message from '.$name.' | '.get_bloginfo('name');
    $headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n";

    if($_POST['submitted']){
        if($human==""){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                my_contact_form_generate_response("error", $email_invalid);
            }else{
                if(empty($name) || empty($message)){
                  my_contact_form_generate_response("error", $missing_content);
                }else{
                    $sent = wp_mail($to,$subject,strip_tags($message), $headers);
                    if($sent){
                        my_contact_form_generate_response("success", $message_sent);
                    }else{
                        my_contact_form_generate_response("error", $message_unsent);
                    }
                }
            }
        }elseif($_POST['submitted']){
            my_contact_form_generate_response("error", $missing_content);
        }
    }

	echo '<div id="featured" class="heading page '.$orientation.'" style="background-image:url('.$cover.')"><h1>'.get_the_title().'</h1><div id="overlay"></div></div>';
?>

<div id="container" class="single page contact">

	<section id="posts-container" class="no-sidebar">

		<div id="posts">
			<article class="entry">
				<?php 
                    if(have_posts()){
                        while(have_posts()):the_post();
                            the_content();
                        endwhile;
                    }
                ?>
				<div id="respond">
					<?php echo $response;?>
					<form action="<?php the_permalink();?>" method="post">
					    <input type="text" name="message_name" placeholder="Name"><input type="text" name="message_email" placeholder="Email Address">
						<textarea type="text" name="message_text" placeholder="Type your message here"></textarea>
						<input type="hidden" name="submitted" value="1">
					    <input id="submit" type="submit">
					</form>
				</div>

			</article>
		</div>

	</section>

</div>

<?php 
    $query = new WP_Query(array('posts_per_page'=>8,'ignore_sticky_posts'=>1,'order'=>'DESC'));
    if($display_popular_articles_page&&$query->have_posts()){
    ?>
        <div id="popular" class="explore exceed">
            <section>
                <h2 class="title"><?php _e('Latest Articles','phase_surface');?></h2>
                <?php 
                    while($query->have_posts()):$query->the_post();
                        get_template_part('inc/article/article-explore');
                    endwhile;
                    wp_reset_postdata();
                ?>
            </section>
            <a id="explore-more"><?php _e('Explore More','phase_surface');?></a>
        </div>
    <?php 
    }
    get_footer();
?>