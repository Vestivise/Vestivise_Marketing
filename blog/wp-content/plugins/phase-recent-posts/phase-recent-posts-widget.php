<?php
function Phase_Recent_Posts_Widget(){
    register_widget('Phase_Recent_Posts_Widget');
}

add_action('widgets_init','Phase_Recent_Posts_Widget');

class Phase_Recent_Posts_Widget extends WP_Widget{
    function __construct(){
        $args = array(
            'description' => esc_html__('A widget that displays your most recent posts with thumbnails','phase')
        );
        parent::__construct('Phase_Recent_Posts_Widget', esc_html__('Phase Recent Posts Widget','phase'),$args);
    }

    public function widget($args,$instance){
        extract($args);
        echo wp_kses_post($before_widget);
        if(have_posts()){
            echo '<div id="phase-recent-posts-widget">';
            if(isset($instance['title'])){
                echo wp_kses_post($before_title.apply_filters('widget_title',$instance['title']).$after_title);
            }
            echo '<ul>';

            if(isset($instance['amount'])){
                $amount = $instance['amount'];
            }else{
                $amount = 5;
            }

            if(isset($instance['category'])){
                $category = $instance['category'];
            }else{
                $category = '';
            }

            $args = array('category_name'=>$category,'posts_per_page'=>$amount);
            $the_query = new WP_Query($args);

            while($the_query->have_posts()):$the_query->the_post();
            if(has_post_thumbnail()){
                $cover = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()),'thumbnail');
            }else{
                $cover = '';
            }
            echo '<li><a href="'.get_the_permalink().'"><div class="image" style="background-image:url('.$cover.')"></div><div class="content"><h3>'.get_the_title().'</h3><span>'.get_the_time('M jS, Y').'</span></div></a></li>';
            endwhile;
            wp_reset_postdata();
            echo '</ul></div>';
        }
        echo wp_kses_post($after_widget);
    }

    public function form($instance){
        $defaults = array(
            'title'=>'Most Recent Posts'
        );
        
        $instance = wp_parse_args((array)$instance,$defaults); ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php _e('Title:','phase')?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']);?>" type="text"/>
            <br>
            <br>
            <label for="<?php echo esc_attr($this->get_field_id('category'));?>"><?php _e('Show Posts from Specific Category (slug):','phase')?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('category'));?>" name="<?php echo esc_attr( $this->get_field_name('category')); ?>" value="<?php echo esc_attr($instance['category']);?>" type="text"/>
            <br>
            <br>
            <label for="<?php echo esc_attr($this->get_field_id('amount'));?>"><?php _e('Amount of Posts:','phase')?></label>
            <input id="<?php echo esc_attr($this->get_field_id('amount'));?>" name="<?php echo esc_attr( $this->get_field_name('amount')); ?>" value="<?php echo esc_attr($instance['amount']);?>" type="number" min="0" size="2"/>
        </p>
        
    <?php
    }
    public function update($new_instance,$old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = strip_tags($new_instance['category']);
        $instance['amount'] = strip_tags($new_instance['amount']);
        return $instance;
    }
}

?>