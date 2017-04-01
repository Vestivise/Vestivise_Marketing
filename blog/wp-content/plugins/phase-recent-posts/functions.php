<?php 

/*

    Plugin Name: Phase Recent Posts
    Plugin URI: http://phasethemes.com/plugins/recent-posts
    Description: Enable a recent post widget with thumbnails
    Version: 1.1
    Author: Phase Themes
    Author URI: http://phasethemes.com

*/

    if(!defined('WPINC')){die;}

    //  Register Widget

    require_once(DIRNAME(__FILE__).'/phase-recent-posts-widget.php');

    function phase_recent_posts_enqueue_scripts() {
        wp_enqueue_style('recent_posts_css',plugins_url('phase-recent-posts/style.css'));
    }
    add_action('wp_enqueue_scripts','phase_recent_posts_enqueue_scripts');   

?>