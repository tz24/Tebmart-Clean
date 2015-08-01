<?php
/* begin column layouts */
function theme_shortcode_column($atts, $content = null, $code) {
   return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}

function theme_shortcode_column_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_half',     'theme_shortcode_column');
add_shortcode('one_third',    'theme_shortcode_column');
add_shortcode('one_fourth',   'theme_shortcode_column');
add_shortcode('one_fifth',    'theme_shortcode_column');
add_shortcode('one_sixth',    'theme_shortcode_column');
add_shortcode('two_third',    'theme_shortcode_column');
add_shortcode('two_fifth',    'theme_shortcode_column');
add_shortcode('three_fifth',  'theme_shortcode_column');
add_shortcode('three_fourth', 'theme_shortcode_column');
add_shortcode('four_fifth',   'theme_shortcode_column');
add_shortcode('five_sixth',   'theme_shortcode_column');
add_shortcode('one_half_last',      'theme_shortcode_column_last');
add_shortcode('one_third_last',     'theme_shortcode_column_last');
add_shortcode('one_fourth_last',    'theme_shortcode_column_last');
add_shortcode('one_fifth_last',     'theme_shortcode_column_last');
add_shortcode('one_sixth_last',     'theme_shortcode_column_last');
add_shortcode('two_third_last',     'theme_shortcode_column_last');
add_shortcode('two_fifth_last',     'theme_shortcode_column_last');
add_shortcode('three_fifth_last',  'theme_shortcode_column_last');
add_shortcode('three_fourth_last',  'theme_shortcode_column_last');
add_shortcode('four_fifth_last',    'theme_shortcode_column_last');
add_shortcode('five_sixth_last',    'theme_shortcode_column_last');
/* end column layouts */


/* begin button */
function theme_shortcode_button($atts, $content = null, $code){

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'size' => 'normal',
		'link' => '',
		'target' => '',
		'color' => 'green',
		'bgcolor' => '',
		'textcolor' => '',
		'bghover' => '',
		'bghovertext' => '',
		/* 'width' => false, */
		/* 'full' => "false", */
		'align' => false,
		/* 'button' => "false", */
		/* 'nofollow' => "false", */
	), $atts));

   $id         = $id?' id="'.$id.'"':'';
   $class      = $class?' '.$class:'';
   $align      = $align?' align'.$align:'';
   $color      = ($color && !$bgcolor)?' '.$color:'';
   $target     = $target?' target="'.$target.'"':'';

   $bghover = $bghover?($bgcolor?' data-bgcolor="'.$bgcolor.'"':'').' data-bghover="'.$bghover.'"':'';
   $bghovertext = $bghovertext?($textcolor?' data-textcolor="'.$textcolor.'"':'').' data-bghovertext="'.$bghovertext.'"':'';

   $bgcolor    = $bgcolor?' style="background-color:'.$bgcolor.'"':'';
	$textcolor  = $textcolor?' style="color:'.$textcolor.';"':'';

   return '<a'.$id.$target.$bghover.$bghovertext.' class="cs-button '.$size.$color.$class.$align.'" href="'.$link.'" '.$bgcolor.'><span'.$textcolor.'>'.do_shortcode(trim($content)).'</span></a>';

}
add_shortcode('button', 'theme_shortcode_button');
/* end button */


/* begin clear */
function theme_shortcode_clear($atts, $content = null, $code) {
	return '<div class="clear"></div>';
}
add_shortcode('clr',    'theme_shortcode_clear');
add_shortcode('clear',  'theme_shortcode_clear');
/* end clear */


/* begin space */
function theme_shortcode_space($atts, $content = null, $code) {
	return '<div class="space'.str_replace('space','',$code).'"></div>';
}
add_shortcode('space5',  'theme_shortcode_space');
add_shortcode('space10',  'theme_shortcode_space');
add_shortcode('space20',  'theme_shortcode_space');
add_shortcode('space30',  'theme_shortcode_space');
add_shortcode('space40',  'theme_shortcode_space');
add_shortcode('space50',  'theme_shortcode_space');
add_shortcode('space100',  'theme_shortcode_space');
/* end space */


/* begin textcenter */
function theme_shortcode_center($atts, $content = null, $code) {
	return '<div class="textcenter">'.do_shortcode($content).'</div>';
}
add_shortcode('textcenter',    'theme_shortcode_center');
add_shortcode('center',    'theme_shortcode_center');
/* end textcenter */



/* begin aligns */
function theme_shortcode_align($atts, $content = null, $code) {
	return '<div class="'.$code.'">'.do_shortcode($content).'</div>';
}
add_shortcode('aligncenter',    'theme_shortcode_align');
add_shortcode('alignleft',    'theme_shortcode_align');
add_shortcode('alignright',    'theme_shortcode_align');
/* end aligns */


/* begin alertbox */
function theme_shortcode_alertbox($atts, $content = null, $code) {

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'color'  => 'gray',
		'bgcolor' => false,
		'bordercolor' => false,
		'textcolor' => false,
		'icon' => false,
		'icon_size' => 32,
		'hide' => false
	), $atts));

	$close = $hide ? '<a href="#" class="box-hide">x</a>':'';
	$ico = $icon ? ' box-icon'.$icon_size:'';
	$icon_src	= $icon?'background-image:url('.T_URI.'/images/icons/colored_icons/'.$icon_size.'/'.$icon.'_'.$icon_size.'.png);':'';
	$bgcolor = $bgcolor ? ' background-color:'.$bgcolor.' !important;':'';
	$bordercolor = $bordercolor ? ' border-color:'.$bordercolor.' !important;':'';
	$textcolor = $textcolor ? ' color:'.$textcolor.' !important;':'';

	$style = ($icon_src || $bgcolor || $bordercolor || $textcolor)?' style="'.$icon_src.$bgcolor.$bordercolor.$textcolor.'"':'';

	$id         = $id?' id="'.$id.'"':'';
	$class      = $class?' '.$class:'';

   return '<div'.$id.' class="alert_box box-'.$color.$ico.$class.'"'.$style.'>'.$close.do_shortcode($content).'<div class="clear"></div></div>';

}
add_shortcode('alertbox',    'theme_shortcode_alertbox');




/* begin stylebox */
function theme_shortcode_stylebox($atts, $content = null, $code) {

   extract(shortcode_atts(array(
	'id' => false,
	'class' => false,
	'color'  => 'gray',
	'bgcolor' => false,
	'bordercolor' => false,
	'textcolor' => false,
	'icon' => false,
	'icon_size' => 32,
	'hide' => false
	), $atts));

	$bgcolor = $bgcolor ? ' background-color:'.$bgcolor.' !important;':'';
	$bordercolor = $bordercolor ? ' border-color:'.$bordercolor.' !important;':'';
	$textcolor = $textcolor ? ' color:'.$textcolor.' !important;':'';

	$style = ($bgcolor || $bordercolor || $textcolor)?' style="'.$bgcolor.$bordercolor.$textcolor.'"':'';

	$close = $hide ? '<a href="#" class="box-hide">x</a>':'';
	$icon_start = $icon ? '<span class="icon" style="background-image:url('.T_URI.'/images/icons/colored_icons/'.$icon_size.'/'.$icon.'_'.$icon_size.'.png);">':'';
	$icon_end   = $icon ? '</span>':'';


	$id         = $id?' id="'.$id.'"':'';
	$class      = $class?' '.$class:'';

   return '<div'.$id.' class="style_box style-'.$color.$class.'"'.$style.'>'.$close.$icon_start.do_shortcode($content).$icon_end.'<div class="clear"></div></div>';

}
add_shortcode('stylebox',    'theme_shortcode_stylebox');
/* end stylebox */





/* begin ul_list */
function theme_shortcode_ul_list($atts, $content = null, $code) {

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'icon' => '',
	), $atts));


	$id         = $id?' id="'.$id.'"':'';
	$class      = $class?' '.$class:'';
	$icon		= $icon?'ul_list '.$icon:'';
	$content = str_replace('<ul>', '<ul'.$id.' class="'.$icon.$class.'">', $content);
	return	$content;

}
add_shortcode('ul_list',    'theme_shortcode_ul_list');
/* end ul_list */




/* begin ul_list */
function theme_shortcode_frame($atts, $content = null, $code) {

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'title' => '',
		'align' => 'left',
		'video' => false,
		'border' => false,
		'icon' => false,
		'link' => '',
		'target' => '',
		'caption' => ''
	), $atts));


	$id         = $id?' id="'.$id.'"':'';
	$class      = $class?' '.$class:'';
   $title        = $title?' title="'.$title.'"':'';

   $align         = ($align && !$video)?'align'.$align:'';
   $border        = ($border)?' imageborder':'';
   $target_link   = ($target)?' target="'.$target.'"':'';
   $target_link   = ($target == "_lightbox")?' rel="prettyPhoto"'.$title:$target_link;
   $icon          = ($icon)?' class="icon_'.$icon.'"':'';
   $caption       = ($caption)?'<span class="caption">'.$caption.'</span>':'';

   if( $link ){
      $content = '<div'.$id.' class="'.$align.$border.$class.'"><a href="'.$link.'"'.$target_link.$icon.'>'.trim(do_shortcode($content)).'</a>'.$caption.'</div>';
	}else{
      $content = '<div'.$id.' class="'.$align.$border.$class.'">'.do_shortcode($content).$caption.'</div>';
   }

   return $content;

}
add_shortcode('frame',    'theme_shortcode_frame');
/* end ul_list */


/* begin dropcap */
function theme_shortcode_dropcap($atts, $content = null, $code) {

   extract(shortcode_atts(array(
      'character' => false,
      'color' => false
	), $atts));
   $color     = ($color)?'dropcircle dc-'.$color:'dropcap';
   $content = '<span class="'.$color.'">'.$character.'</span>';
   return $content;
}
add_shortcode('dropcap',    'theme_shortcode_dropcap');
/* end dropcap */


/* begin blockquote */
function theme_shortcode_blockquote($atts, $content = null, $code) {

   extract(shortcode_atts(array(
      'cite' => '',
      'align' => ''
	), $atts));

	$cite		= ($cite)?'<cite>'.$cite.'</cite>':'';
	$class	= ($align)?' class="bquote-'.$align.'"':'';

   $content = '<blockquote'.$class.'>'.do_shortcode($content).$cite.'</blockquote>';

   return $content;

}
add_shortcode('blockquote',    'theme_shortcode_blockquote');
/* end blockquote */


/* begin pullquote */
function theme_shortcode_pullquote($atts, $content = null, $code) {

   extract(shortcode_atts(array(
      'cite' => '',
      'align' => ''
	), $atts));

   $cite       = ($cite)?'<cite>'.$cite.'</cite>':'';
   $align      = ($align)?'-'.$align:'';

   $content = '<blockquote class="pquote'.$align.'">'.do_shortcode($content).$cite.'</blockquote>';

   return $content;

}
add_shortcode('pullquote',    'theme_shortcode_pullquote');
/* end blockquote */


/* begin accordion_group */
function theme_shortcode_accordion_group($atts, $content = null, $code) {

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false
	), $atts));

   /*
      $id         = $id?' id="'.$id.'"':'';
      $class      = $class?' '.$class:'';
   */
   $content = '<div class="accordion">'.do_shortcode($content).'</div>';

   return $content;

}
add_shortcode('accordion_group',    'theme_shortcode_accordion_group');
/* end accordion_group */


/* begin accordion_group */
function theme_shortcode_accordion($atts, $content = null, $code) {

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
      'title' => ''
	), $atts));

   /*
      $id         = $id?' id="'.$id.'"':'';
      $class      = $class?' '.$class:'';
   */
   $content = '<h5><span>'.$title.'</span></h5><div class="accordion_content">'.do_shortcode($content).'</div><div class="clear"></div>';

   return $content;

}
add_shortcode('accordion',    'theme_shortcode_accordion');
/* end accordion */



/* begin accordion_group */
function theme_shortcode_toggle($atts, $content = null, $code) {

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'title' => ''
	), $atts));

   /*
      $id         = $id?' id="'.$id.'"':'';
      $class      = $class?' '.$class:'';
   */
   $content = '<div class="toggle_container"><h5 class="toggle"><a>'.$title.'</a></h5><div class="toggle_content">'.do_shortcode($content).'</div></div>';

   return $content;

}
add_shortcode('toggle',    'theme_shortcode_toggle');
/* end accordion */


/* begin tabs */
function theme_shortcode_tabs($atts, $content = null, $code) {

   global $tab_array;
   $tab_array = array();

   extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
      'model' => 1
	), $atts));

   do_shortcode($content);

   $tabs = '<div class="tab tab_model_'.$model.'">';

   $tabs .= '<ul class="tab_button">';
   foreach ($tab_array as $tab => $tab_attr_array) {
      $tabs .= "<li><a href=\"javascript:void(0);\">".$tab_attr_array['title']."</a></li>";
   }
   $tabs .= '</ul>';

   $tabs .= '<ul class="tab_content">';
   foreach ($tab_array as $tab => $tab_attr_array) {
      $tabs .= "<li>".$tab_attr_array['content']."</li>";
   }
   $tabs .= '</ul>';

   $tabs .= "</div>";

   return  $tabs;

}
add_shortcode('tabs',    'theme_shortcode_tabs');
/* end tabs */



/* begin tabs */
function theme_shortcode_tab($atts, $content = null, $code) {

   extract(shortcode_atts(array(
      'title'      => '',
   ), $atts));
   global $tab_array;
   $tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
   return $tab_array;

}
add_shortcode('tab',    'theme_shortcode_tab');
/* end tabs */


/* begin highlight */
function theme_shortcode_highlight($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'type' => 1,
      'bgcolor' => '',
      'textcolor' => '',
      'bordercolor' => ''
   ), $atts));

   $bgcolor    = $bgcolor?'background-color:'.$bgcolor.';':'';
   $textcolor    = $textcolor?'color:'.$textcolor.';':'';
   $bordercolor    = $bordercolor?'border-color:'.$bordercolor.';':'';
   $style   = ($bgcolor || $textcolor || $bordercolor) ? ' style="'.$bgcolor.$textcolor.$bordercolor.'"':'';

	return '<span class="highlight-'.$type.'"'.$style.'>'.do_shortcode($content).'</span>';


}
add_shortcode("highlight", "theme_shortcode_highlight");
/* end highlight */


/* begin flickr */
function theme_shortcode_flickr($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'count' => 6,
		'size' => 's',
		'layout' => 'h',
		'display' => 'latest',
		'user' => '52617155@N08'
	), $atts));

	return '<div class="flickr_widget"><script src="http://www.flickr.com/badge_code_v2.gne?count='.$count.'&display='.$display.'&size='.$size.'&layout='.$layout.'&source=user&user='.$user.'" type="text/javascript"></script></div>';

}
add_shortcode("flickr", "theme_shortcode_flickr");
/* end flickr */



/* begin iconcolor */
function theme_shortcode_iconcolor($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'alt' => '',
		'icon' => '',
      'size' => 32,
      'align' => ''
   ), $atts));

   $align      = $align?' align'.$align:'';
   $alt        = $alt?' alt="'.$alt.'"':'';

   return '<img src="'.T_URI.'/images/icons/colored_icons/'.$size.'/'.$icon.'_'.$size.'.png" class="middle'.$align.'"'.$alt.'>';

}
add_shortcode("iconcolor", "theme_shortcode_iconcolor");
/* end iconcolor */


/* begin iconsweet */
function theme_shortcode_iconsweet($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'alt' => '',
		'icon' => '',
      'size' => 32,
      'align' => '',
      'color' => 'black'
   ), $atts));

   $align      = $align?' align'.$align:'';
   $alt        = $alt?' alt="'.$alt.'"':'';

	return '<img src="'.T_URI.'/images/icons/iconsweets/'.$color.'/'.$size.'/'.$icon.'.png" class="middle'.$align.'"'.$alt.'>';

}
add_shortcode("iconsweet", "theme_shortcode_iconsweet");
/* end iconsweet */


/* begin iconcircle */
function theme_shortcode_iconcircle($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'alt' => '',
		'icon' => '',
		'align' => '',
		'bgcolor' => 'blue'
	), $atts));

	$align      = $align?' align'.$align:'';
	$alt        = $alt?' alt="'.$alt.'"':'';
	return '<div class="circle-icon c-'.$bgcolor.$align.'"><img src="'.T_URI.'/images/icons/iconsweets/white/32/'.$icon.'.png"'.$alt.'></div>';

}
add_shortcode("iconcircle", "theme_shortcode_iconcircle");
/* end iconcircle */




/* begin iconborder */
function theme_shortcode_iconborder($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'alt' => '',
		'icon' => '',
		'align' => '',
		'iconcolor' => 'black',
		'bordercolor' => 'blue'
   ), $atts));

   $align      = $align?' align'.$align:'';
   $alt        = $alt?' alt="'.$alt.'"':'';
	return '<div class="ci-icons ci-'.$bordercolor.$align.'"><img src="'.T_URI.'/images/icons/iconsweets/'.$iconcolor.'/32/'.$icon.'.png"'.$alt.'></div>';

}
add_shortcode("iconborder", "theme_shortcode_iconborder");
/* end iconborder */



/* begin tooltip */
function theme_shortcode_tooltip($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'position' => 'up',
		'container' => 'span',
      'title' => ''
   ), $atts));

   $isclass = strpos($content,"class");
   /* $istag   = strpos($content,"</"); */

   if($isclass){
      return preg_replace(array('/class="(.*?)"/i'), 'class="$1 tip_'.$position.'" title="'.$title.'"', do_shortcode($content), 1);
   }/* else if($istag){
      return preg_replace(array('/^<(.*?)>/i'), '<$1 class="tip_'.$position.'" title="'.$title.'">', do_shortcode($content), 1);
   } */else {
      return '<'.$container.' class="tip_'.$position.'" title="'.$title.'">'.do_shortcode($content).'</'.$container.'>';
   }


}
add_shortcode("tooltip", "theme_shortcode_tooltip");
/* end tooltip */


/* begin top */
function theme_shortcode_divider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'top' => false
	), $atts));

   $top = $top?'<a class="top">'.__('[top]', T_NAME).'</a>':'';
   $class = $top?'top':'hr';

   return '<div class="clear"></div><div class="divider_'.$class.'">'.$top.'</div>';
}
add_shortcode('divider',    'theme_shortcode_divider');
/* end top */



/* begin textpos */
function theme_shortcode_textpos($atts, $content = null, $code) {
	return '<div class="'.$code.'">'.do_shortcode($content).'</div>';
}
add_shortcode('textleft',    'theme_shortcode_textpos');
add_shortcode('textcenter',   'theme_shortcode_textpos');
add_shortcode('textright',    'theme_shortcode_textpos');
/* end textpos */


/* begin cycle */
function theme_shortcode_cycle($atts, $content=null, $code){

	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'effect' => 'fade',
      'delay' => 5,
      'speed' => 500,
      'nav' => false
   ), $atts));

   $output      = '<div class="cycle-ticker">';

   if($nav):
   $output     .= '<div class="cycle-ticker-nav">';
   $output     .= '<a href="#" class="cycle-prev">prev</a><a href="#" class="cycle-next">next</a>';
   $output     .= '</div>';
   endif;

   $output     .= '<div class="cycle-wrap">';
   $output     .= '<div class="cycle-ticks" data-fx="'.$effect.'" data-delay="'.$delay.'000" data-speed="'.$speed.'">';

   $output     .= do_shortcode($content);

   $output     .= '</div>';
   $output     .= '</div>';
   $output     .= '</div>'; /* end of cycle ticker div*/


	return $output;

}
add_shortcode("cycle", "theme_shortcode_cycle");
/* end cycle */



/* begin code */
function theme_shortcode_precode($atts, $content = null, $code) {
$content = do_shortcode($content);
$html = '<pre><code>'.$content.'
</code></pre>';
	return $html;
}
add_shortcode('precode',    'theme_shortcode_precode');
/* end code */


/* begin top */
function theme_shortcode_posts($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'limit' => 5,
		'length_title' => 50,
		'length_desc' => 80,
		'display' => 'description',
		'thumbnail' => false,
		'size' => 65,
		'categories' => 0,
		'type' => 'recent'
	), $atts));

	$listclass = ($thumbnail)?'recent':'recent_list';
	$orderby = ($type=='recent')?'date':'comment_count';
   	$query = array('cat'=>$categories, 'showposts' => $limit, 'nopaging' => 0, 'orderby'=> $orderby, 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1);

	if( $type == 'releated' ){
		global $post;
		$tags = wp_get_post_tags($post->ID);
		$tagIDs = array();

		if ($tags) {

			$tagcount = count($tags);
			for ($i = 0; $i < $tagcount; $i++) {
				$tagIDs[$i] = $tags[$i]->term_id;
			}
			$query = array('tag__in' => $tagIDs,'post__not_in' => array($post->ID),'showposts' => $limit, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		}
	}

	$q = new WP_Query($query);
	if ($q->have_posts()) :
	$output  = '';
	$output .= '<ul class="'.$listclass.'">';



	/* start while */
	while ($q->have_posts()) : $q->the_post();
	$output .= '<li>';
	if ( has_post_thumbnail() && $thumbnail == true):
	$output	.= '<a href="'.get_permalink().'" title="'.sprintf( __("Permanent Link to %s", T_NAME), get_the_title() ).'">';
	$output	.= get_the_post_thumbnail(get_the_id(),array($size,$size),array('title'=>get_the_title(),'alt'=>get_the_title(),'class'=>'imageborder alignleft'));
	$output	.= '</a>';
	endif;

	$output	.= '<div class="posts_content">';
	$output	.= '<a href="'.get_permalink().'" title="'.sprintf( __("Permanent Link to %s", T_NAME), get_the_title() ).'">';
	$output	.= wp_html_excerpt (get_the_title(), $length_title );
	$output	.= '</a>';

	if($display == 'both' || $display == 'time'){
		$output	.= '<br /><small>('.get_the_date().')</small>';
	}

	if($display == 'both' || $display == 'description'){

	$excerpt = get_the_excerpt();
	$output	.= ($excerpt)?'<p>'.wp_html_excerpt($excerpt,$length_desc).'...</p>':'';

	}

	$output	.= '</div>';
	$output .= '</li>';
	endwhile;
	wp_reset_query();
	/* end while */



	$output .= '</ul>';
	endif;

	return $output;

}
add_shortcode('posts',    'theme_shortcode_posts');
/* end top */




/* begin blog */
function theme_shortcode_blog($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'cat' => '',
		'columns' => 1,
		'count' => 10,
		'pagenavi' => false,
		'meta' => false,
		'desc' => false,
		'more' => false,
		'layout' => '',
		'height' => '',
		'width' => '',
		'paged' => '',
	), $atts));

	$featured_layout = ($layout)?$layout:'';


	$pagenavi = ($pagenavi==1)?true:false;

	ob_start();

	$columns           = ($columns)?(int)$columns:1;

	$post_id = get_the_id();
	$options = get_post_meta($post_id, '_post_options', true);
	$layout =  @$options["sidebar"];

	/* calc grid columns */
	$page_layout = '';
	if ( $columns != 1 ) {
		if( $layout == 'full' || empty( $layout ) ){
			$page_layout = floor((920-25*($columns-1))/$columns);
		}else{
			$page_layout = floor((606-25*($columns-1))/$columns);
		}
	}else{

		if( $layout == 'full' || empty( $layout ) ){
			$page_layout = 948;
		}else{
			$page_layout = 618;
		}

	}

	if( !empty($width)){
		$page_layout = $width;
	}



	/* set columns class */
	$class = array('','half','third','fourth','fifth','sixth');
	$css = $class[$columns-1];


	/* fix paged on frontpage and homepage */
	if ($pagenavi == true ) {
		if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){
			$paged = ( get_query_var('paged') ) ? intval(get_query_var('paged')) : intval( get_query_var('page') );
		}else{
			$paged = intval(get_query_var('paged'));
		}
	}
	
	$sortby	= @$_GET['sortby'];
	if( isset($sortby) ){
		$idObj	= get_category_by_slug($sortby); 
		$id		= $idObj->term_id;
		$cat		= $id;
	}

	$query = array(
		'cat' => $cat,
		'posts_per_page' => $count,
		'paged' => $paged,
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1
	);

	$q = new WP_Query($query);
	if ($q->have_posts()) :

	/* start while */
	$i = 0;
	while ($q->have_posts()) : $q->the_post();

		$i++;
		if ($columns != 1) {
		   if ($i%$columns !== 0) {
			  echo "<div class=\"one_{$css}\">";
		   } else {
			  echo "<div class=\"one_{$css} last\">";
		   }
		}
		?>
		<div class="post-wrapper">
			<h2 class="post-title"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php the_title(); ?></a></h2>
			<?php if($meta == 1){ ?>
			<p class="post-meta"><?php echo get_theme_generator('post_meta'); ?></p>
			<?php } ?>
			<?php  echo get_theme_generator("blog_featured_image", $page_layout, $featured_layout, $height); ?>

			<?php if($desc == 1){ ?>
			<div class="post-content">
			<?php
			if(get_theme_option('blog','blog_full_text') == "on"){
				global $more;
				$more = 0;
				the_content( get_theme_option('blog', 'blog_read_more'), true);
			}else{
				the_excerpt();

				if($more == 1){
			?>
			<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>" class="cs-button <?php echo get_theme_option('advanced', 'button_color').' '.get_theme_option('advanced', 'button_size'); ?>"><span><?php echo get_theme_option('blog', 'blog_read_more'); ?></span></a>
			<?php }	} ?>
			</div>
			<?php }	?>
		</div>
		<?php
		if ($columns != 1) {
               echo '</div>';


               if ($i%$columns === 0) {
                  echo "<div class=\"clear\"></div>";
               }

        }
	endwhile;

	if(function_exists('wp_pagenavi') && $pagenavi == true ) {
		wp_pagenavi( array('query'=>$q));
	}

	wp_reset_postdata();
	wp_reset_query();
	/* end while */

	endif;

	$output = ob_get_clean();

	return $output;

}
add_shortcode('blog',    'theme_shortcode_blog');
/* end blog */




/* begin portfolio */
function theme_shortcode_portfolio($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'cat' => '',
		'columns' => 3,
		'count' => 10,
		'pagenavi' => 1,
		'desc' => '',
		'ptitle' => 0,
		'linking' => 0,
		'more' => '',
		'height' => '',
		'width' => '',
		'paged' => '',
	), $atts));

	$pagenavi = ($pagenavi==1)?true:false;

	ob_start();

	$image_height		 = '';
	$columns           = ($columns)?(int)$columns:1;

	$post_id = get_the_id();
	$options = get_post_meta($post_id, '_post_options', true);
	$layout =  @$options["sidebar"];

	/* calc grid columns */
	$page_layout = '';
	if ($columns != 1) {
		if( $layout == 'full' || empty($layout) ){
			$page_layout = floor((960-57*($columns-1))/$columns);
		}else{
			$page_layout = floor((630-43*($columns-1))/$columns);
		}
	} else if ($columns == 1 ) {
		if( $layout == 'full' || empty($layout) ){
			$page_layout = floor((960-57)/2);
		}else{
			$page_layout = floor((630-43)/2);
		}
	}

	if( !empty($width)){
		$page_layout = $width;
	}

	if( !empty($height)){
		$image_height = $height;
	}

	/* set columns class */
	$class = array('','half','third','fourth','fifth','sixth');
	$css = $class[$columns-1];


	/* fix paged on frontpage and homepage */
	if ($pagenavi == true ) {
		if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){
			$paged = ( get_query_var('paged') ) ? intval(get_query_var('paged')) : intval( get_query_var('page') );
		}else{
			$paged = intval(get_query_var('paged'));
		}
	}

	$sortby	= @$_GET['sortby'];
	
	if( isset($sortby) ){
		$idObj	= get_category_by_slug($sortby); 
		$id		= $idObj->term_id;
		$cat		= $id;
	}
		
	$query = array(
		'cat' => $cat,
		'posts_per_page' => $count,
		'paged' => $paged,
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1
	);

	$q = new WP_Query($query);
	if ($q->have_posts()) :

	/* start while */
	$i = 0;
	echo '<div class="portfolio-wrap">';
	while ($q->have_posts()) : $q->the_post();

		$i++;
		if ($columns != 1) {
		   if ($i%$columns !== 0) {
			  echo "<div class=\"one_{$css}\">";
		   } else {
			  echo "<div class=\"one_{$css} last\">";
		   }
		}
      
		echo ($columns == 1)?'<div class="post-wrapper"><div class="one_half">':'';
		echo get_theme_generator("portfolio_featured_image", $page_layout, $columns, $image_height);
		echo ($columns == 1)?'</div><div class="one_half last one_title">':'';

      if($ptitle == 1){?><h2 class="post-title"><?php if($linking == 1){?><a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php } ?><?php the_title(); ?><?php if($linking == 1){?></a><?php } ?></h2><?php } ?>
      <?php if($desc == 1){ ?><div class="post-content"><?php
      if(get_theme_option('portfolio','portfolio_full_text') == "on"){
         global $more;
         $more = 0;
         the_content( get_theme_option('portfolio', 'portfolio_read_more_text'), true);
      }else{
         the_excerpt();

         if($more == 1){
      ?><a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>" class="cs-button <?php echo get_theme_option('advanced', 'button_color').' '.get_theme_option('advanced', 'button_size'); ?>"><span><?php echo get_theme_option('portfolio', 'portfolio_read_more_text'); ?></span></a><?php }	} ?></div><?php }	?><?php
      echo ($columns == 1)?'</div></div>':'';

		if ($columns != 1) {

			echo '</div>';

			if ($i%$columns === 0) {
				echo '<div class="clear space20"></div>';
			}

		}
	endwhile;
	echo '</div>';

	if(function_exists('wp_pagenavi') && $pagenavi == true ) {
		wp_pagenavi( array('query'=>$q));
	}

	wp_reset_postdata();
	wp_reset_query();
	/* end while */

	endif;

	$output = ob_get_clean();

	return $output;

}
add_shortcode('portfolio',    'theme_shortcode_portfolio');
/* end portfolio */


/* begin slider */
function theme_shortcode_slider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => ''
	), $atts));

	return get_theme_generator("slideshow", $id, true);
}
add_shortcode('slider',    'theme_shortcode_slider');
/* end slider */


/* begin contact */
function theme_shortcode_contact($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'to' => get_bloginfo('admin_email'),
		'recaptcha' => '',
		'error' => '',
	), $atts));

	$content = trim($content);
	if(!empty($content)){
		$success = do_shortcode($content);
	}

	if( empty($success) ){
		$success = __('Your message was successfully sent. <strong>Thank You!</strong>', T_NAME);
	}

	$name_str			= __('Name *', T_NAME);
	$email_str			= __('Email *', T_NAME);
	$message_str		= __('Message *', T_NAME);
	$submit_str			= __('Submit', T_NAME);
	$form_action		= T_URI.'/'.F_REQ.'/sendmail.php';
	$id					= rand(1,999);
	$to					= base64_encode( $to );
	$button_color		= get_theme_option('advanced', 'button_color');
	$button_size		= get_theme_option('advanced', 'button_size');
	$recaptcha_html	= '';
	$recaptcha_error	= '';

	if( $recaptcha == '1' ){

		if( !function_exists ('_recaptcha_qsencode') ){
			require_once ( T_PATH .'/'. F_REQ . "/plugins/recaptcha/recaptchalib.php" );
		}

		$publickey 			= get_theme_option('advanced', 'recaptcha_public_key');
		$privatekey			= get_theme_option('advanced', 'recaptcha_private_key');
		$recaptcha_html	= '<script type="text/javascript">var RecaptchaOptions = {theme : \''. get_theme_option('advanced', 'recaptcha_skin') .'\'};</script><div class="recaptcha" data-recaptcha="true">'.recaptcha_get_html($publickey, $error).'<div class="error-recaptcha" style="display:none;">'.get_theme_option('advanced', 'recaptcha_error').'</div></div>';
	}

$html = '<div class="form_wrap">
<div class="error" style="display:none;">'.$error.'</div>
<div class="success" style="display:none;">'.$success.'</div>
<form id="sendmail_'.$id.'" class="sendform" action="'.$form_action.'" method="post">
<p><label for="field_'.$id.'_name">'.$name_str.'</label><input type="text" id="field_'.$id.'_name" name="field_'.$id.'_name"  value="" required="required"/></p>
<p><label for="field_'.$id.'_email">'.$email_str.'</label><input type="email" id="field_'.$id.'_email" name="field_'.$id.'_email"  value="" required="required"/></p>
<p><label for="field_'.$id.'_message">'.$message_str.'</label><textarea id="field_'.$id.'_message" name="field_'.$id.'_message" class="textarea" cols="50" rows="10" required="required"></textarea></p>'.$recaptcha_html.'
<p><a href="#" onclick="jQuery(\'#sendmail_'.$id.'\').submit(); return false;" class="cs-button '.$button_color.' '.$button_size.'"><span>'.$submit_str.'</span></a><input type="hidden" value="'.$id.'" name="form_id"/><input type="hidden" value="'.$to.'" name="field_'.$id.'_to"/></p>
</form></div>';

	return $html;

}
add_shortcode('contact',    'theme_shortcode_contact');
/* end contact */


/* begin social */
function theme_shortcode_social($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'icon' => '',
		'link' => '',
		'target' => '',
		'colored' => false,
		'popup' => ''
	), $atts));

	$target	= $target?' target="'.$target.'"':'';
	$class	= $colored?'nt-icon-color':'nt-icon';

	$out	= '<a href="'.$link.'" class="'.$class.' '.$icon.' tip_down" title="'.$popup.'"'.$target.'>'.$icon.'</a>';

   return $out;
}
add_shortcode('social',    'theme_shortcode_social');
/* end social */


/* begin search */
function theme_shortcode_search($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => '',
		'width' => '',
		'text' => 'Search...'
	), $atts));

	$css	 	 = $width?' style="width:'.$width.'px;"':'';
	$output	 = '<form action="'.esc_url( home_url( '/' ) ).'" id="searchform" method="get"'.$css.'>';
	$output	.= '<div>';
	$output	.= '<input type="text" id="s" name="s" value="'.$text.'"/>';
	$output	.= '<input type="submit" value="'.$text.'" id="searchsubmit">';
	$output	.= '</div>';
	$output	.= '</form>';

	return $output;
}
add_shortcode('search',    'theme_shortcode_search');
/* end search */


/* begin sortby */
function theme_shortcode_sortby($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => '',
		'text' => '',
		'skin' => 'green',
	), $atts));
	
	ob_start();
	$sortby	= @$_GET['sortby'];
	$current	= (!$sortby)?' class="current"':'';
	
	echo '<ul id="sortby" class="sortby-'.$skin.'">';
	echo ($text)?'<li><span>'.$text.'</span></li>':'';
	echo '<li><a href="'.get_permalink().'" title="'.__( "View all posts" ).'"'.$current.'>All<span></span></a></li>';

	$args=array(
	  'orderby' => 'name',
	  'order' => 'ASC',
	  'child_of' => $id
	);
	$categories=get_categories($args);
	foreach($categories as $category) {
		$current = ($sortby==$category->slug)?' class="current"':'';
		echo '<li><a href="'.get_permalink().'?sortby=' . $category->slug . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' .$current. '>' . $category->name.'<span></span></a></li>';
	}
	
	echo '</ul><div class="clear"></div>';
	
	return ob_get_clean();
}
add_shortcode('sortby',    'theme_shortcode_sortby');
/* end sortby */



/* begin sortby */
function theme_shortcode_display($atts, $content = null, $code) {

	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
   
   $out = '<div class="display_'.$type.'">'.do_shortcode($content).'</div>';
	return $out;
}
add_shortcode('display', 'theme_shortcode_display');
/* end sortby */

/* begin clear */
function current_year($atts, $content = null, $code) {
	return date('Y');
}
add_shortcode('current_year',    'current_year');
/* end clear */