<?php

define('image_placeholder',get_template_directory_uri()."/inc/placeholder.png");

function phase_cover_init(){
    $phase_taxonomies = get_taxonomies();
    if(is_array($phase_taxonomies)){
        $phase_options = get_option('phase_options');
        if(empty($phase_options['excluded_taxonomies']))
            $phase_options['excluded_taxonomies'] = array();
        foreach ($phase_taxonomies as $phase_taxonomy){
            if(in_array($phase_taxonomy,$phase_options['excluded_taxonomies']))
                continue;
            add_action($phase_taxonomy.'_add_form_fields','phase_add_texonomy_field');
            add_action($phase_taxonomy.'_edit_form_fields','phase_edit_texonomy_field');
            add_filter('manage_edit-'.$phase_taxonomy.'_columns','phase_taxonomy_columns');
            add_filter('manage_'.$phase_taxonomy.'_custom_column', 'phase_taxonomy_column',10,3);
        }
    }
}
add_action('admin_init','phase_cover_init');

function phase_add_style(){
    echo '
    <style type="text/css" media="screen">

        th.column-thumb{
            width:60px
            }

        .form-field img.taxonomy-image{
            max-width:300px;
            max-height:300px;
            border:1px solid #eee
            }

        .column-thumb span{
            position:relative;
            display:inline-block;
            width:48px;
            height:48px;
            background:#fff;
            border:1px solid #eee
            }

        .column-thumb span img{
            position:absolute;
            max-width:100%;
            max-height:100%;
            top:50%;
            right:50%;
            -webkit-transform:translate(50%,-50%);
            transform:translate(50%,-50%)
            }

    </style>
    ';
}

function phase_add_texonomy_field(){
    if(get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else{
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }   
    echo '<div class="form-field">
        <label for="taxonomy_image">'.__('Image','phase_surface').'</label>
        <input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
        <br/>
        <button class="phase_upload_image_button button">'.__('Upload/Add image','phase_surface').'</button>
    </div>'.phase_script();
}

function phase_edit_texonomy_field($taxonomy){
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    
    if(phase_taxonomy_image_url($taxonomy->term_id,NULL,TRUE)== image_placeholder){$image_text = '';}
    else{$image_text = phase_taxonomy_image_url($taxonomy->term_id,NULL,TRUE);}

    echo '<tr class="form-field">
        <th scope="row" valign="top"><label for="taxonomy_image">'.__('Image','phase_surface').'</label></th>
        <td><img class="taxonomy-image" src="'.phase_taxonomy_image_url($taxonomy->term_id, NULL, TRUE ).'"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_text.'"/><br/>
        <button class="phase_upload_image_button button">'.__('Upload/Add image','phase_surface').'</button>
        <button class="phase_remove_image_button button">'.__('Remove image','phase_surface').'</button><br/>
        </td>
    </tr>'.phase_script();

}


function phase_script(){
    return '<script type="text/javascript">
        jQuery(document).ready(function($) {
            var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
            $(".phase_upload_image_button").click(function(event) {
                upload_button = $(this);
                var frame;
                if(wordpress_ver >= "3.5"){
                    event.preventDefault();
                    if(frame){
                        frame.open();
                        return;
                    }
                    frame = wp.media();
                    frame.on("select",function(){
                        var attachment = frame.state().get("selection").first();
                        frame.close();
                        if(upload_button.parent().prev().children().hasClass("tax_list")){
                            upload_button.parent().prev().children().val(attachment.attributes.url);
                            upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
                        }
                        else
                            $("#taxonomy_image").val(attachment.attributes.url);
                    });
                    frame.open();
                }
                else{
                    tb_show("","media-upload.php?type=image&amp;TB_iframe=true");
                    return false;
                }
            });
            
            $(".phase_remove_image_button").click(function(){
                $("#taxonomy_image").val("");
                $(this).parent().siblings(".title").children("img").attr("src","'.image_placeholder.'");
                $(".inline-edit-col:input[name=\'taxonomy_image\']").val("");
                return false;
            });

            if(wordpress_ver < "3.5"){
                window.send_to_editor = function(html){
                    imgurl = $("img",html).attr("src");
                    if(upload_button.parent().prev().children().hasClass("tax_list")){
                        upload_button.parent().prev().children().val(imgurl);
                        upload_button.parent().prev().prev().children().attr("src", imgurl);
                    }
                    else{
                        $("#taxonomy_image").val(imgurl);
                        tb_remove();
                    }
                }
            }
            
            $(".editinline").live("click", function(){  
                var tax_id = $(this).parents("tr").attr("id").substr(4);
                var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
                if(thumb != "'.image_placeholder.'"){
                    $(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
                }else{
                    $(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
                }
                $(".inline-edit-col .title img").attr("src",thumb);
                return false;
            });  
        });
    </script>';
}

add_action('edit_term','phase_save_taxonomy_image');
add_action('create_term','phase_save_taxonomy_image');

function phase_save_taxonomy_image($term_id){
    if(isset($_POST['taxonomy_image']))
        update_option('phase_taxonomy_image'.$term_id, $_POST['taxonomy_image']);
}

function phase_get_attachment_id_by_url($image_src){
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src'";
    $id = $wpdb->get_var($query);
    return (!empty($id))?$id:NULL;
}

function phase_taxonomy_image_url($term_id = NULL,$size = NULL,$return_placeholder = FALSE){
    if(!$term_id){
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()){
            $current_term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    $taxonomy_image_url = get_option('phase_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)){
        $attachment_id = phase_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)){
            if (empty($size))
                $size = 'full';
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            $taxonomy_image_url = $taxonomy_image_url[0];
        }
    }
    if($return_placeholder){
        return ($taxonomy_image_url != '') ? $taxonomy_image_url : image_placeholder;
    }
    else{
        return $taxonomy_image_url;
    }
}

function phase_taxonomy_columns($columns){
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = __('Image','phase_surface');
    unset($columns['cb']);
    return array_merge($new_columns,$columns);
}

function phase_taxonomy_column($columns,$column,$id){
    if($column == 'thumb')
        $columns = '<span><img src="'.phase_taxonomy_image_url($id,NULL,TRUE).'" alt="'.__('Thumbnail','phase_surface').'" class="wp-post-image"/></span>';
    return $columns;
}

function phase_change_insert_button_text($safe_text,$text){
    return str_replace("Insert into Post","Use this image",$text);
}

if(strpos($_SERVER['SCRIPT_NAME'],'edit-tags.php') > 0 ){
    add_action('admin_head','phase_add_style');
    add_filter("attribute_escape","phase_change_insert_button_text",10,2);
}

function phase_taxonomy_image($term_id = NULL,$size = 'full',$attr = NULL,$echo = TRUE){
    if(!$term_id){
        if(is_category())
            $term_id = get_query_var('cat');
        elseif(is_tax()){
            $current_term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    
    $taxonomy_image_url = get_option('phase_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)){
        $attachment_id = phase_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)){
            $taxonomy_image = wp_get_attachment_image($attachment_id,$size,FALSE,$attr);
        }
        else{
            $image_attr = '';
            if(is_array($attr)){
                if(!empty($attr['class']))
                    $image_attr.=' class="'.$attr['class'].'" ';
                if(!empty($attr['alt']))
                    $image_attr.=' alt="'.$attr['alt'].'" ';
                if(!empty($attr['width']))
                    $image_attr.=' width="'.$attr['width'].'" ';
                if(!empty($attr['height']))
                    $image_attr.=' height="'.$attr['height'].'" ';
                if(!empty($attr['title']))
                    $image_attr.=' title="'.$attr['title'].'" ';
            }
            $taxonomy_image = '<img src="'.$taxonomy_image_url.'" '.$image_attr.'/>';
        }
    }

    if($echo){
        echo $taxonomy_image;
    }
    else{
        return $taxonomy_image;
    }
}

?>