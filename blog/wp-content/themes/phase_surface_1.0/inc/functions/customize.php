<?php
function Phase_customize_register($wp_customize){
    $colors = array();

    /*  Header  */

    $colors[] = array(
        'slug'=>'header_title',
        'default'=>'#fff',
        'label'=>__('Header Title','phase_surface')
        );
    $colors[] = array(
        'slug'=>'header_title_hover',
        'default'=>'#ccc',
        'label'=>__('Header Title Hover','phase_surface')
        );
    $colors[] = array(
        'slug'=>'header_links',
        'default'=>'#eee',
        'label'=>__('Header Links','phase_surface')
        );
    $colors[] = array(
        'slug'=>'header_links_hover',
        'default'=>'#fff',
        'label'=>__('Header Links Hover','phase_surface')
        );
    $colors[] = array(
        'slug'=>'header_background',
        'default'=>'#111',
        'label'=>__('Header Background','phase_surface')
        );
    $colors[] = array(
        'slug'=>'header_dividers',
        'default'=>'#212121',
        'label'=>__('Header Dividers','phase_surface')
        );

    /*  Submenu  */

    $colors[] = array(
        'slug'=>'submenu_links',
        'default'=>'#ccc',
        'label'=>__('Submenu Links','phase_surface')
        );
    $colors[] = array(
        'slug'=>'submenu_links_hover',
        'default'=>'#fff',
        'label'=>__('Submenu Links Hover','phase_surface')
        );
    $colors[] = array(
        'slug'=>'submenu_background',
        'default'=>'#181818',
        'label'=>__('Submenu Background','phase_surface')
        );

    /*  Featured  */

    $colors[] = array(
        'slug'=>'featured_text',
        'default'=>'#fff',
        'label'=>__('Featured Text','phase_surface')
        );
    $colors[] = array(
        'slug'=>'featured_background',
        'default'=>'#1f2024',
        'label'=>__('Featured Background','phase_surface')
        );

    /*  Sidebar  */

    $colors[] = array(
        'slug'=>'sidebar_text',
        'default'=>'#454545',
        'label'=>__('Sidebar Text','phase_surface')
        );
    $colors[] = array(
        'slug'=>'sidebar_background',
        'default'=>'#f5f5f5',
        'label'=>__('Sidebar Background','phase_surface')
        );
    $colors[] = array(
        'slug'=>'sidebar_divider',
        'default'=>'#e8e8e8',
        'label'=>__('Sidebar Divider','phase_surface')
        );

    /*  Explore  */

    $colors[] = array(
        'slug'=>'explore_title',
        'default'=>'#fff',
        'label'=>__('Popular Section Title','phase_surface')
        );
    $colors[] = array(
        'slug'=>'explore_text',
        'default'=>'#ccc',
        'label'=>__('Popular Section Text','phase_surface')
        );
    $colors[] = array(
        'slug'=>'explore_background',
        'default'=>'#000000',
        'label'=>__('Popular Section Background','phase_surface')
        );
    $colors[] = array(
        'slug'=>'explore_divider',
        'default'=>'#212121',
        'label'=>__('Popular Section Divider','phase_surface')
        );

    /*  Article Page  */

    $colors[] = array(
        'slug'=>'article_titles',
        'default'=>'#111',
        'label'=>__('Article Titles','phase_surface')
        );
    $colors[] = array(
        'slug'=>'article_paragraphs',
        'default'=>'#555',
        'label'=>__('Article Paragraphs','phase_surface')
        );
    $colors[] = array(
        'slug'=>'article_links',
        'default'=>'#167c80',
        'label'=>__('Article Links','phase_surface')
        );
    $colors[] = array(
        'slug'=>'article_background',
        'default'=>'#212121',
        'label'=>__('Article Background','phase_surface')
        );
    $colors[] = array(
        'slug'=>'article_dividers',
        'default'=>'#efefef',
        'label'=>__('Article Dividers','phase_surface')
        );
    $colors[] = array(
        'slug'=>'progress_bar_gradient_start',
        'default'=>'#28afa6',
        'label'=>__('Progress Bar Gradient Start','phase_surface')
        );
    $colors[] = array(
        'slug'=>'progress_bar_gradient_end',
        'default'=>'#0c70e0',
        'label'=>__('Progress Bar Gradient End','phase_surface')
        );
    $colors[] = array(
        'slug'=>'background',
        'default'=>'#fff',
        'label'=>__('Background','phase_surface')
        );

    /*  Forms  */

    $colors[] = array(
        'slug'=>'form_submit_button', 
        'default'=>'#111',
        'label'=>__('Form Submit Button','phase_surface')
        );
    $colors[] = array(
        'slug'=>'form_background',
        'default'=>'#f8f8f8',
        'label'=>__('Form Backgrounds','phase_surface')
        );
    $colors[] = array(
        'slug'=>'form_highlight', 
        'default'=>'#efefef',
        'label'=>__('Form Highlight','phase_surface')
        );

    /*  Footer  */

    $colors[] = array(
        'slug'=>'footer_text', 
        'default'=>'#fff',
        'label'=>__('Footer Text','phase_surface')
        );
    $colors[] = array(
        'slug'=>'footer_background', 
        'default'=>'#1e2023',
        'label'=>__('Footer Background','phase_surface')
        );

    foreach($colors as $color){
        $wp_customize->add_setting(
            $color['slug'],array(
            'default'=>$color['default'],
            'type'=>'option', 
            'capability'=>'edit_theme_options',
            'sanitize_callback'=>'sanitize_hex_color',
            )
      );
      $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            $color['slug'], 
            array('label' => $color['label'], 
            'section'=>'colors',
            'settings'=>$color['slug'])
            )
      );
    }

    class Phase_Customize_Textarea_Control extends WP_Customize_Control{
        public $type = 'textarea';
        public function render_content(){
    ;?>

        <label><span class="customize-control-title"><?php echo esc_html($this->label);?></span><textarea rows="5" style="width:100%;"<?php $this->link();?>><?php echo esc_textarea($this->value());?></textarea></label>

    <?php
            }
        }

    $wp_customize->add_setting('header_logo',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,'header_logo',array(
            'label'=>'Header Logo',
            'section'=>'header',
            'settings'=>'header_logo'
        )));
    $wp_customize->add_setting('favicon_upload',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,'favicon_upload',array(
            'label'=>'Favicon Upload',
            'section'=>'header',
            'description'=>'The favicon, also known as the shortcut icon is the icon that appears on top of your browser tab, bookmark icon, and shortcut icons. The recommended size is 180x180px to cover various types of screen resolutions.'
        )));
    $wp_customize->add_setting('sticked_header',array('default'=>true,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('sticked_header',array(
        'label'=>__('Sticked Header','phase_surface'),
        'section'=>'header',
        'description'=>'Submenu will be sticked while scrolling. If there is no submenu, the primary menu will be sticked.',
        'type'=>'checkbox'
        ));

        $wp_customize->add_section('header',array(
            'title'=>__('Header','phase_surface'),
            ));

    $wp_customize->add_setting('search_icon',array('default'=>true,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('search_icon',array(
        'label'=>__('Search Icon','phase_surface'),
        'section'=>'header_icons',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('header_rss_url',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('header_rss_url',array(
        'label'=>__('RSS Feed','phase_surface'),
        'section'=>'header_icons',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('header_email_address',array('sanitize_callback'=>'sanitize_email'));
    $wp_customize->add_control('header_email_address',array(
        'label'=>__('Email Address','phase_surface'),
        'section'=>'header_icons',
        'type'=>'text'
        ));
    $wp_customize->add_setting('header_behance_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_behance_url',array(
        'label'=>__('Behance URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_dribbble_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_dribbble_url',array(
        'label'=>__('Dribbble URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_facebook_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_facebook_url',array(
        'label'=>__('Facebook URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_flickr_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_flickr_url',array(
        'label'=>__('Flickr URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_github_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_github_url',array(
        'label'=>__('Github URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_googleplus_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_googleplus_url',array(
        'label'=>__('Google Plus URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_instagram_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_instagram_url',array(
        'label'=>__('Instagram URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_linkedin_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_linkedin_url',array(
        'label'=>__('Linkedin URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_pinterest_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_pinterest_url',array(
        'label'=>__('Pinterest URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_skype_url',array('sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('header_skype_url',array(
        'label'=>__('Skype Username','phase_surface'),
        'section'=>'header_icons',
        'type'=>'text'
        ));
    $wp_customize->add_setting('header_spotify_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_spotify_url',array(
        'label'=>__('Spotify URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_tumblr_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_tumblr_url',array(
        'label'=>__('Tumblr URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_twitter_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_twitter_url',array(
        'label'=>__('Twitter URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'text'
        ));
    $wp_customize->add_setting('header_vimeo_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_vimeo_url',array(
        'label'=>__('Vimeo URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));
    $wp_customize->add_setting('header_youtube_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('header_youtube_url',array(
        'label'=>__('Youtube URL','phase_surface'),
        'section'=>'header_icons',
        'type'=>'url'
        ));

        $wp_customize->add_section('header_icons',array(
            'title'=>__('Header Icons','phase_surface'),
            ));

    $wp_customize->add_setting('sidebar_position',array('default'=>'sidebar-l','sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('sidebar_position',array(
        'label'=>__('Sidebar Position','phase_surface'),
        'section'=>'layout',
        'type'=>'radio',
        'choices'=>array(
            'sidebar-l'=>'Left Sidebar',
            'sidebar-r'=>'Right Sidebar'
            ),
        ));
    $wp_customize->add_setting('animated_loading',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('animated_loading',array(
        'label'=>__('Animated Loading','phase_surface'),
        'section'=>'layout',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('homepage_sidebar',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('homepage_sidebar',array(
        'label'=>__('Home Page Sidebar','phase_surface'),
        'section'=>'layout',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_article_category',array('default'=>true,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_article_category',array(
        'label'=>__('Display Article Category','phase_surface'),
        'section'=>'layout',
        'description'=>'Display the first category of each post on the post grid.',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('infinite_scrolling',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('infinite_scrolling',array(
        'label'=>__('Infinite Scrolling','phase_surface'),
        'section'=>'layout',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_to_top_button',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_to_top_button',array(
        'label'=>__('Display To Top Button','phase_surface'),
        'section'=>'layout',
        'type'=>'checkbox'
        ));

        $wp_customize->add_section('layout',array(
            'title'=>__('Layout','phase_surface'),
            ));


    // $wp_customize->add_setting('category_slug_01',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_01',array(
    //     'label'=>__('Category Slug 1','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));
    // $wp_customize->add_setting('category_slug_02',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_02',array(
    //     'label'=>__('Category Slug 2','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));
    // $wp_customize->add_setting('category_slug_03',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_03',array(
    //     'label'=>__('Category Slug 3','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));
    // $wp_customize->add_setting('category_slug_04',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_04',array(
    //     'label'=>__('Category Slug 4','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));
    // $wp_customize->add_setting('category_slug_05',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_05',array(
    //     'label'=>__('Category Slug 5','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));
    // $wp_customize->add_setting('category_slug_06',array('sanitize_callback'=>'sanitize_text_field'));
    // $wp_customize->add_control('category_slug_06',array(
    //     'label'=>__('Category Slug 6','phase_surface'),
    //     'section'=>'category_section',
    //     'type'=>'text'
    //     ));

    //     $wp_customize->add_section('category_section',array(
    //         'title'=>__('Category Section','phase_surface'),
    //         'description'=>'Enter the <u>category slug</u> to display category blocks in under the posts section.'
    //         ));

    $wp_customize->add_setting('display_popular_articles_home',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_popular_articles_home',array(
        'label'=>__('Display Popular Articles on Homepage','phase_surface'),
        'section'=>'popular_section',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_popular_articles_page',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_popular_articles_page',array(
        'label'=>__('Display Popular Articles on Pages','phase_surface'),
        'section'=>'popular_section',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('popular_weeks_ago',array('default'=>4,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('popular_weeks_ago',array(
        'label'=>__('Popular Articles Timeline Limit','phase_surface'),
        'section'=>'popular_section',
        'description'=>'Retreive popular articles within this range, unit measurements are in weeks.',
        'type'=>'text'
        ));

        $wp_customize->add_section('popular_section',array(
            'title'=>__('Popular Section','phase_surface'),
            ));

    $wp_customize->add_setting('display_cover',array('default'=>true,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_cover',array(
        'label'=>__('Display Cover','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_vertical_cover',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_vertical_cover',array(
        'label'=>__('Display Vertical Cover','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('stylized_first_paragraph',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('stylized_first_paragraph',array(
        'label'=>__('Stylized First Paragraph','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('stylized_first_letter',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('stylized_first_letter',array(
        'label'=>__('Stylized First Letter','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_progress_bar',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_progress_bar',array(
        'label'=>__('Display Progress Bar','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_categories_and_tags',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_categories_and_tags',array(
        'label'=>__('Display Categories and Tags','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_article_view_counts',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_article_view_counts',array(
        'label'=>__('Display Article View Counts','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('display_related_articles',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('display_related_articles',array(
        'label'=>__('Display Related Articles','phase_surface'),
        'section'=>'content_page',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('disqus_username',array('sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('disqus_username',array(
        'label'=>__('Disqus Username','phase_surface'),
        'section'=>'content_page',
        'type'=>'text',
        'description'=>'Disqus is an online discussion system, to enable this feature register at <a href="https://disqus.com">Disqus.com</a> and enter the username here. Please note that this will override the default comment sytem your WordPress site is using.'
        ));

        $wp_customize->add_section('content_page',array(
            'title'=>__('Content Page','phase_surface'),
            ));


    $wp_customize->add_setting('footer_rss_url',array('default'=>false,'sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('footer_rss_url',array(
        'label'=>__('RSS Feed','phase_surface'),
        'section'=>'footer',
        'type'=>'checkbox'
        ));
    $wp_customize->add_setting('footer_email_address',array('sanitize_callback'=>'sanitize_email'));
    $wp_customize->add_control('footer_email_address',array(
        'label'=>__('Email Address','phase_surface'),
        'section'=>'footer',
        'type'=>'text'
        ));
    $wp_customize->add_setting('footer_behance_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_behance_url',array(
        'label'=>__('Behance URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_dribbble_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_dribbble_url',array(
        'label'=>__('Dribbble URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_facebook_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_facebook_url',array(
        'label'=>__('Facebook URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_flickr_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_flickr_url',array(
        'label'=>__('Flickr URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_github_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_github_url',array(
        'label'=>__('Github URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_googleplus_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_googleplus_url',array(
        'label'=>__('Google Plus URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_instagram_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_instagram_url',array(
        'label'=>__('Instagram URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_linkedin_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_linkedin_url',array(
        'label'=>__('Linkedin URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_pinterest_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_pinterest_url',array(
        'label'=>__('Pinterest URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_skype_url',array('sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('footer_skype_url',array(
        'label'=>__('Skype Username','phase_surface'),
        'section'=>'footer',
        'type'=>'text'
        ));
    $wp_customize->add_setting('footer_spotify_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_spotify_url',array(
        'label'=>__('Spotify URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_tumblr_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_tumblr_url',array(
        'label'=>__('Tumblr URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_twitter_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_twitter_url',array(
        'label'=>__('Twitter URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_vimeo_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_vimeo_url',array(
        'label'=>__('Vimeo URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_youtube_url',array('sanitize_callback'=>'esc_url_raw'));
    $wp_customize->add_control('footer_youtube_url',array(
        'label'=>__('Youtube URL','phase_surface'),
        'section'=>'footer',
        'type'=>'url'
        ));
    $wp_customize->add_setting('footer_credit',array('sanitize_callback'=>'wp_kses'));
    $wp_customize->add_control(new Phase_Customize_Textarea_Control($wp_customize,'footer_credit',array(
            'label'=>'Custom Footer Text',
            'section'=>'footer'
            )
        ));

        $wp_customize->add_section('footer',array(
            'title'=>__('Footer','phase_surface'),
            ));

    $wp_customize->add_setting('google_font_titles',array('sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('google_font_titles',array(
        'label'=>__('Google Font Titles','phase_surface'),
        'section'=>'font_families',
        'type'=>'text'
        ));
    $wp_customize->add_setting('google_font_text',array('sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('google_font_text',array(
        'label'=>__('Google Font Text','phase_surface'),
        'section'=>'font_families',
        'type'=>'text'
        ));

        $wp_customize->add_section('font_families',array(
            'title'=>__('Font Families','phase_surface'),
            ));

}

add_action('customize_register','Phase_customize_register');

function phase_customize_setting(){

    function hex2rgb($hex){list($r,$g,$b) = sscanf($hex, "#%02x%02x%02x");$rgb = "$r,$g,$b";return $rgb;}
    $header_title = get_option('header_title','#fff');
    $header_title_hover = get_option('header_title_hover','#ccc');
    $header_links = get_option('header_links','#eee');
    $header_links_hover = get_option('header_links_hover','#fff');
    $header_background = get_option('header_background','#111');
    $header_dividers = get_option('header_dividers','#212121');
    $submenu_links = get_option('submenu_links','#ccc');
    $submenu_links_hover = get_option('submenu_links_hover','#fff');
    $submenu_background = get_option('submenu_background','#181818');
    $submenu_background_rgb = hex2rgb($submenu_background);

    $featured_text = get_option('featured_text','#fff');
    $featured_background = get_option('featured_background','#1f2024');
    $featured_background_rgb = hex2rgb($featured_background);

    $sidebar_text = get_option('sidebar_text','#454545');
    $sidebar_background = get_option('sidebar_background','#f5f5f5');
    $sidebar_divider = get_option('sidebar_divider','#e8e8e8');

    $explore_title = get_option('explore_title','#fff');
    $explore_text = get_option('explore_text','#ccc');
    $explore_background = get_option('explore_background','#000000');
    $explore_background_rgb = hex2rgb($explore_background);
    $explore_divider = get_option('explore_divider','#212121');

    $article_titles = get_option('article_titles','#111');
    $article_paragraphs = get_option('article_paragraphs','#555');
    $article_links = get_option('article_links','#167c80');
    $article_background = get_option('article_background','#212121');
    $article_dividers = get_option('article_dividers','#efefef');
    $progress_bar_gradient_start = get_option('progress_bar_gradient_start','#28afa6');
    $progress_bar_gradient_end = get_option('progress_bar_gradient_end','#0c70e0');
    $background = get_option('background','#fff');

    $form_submit_button = get_option('form_submit_button','#111');
    $form_background = get_option('form_background','#f8f8f8');
    $form_highlight = get_option('form_highlight','#efefef');
    $footer_text = get_option('footer_text','#fff');
    $footer_background = get_option('footer_background','#1e2023');

    echo '<style type="text/css">

        #header h1 a,#header a#click-menu,#header #navigation li.menu-item-has-children:after,a#scroll-top{color:'.$header_title.'}

        #header #navigation li a,#header #social li a,#header #social form input{color:'.$header_links.'}

        #header #navigation li a:hover,#header #social li a:hover{color:'.$header_links_hover.'}

        @media screen and (max-width:600px){

            #header #navigation li a{background:'.$header_background.'}

            #header #navigation li a,#header #navigation li > ul li a{border-top:1px solid '.$header_dividers.';box-shadow:none !important;}
            }

        #header,#header #navigation li > ul,#header #navigation #menu > li.menu-item-has-children:hover > a::before,body.search #social form,a#scroll-top{background:'.$header_background.' !important}

        #header #navigation li a,#header #social,body.search #social form{box-shadow: 1px 0 '.$header_dividers.',inset 1px 0 '.$header_dividers.'}

        #header #navigation #menu > li > ul{box-shadow: 1px 1px '.$header_dividers.',inset 1px 0 '.$header_dividers.'}

        #header #navigation li > ul li > ul{box-shadow: 1px 1px '.$header_dividers.',inset 1px 1px '.$header_dividers.'}

        #header{border-bottom:1px solid '.$header_dividers.'}

        #submenu h1 a,#submenu li a,#submenu form input{color:'.$submenu_links.'}

        #submenu h1 a:hover,#submenu li a:hover,#submenu li.current-menu-item a,#submenu form input:focus{color:'.$submenu_links_hover.'}

        #submenu li.current-menu-item:after{background:'.$submenu_links_hover.'}

        #submenu,#submenu form,#submenu .menu li.click-search{background:'.$submenu_background.'}

        #submenu section:after{background:linear-gradient(to right,rgba('.$submenu_background_rgb.',0)0%,rgba('.$submenu_background_rgb.',1)100%)}

        /*   Featured Scheme  */

        #featured.heading h1,#featured.heading p,#featured.heading a,#featured.single.text .post-info,#featured.single.text .post-info a,#article-pagination li h2{color:'.$featured_text.'}

        #featured,#article-pagination li{background-color:'.$featured_background.' !important}

        .slick-prev{background:linear-gradient(to right,rgba('.$featured_background_rgb.',1)0%,rgba('.$featured_background_rgb.',0)100%)}

        .slick-next{background:linear-gradient(to right,rgba('.$featured_background_rgb.',0)0%,rgba('.$featured_background_rgb.',1)100%)}

        /*  Sidebar & Pagination Scheme  */

        #sidebar,#sidebar h2,#sidebar ul li a,#sidebar ul li span,#sidebar .tagcloud a,#sidebar .widget #calendar_wrap table#wp-calendar a,#sidebar .widget #calendar_wrap table#wp-calendar td#next a:after,#sidebar .widget #calendar_wrap table#wp-calendar td#prev a:before,#pagination a#load,#pagination a.next,#pagination a.prev,#pagination a.page-numbers{color:'.$sidebar_text.'}

        #pagination a.prev:hover,#pagination a.next:hover{box-shadow:inset 0 0 0 3px '.$sidebar_text.'}

        #sidebar .widget,#pagination,#pagination a#load span#loading > div{background-color:'.$sidebar_background.'}

        #sidebar .widget h2{border-bottom:1px solid '.$sidebar_divider.'}

        #sidebar .widget ul li{border-bottom:1px solid '.$sidebar_divider.'}

        #sidebar .widget #calendar_wrap table#wp-calendar tbody td,#sidebar .widget #calendar_wrap table#wp-calendar thead th{border:1px solid '.$sidebar_divider.'}

        #pagination a#load:hover,#pagination a#load.loading{background:'.$sidebar_text.'}

        /*  Explore Scheme  */

        .explore h2.title,a#explore-more{color:'.$explore_title.'}

        .explore .entry .content{color:'.$explore_text.'}

        #category .entry.vertical,.explore,.explore:before,.explore .entry,.explore .entry.vertical .cover:before{background:'.$explore_background.'}

        a#explore-more:hover{color:'.$explore_background.';background:'.$explore_title.'}

        .explore .entry,a#explore-more{box-shadow:0 0 0 1px '.$explore_divider.'}

        .explore:after,.explore .entry:after{background:linear-gradient(to bottom,rgba('.$explore_background_rgb.',0) 0%,rgba('.$explore_background_rgb.',1)100%)}

        /*  Article Scheme  */

        #category h2.title,#category .entry.horizontal .content h2,article.entry h1,article.entry h2,article.entry h3,article.entry h4,article.entry h5,article.entry code,article.entry pre,.single article.entry.style_paragraph > p:first-child,.single article.entry .intro,article.entry.style_paragraph > p:first-child,article.entry blockquote,#meta #share li a,#comments #respond h3#reply-title,#comments #respond h3#reply-title a,#comments #respond h3#reply-title small a,#comments ol.comment-list li.comment .comment-context .comment-info,#comments ol.comment-list li.comment .comment-context .comment-info a{color:'.$article_titles.'}

        #category .entry.horizontal .content small,#category .entry.horizontal .content small a,#category .entry.horizontal .content p,article.entry,#post-info a,#comments #comment-nav-below > div a,#comments #respond p.must-log-in a,#comments #respond p.logged-in-as a{color:'.$article_paragraphs.'}

        #category h2.title a:hover,a,article.entry a{color:'.$article_links.'}

        .grid article .block{background-color:'.$article_background.' !important}

        article.entry blockquote{border-left:3px solid '.$article_dividers.'}

        article.entry table td,article.entry table th{border:1px solid '.$article_dividers.'}

        hr{background:'.$article_dividers.'}

        #comments .comment-list #respond{border-top:1px solid '.$article_dividers.'}

        #meta #share li,article.entry .gallery-item{box-shadow: inset 1px 1px '.$article_dividers.',1px 1px '.$article_dividers.'}

        #progressbar{background:linear-gradient(to right,'.$progress_bar_gradient_start.' 0%,'.$progress_bar_gradient_end.' 100%)}

        body{background:'.$background.'}

        /*  Form Scheme  */

        a#click-comment,#comments #respond form .form-submit input,#container.contact form input#submit{background:'.$form_submit_button.'}

        #comments #respond input,#comments #respond textarea,#container.contact form input,#container.contact form textarea{background:'.$form_background.'}

        #comments #respond form input:focus,#comments #respond form textarea:focus,#container.contact form input:focus,#container.contact form textarea:focus{box-shadow:inset 0 0 0 1px '.$form_highlight.'
            }

        a#click-comment:hover,#comments #respond form .form-submit input:hover,#container.contact form input#submit:hover{background:'.$article_links.'}

        /*  Footer Scheme  */

        #footer{background:'.$footer_background.'}

        #footer,#footer h2,#footer ul li a,#footer ul li span,#footer .tagcloud a,#footer .widget #calendar_wrap table#wp-calendar a,#footer .widget #calendar_wrap table#wp-calendar td#next a:after,#footer .widget #calendar_wrap table#wp-calendar td#prev a:before,#footer #connect,#footer #connect a{color:'.$footer_text.'}

    </style>';

    $google_font_titles = get_theme_mod('google_font_titles');
    $google_font_text = get_theme_mod('google_font_text');

    if($google_font_titles||$google_font_text){echo '<link href="http://fonts.googleapis.com/css?family=';if($google_font_titles){echo $google_font_titles.':400,700';}if($google_font_titles&&$google_font_text){echo '|';}if($google_font_text){echo $google_font_text.':400,700,400italic,700italic';}echo '" rel="stylesheet" type="text/css">';}

    if($google_font_titles){echo '<style type="text/css">h1,h2,h3,h4,h5,#header h1,#header #navigation li a,#submenu h1 a,#submenu li a,#featured.heading h1,#featured.single h1,.slick-slider .slick-list li.slick-slide h2,.grid article .block h2,.grid article .block .info small,.grid article .block.text .content small,.grid article .block.text .content a.more,#no-articles h2,#category h2.title,#category h2.title small,#category .entry .content h2,.explore h2.title,.explore .entry .content h2,a#explore-more,article.entry header h1,#comments #comment-nav-below > div a,#comments #respond h3#reply-title,a#click-comment,#comments #respond form .form-submit input,#container.contact form input#submit,#article-pagination li .center h2,#article-pagination li .center p,#sidebar h2,.widget #calendar_wrap table#wp-calendar caption,.widget #phase-recent-posts-widget ul li a h3,#pagination,#pagination a.prev,#pagination a.next,#footer h2,#footer .widget #calendar_wrap table#wp-calendar caption{font-family:'.$google_font_titles.' !important}';}
    if($google_font_text){echo 'body,#header #social form input,#submenu form input,article.entry header span,#featured.heading p,#featured.single .post-info span,#featured.single .featured-caption,.grid article .block a.category,.grid article .block.text .content p,#category .entry .content small,#category .entry .content p,.explore .entry .content p,#meta #share li.comment a b,article.entry,article.entry blockquote,article.entry p.wp-caption-text,article.entry.style_paragraph > p:first-child,article.entry.style_letter > p:first-child::first-letter,#post-info,#comments #respond h3#reply-title a,#comments #respond h3#reply-title small a,#comments #respond p.must-log-in,#comments #respond p.logged-in-as,#comments #respond input,#comments #respond textarea,#container.contact form input,#container.contact form textarea.widget .tagcloud a,#footer .widget ul.menu li a,.sponsor{font-family:'.$google_font_text.' !important}</style>';}
}

add_action('wp_enqueue_scripts','phase_customize_setting');
?>