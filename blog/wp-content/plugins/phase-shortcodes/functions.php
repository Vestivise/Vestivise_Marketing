<?php 

/*

    Plugin Name: Phase Shortcodes
    Plugin URI: http://phasethemes.com/plugins/shortcodes
    Description: Enable basic shortcodes for your wordpress site
    Version: 1.0
    Author: Phase Themes
    Author URI: http://phasethemes.com

*/

    if(!defined('WPINC')){
        die;
    }

    require_once(DIRNAME(__FILE__).'/inc/class_shortcodes.php');

    function phase_setup_shortcodes() {
        new Phase_Shortcodes();
    }

    phase_setup_shortcodes();

    function phase_shortcode_enqueue_shortcodes_scripts(){
        if (!is_admin()){
            wp_register_style('shortcodes-style',plugin_dir_url(__FILE__).'css/style.css');
            wp_enqueue_style('shortcodes-style');

        }
    }

    add_action('wp_enqueue_scripts','phase_shortcode_enqueue_shortcodes_scripts');

    function phase_shortcode_tc_button(){
        global $typenow;
        if(!current_user_can('edit_posts')&&!current_user_can('edit_pages')){
            return;
            }
        if(!in_array($typenow,array('post','page')))
            return;
        if(get_user_option('rich_editing')=='true'){
            add_filter("mce_external_plugins","phase_shortcode_tinymce_plugin");
            add_filter('mce_buttons','phase_shortcode_register_button');
        }
    }

    add_action('admin_head','phase_shortcode_tc_button');

    function phase_shortcode_tinymce_plugin($plugin_array){
        $plugin_array['phase_shortcode_tc_button']=plugins_url('/js/text-button.js', __FILE__ );
        return $plugin_array;
        }

    function phase_shortcode_register_button($buttons){
        array_push($buttons,"phase_shortcode_tc_button");
        return $buttons;
        }

    function phase_shortcode_button_icon(){
        wp_enqueue_style('phase_shortcode',plugins_url('/css/style.css',__FILE__));
        }

    add_action('admin_enqueue_scripts','phase_shortcode_button_icon');

?>