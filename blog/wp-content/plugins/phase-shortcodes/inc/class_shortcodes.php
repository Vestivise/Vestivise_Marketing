<?php

class Phase_Shortcodes{


	/*  Init Shortcodes Functions  */

	public function __construct(){
		add_shortcode('clear',array($this,'clear_shortcode'));
		add_shortcode('button',array($this,'button_shortcode'));
		add_shortcode('highlight',array($this,'highlight_shortcode'));
		add_shortcode('alert',array($this,'alert_shortcode'));
		add_shortcode('toggle',array($this,'toggle_shortcode'));
		add_shortcode('tabs',array($this,'tabs_shortcode'));
		add_shortcode('tab',array($this,'tab_shortcode'));
	}

	/*  Clear  */

	public function clear_shortcode($atts){
		return '<div class="clear vertical-space-20"></div>';
		}

	/*  Buttons  */

	public function button_shortcode($atts,$content = null ){
	    
		$defaults = array(
			'url'		=> '#',
 			'target'	=> 'blank',
			'color'		=> 'black',
			'type'      => 'square',
			'size'      => 'medium',
	    );

		extract(shortcode_atts($defaults,$atts));
		if($target=='blank'||$target=='_blank'){$target=' target="_blank"';}
		elseif($target=='self'||$target=='_self'){$target=' target="_self"';}
		elseif($target=='parent'||$target=='_parent'){$target=' target="_parent"';}
		elseif($target=='top'||$target=='_top'){$target = ' target="_top"';}
		else{$target='';}
		$output='<a href="'.$url.'" class="phase-button '.$color.' '.$size.' '.$type.' " '.$target.'>'.do_shortcode($content).'</a>';
	    return $output;
		}

	/*  Alerts  */

	public function alert_shortcode($atts,$content=null){

		$defaults = array('color'=>'');
	    extract(shortcode_atts($defaults,$atts));

	   	$class='phase-alert';
	   	$class.=' '.$color;

	   	$output='<div class="'.$class.'">';
	   	$output.=do_shortcode( $content );
	   	$output.='</div>';
		return $output;
		}

	/*  Highlights  */

	public function highlight_shortcode($atts,$content = null){
		$defaults = array('color'=>'yellow','style'=>'normal');
		extract(shortcode_atts($defaults,$atts));
		return '<span class="phase-highlight '.$color.' '.$style.'">'.$content.'</span>';
		}

}