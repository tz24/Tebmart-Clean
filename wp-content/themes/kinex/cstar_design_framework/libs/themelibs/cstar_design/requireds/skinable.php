<?php
$logo_bottom                           = get_theme_option("general","logo_bottom");
$logo_left                           	= get_theme_option("general","logo_left");
$menu_right                           	= get_theme_option("general","menu_right");
$menu_right                           	= ($menu_right=='0')?'-15':$menu_right;
$header_height                         = get_theme_option("general","header_height");
$custom_css                            = get_theme_option("general","custom_css");

/* header colors */
$header_text_color                     = get_theme_option("color","header_text_color");
$header_link_color                     = get_theme_option("color","header_link_color");
$header_link_hover_color               = get_theme_option("color","header_link_hover_color");
$header_dropdown_link_bg_color         = get_theme_option("color","header_dropdown_link_bg_color");
$header_dropdown_link_color            = get_theme_option("color","header_dropdown_link_color");
$header_dropdown_link_hover_bg_color   = get_theme_option("color","header_dropdown_link_hover_bg_color");
$header_dropdown_link_hover_color      = get_theme_option("color","header_dropdown_link_hover_color");

/* intro content colors */
$intro_text_color                      = get_theme_option("color","intro_text_color");
$intro_link_color                      = get_theme_option("color","intro_link_color");
$intro_link_hover_color                = get_theme_option("color","intro_link_hover_color");
$intro_headers_color                   = get_theme_option("color","intro_headers_color");

/* slider content colors */
$slider_text_color                      = get_theme_option("color","slider_text_color");
$slider_link_color                      = get_theme_option("color","slider_link_color");
$slider_link_hover_color                = get_theme_option("color","slider_link_hover_color");
$slider_headers_color                   = get_theme_option("color","slider_headers_color");
( $slider_text_color != '' )?$slider_text_color='color:'.$slider_text_color.';':'';
( $slider_link_color != '' )?$slider_link_color='color:'.$slider_link_color.';':'';
( $slider_link_hover_color != '' )?$slider_link_hover_color='color:'.$slider_link_hover_color.';':'';
( $slider_headers_color != '' )?$slider_headers_color='color:'.$slider_headers_color.';':'';


/* page content colors */
$page_text_color                      = get_theme_option("color","page_text_color");
$page_link_color                      = get_theme_option("color","page_link_color");
$page_link_hover_color                = get_theme_option("color","page_link_hover_color");
$page_headers_color                   = get_theme_option("color","page_headers_color");
$page_divider_color                   = get_theme_option("color","page_divider_color");


/* footer content colors */
$footer_text_color                      = get_theme_option("color","footer_text_color");
$footer_link_color                      = get_theme_option("color","footer_link_color");
$footer_link_hover_color                = get_theme_option("color","footer_link_hover_color");
$footer_headers_color                   = get_theme_option("color","footer_headers_color");


/* copyright content colors */
$copyright_text_color                      = get_theme_option("color","copyright_text_color");
$copyright_link_color                      = get_theme_option("color","copyright_link_color");
$copyright_link_hover_color                = get_theme_option("color","copyright_link_hover_color");


/* copyright content colors */
$top_text_color                      = get_theme_option("color","top_text_color");
$top_link_color                      = get_theme_option("color","top_link_color");
$top_link_hover_color                = get_theme_option("color","top_link_hover_color");

/* font settings */
$font_family                           = get_theme_option("font","font_family");
$font_size                             = get_theme_option("font","font_size");
$font_line_height                      = get_theme_option("font","font_line_height");

$footer_font_family                    = get_theme_option("font","footer_font_family");
$footer_font_size                      = get_theme_option("font","footer_font_size");

$top_menu_font_size                    = get_theme_option("font","top_menu_font_size");
$top_menu_font_family                  = get_theme_option("font","top_menu_font_family");

$sub_menu_font_size                    = get_theme_option("font","sub_menu_font_size");
$sub_menu_font_family                  = get_theme_option("font","sub_menu_font_family");


$headings_font_family                  = get_theme_option("font","headings_font_family");
$headings_line_height                  = get_theme_option("font","headings_line_height");
$headings_line_height6                	= ($headings_line_height + 1);
$h1_font_size                          = get_theme_option("font","h1_font_size");
$h2_font_size                          = get_theme_option("font","h2_font_size");
$h3_font_size                          = get_theme_option("font","h3_font_size");
$h4_font_size                          = get_theme_option("font","h4_font_size");
$h5_font_size                          = get_theme_option("font","h5_font_size");
$h6_font_size                          = get_theme_option("font","h6_font_size");

$header_link_font_size                 = get_theme_option("header","header_link_font_size");
$header_dropdown_link_font_size        = get_theme_option("header","header_dropdown_link_font_size");
$header_dropdown_font_bold             = get_theme_option("header","header_dropdown_font_bold");
( $header_dropdown_font_bold == "on" )?$header_dropdown_bold='bold':$header_dropdown_bold='';


/* 6 different background settings */
$background_header                        = get_theme_option("background","background_header");
$background_slideshow                     = get_theme_option("background","background_slideshow");
$background_footer                        = get_theme_option("background","background_footer");
$background_copyright                     = get_theme_option("background","background_copyright");
$background_intro                         = get_theme_option("background","background_intro");
$background_content                       = get_theme_option("background","background_content");
$background_top                           = get_theme_option("background","background_top");


$font_faces                               = get_theme_generator('get_font_face_fonts');
$blog_between                             = get_theme_option("blog","blog_between");

$box_margin                               = get_theme_option("advanced","box_margin");
$box_margin                               = ($box_margin)?$box_margin:0;
$box_max_width                            = get_theme_option("advanced","box_max_width");
$box_shadow_size                          = get_theme_option("advanced","box_shadow_size");
$layout_shadow_opacity                    = get_theme_option("advanced","layout_shadow_opacity");
$layout_shadow_opacity                    = ($layout_shadow_opacity == 10)?1:'0.'.$layout_shadow_opacity;

return <<<CSS
{$font_faces}

body{
   font           :{$font_size}px/{$font_line_height}px '{$font_family}', Arial;
}

#header .logo {
	bottom:{$logo_bottom}px;
	left:{$logo_left}px;
}

#header{
	height:{$header_height}px;
   color:{$header_text_color};
}
#header ul.sf-menu > li.li-children > a:after {
 	content: ' ';
	display: inline-block;
	width: 0;
	height: 0;
	margin-left: 0.5em;
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;
	border-top: 5px solid {$header_link_color};
	border-bottom: 2px solid transparent;
}

#header ul.sf-menu ul.sub-menu > li.li-children > a:after,
#header ul.sf-menu ul.children > li.li-children > a:after {
   content: ' ';
   display: inline-block;
   width: 0;
   height: 0;
   border-bottom: 4px solid transparent;
   border-left: 4px solid red;
   border-top: 3px solid transparent;
   position: absolute;
   right: 10px;
   top: 13px;
   border-color:transparent {$header_link_color} transparent;
}

#header .menu {	right:{$menu_right}px !important; }

#header a{                 color:{$header_link_color}; }
#header ul.sf-menu > li.current_page_ancestor > a,
#header ul.sf-menu > li.current_page_parent > a,
#header ul.sf-menu > li.current_page_item > a,
#header a:hover{           color:{$header_link_hover_color}; }

#header ul.children li.current_page_ancestor > a,
#header ul.children li.current_page_parent > a,
#header ul.children li.current_page_item > a,
#header ul.children li a:hover,
#header ul.sub-menu li.current_page_ancestor > a,
#header ul.sub-menu li.current_page_parent > a,
#header ul.sub-menu li.current_page_item > a,
#header ul.sub-menu li a:hover{
   background-color:{$header_dropdown_link_hover_bg_color};
   color:{$header_dropdown_link_hover_color} !important;
}

#header ul.sf-menu li ul li a {
   background-color:{$header_dropdown_link_bg_color};
   color:{$header_dropdown_link_color};
}

#header ul.sf-menu li a {
	font-size:{$top_menu_font_size}px;
	font-family:'{$top_menu_font_family}', Arial;
}

#header ul.sf-menu li ul li a{
   font:{$header_dropdown_bold} {$sub_menu_font_size}px/21px '{$sub_menu_font_family}',Arial;
}

/* home intro colors */
#intro{
   color:{$intro_text_color};
}
#intro a{          
   color:{$intro_link_color};
}
#intro a:hover{    
   color:{$intro_link_hover_color};
}
#intro h1, #intro h2, #intro h3, #intro h4, #intro h5, #intro h6{
   color:{$intro_headers_color};
}


/* page-top colors */
#page-top{
   color:{$top_text_color};
}
#page-top a{          
   color:{$top_link_color};
}
#page-top a:hover{    
   color:{$top_link_hover_color};
}


/* slider colors */
#slider{{$slider_text_color}}
#slider a{{$slider_link_color}}
#slider a:hover{{$slider_link_hover_color}}
#slider h1, #slider h2, #slider h3, #slider h4, #slider h5, #slider h6{{$slider_headers_color}}


/* page content colors */
#content{
   color:{$page_text_color};
}
#content a{          
   color:{$page_link_color};
}
#content a:hover{    
   color:{$page_link_hover_color};
}

#content h1, #content h2, #content h3, #content h4, #content h5, #content h6{
   color:{$page_headers_color};
}

.commentlist li.depth-1, .commentlist li.depth-2,
.commentlist li.depth-3, .commentlist li.depth-4,
.commentlist li.depth-5,
#content	ul.ul_links li a,
#content .recent_list li,
#content .divider_top,
#content .divider_hr,
#content .post-meta,
#content hr{
   border-color:{$page_divider_color};
}



/* footer colors */
#footer{
   color:{$footer_text_color};
   font-size:{$footer_font_size}px;
   font-family:'{$footer_font_family}', Arial;
}
#footer a{          
   color:{$footer_link_color};
}
#footer a:hover{    
   color:{$footer_link_hover_color};
}
#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6{
   color:{$footer_headers_color};
}

/* copyright colors */
#copyright{
   color:{$copyright_text_color};
   font-size:{$footer_font_size}px;
   font-family:'{$footer_font_family}', Arial;
}
#copyright a{          
   color:{$copyright_link_color};
}
#copyright a:hover{    
   color:{$copyright_link_hover_color};
}

.dropcircle,
.dropcap{
   font-family:"{$headings_font_family}", Arial, sans serif;
}

h1,h2,h3,
h4,h5,h6 {	   font-family:"{$headings_font_family}", Arial, sans serif; padding:0; margin:0 0 0.4em 0; line-height:{$headings_line_height}em; letter-spacing: 0.1px; font-weight:inherit; }
h1{		   	font-size:{$h1_font_size}px;  }
h1.page-title,
h2{			   font-size:{$h2_font_size}px;  }
h3{		   	font-size:{$h3_font_size}px;  }
h2.post-title,
h4{	   		font-size:{$h4_font_size}px;  }
h3.widget-title,
h5{	   		font-size:{$h5_font_size}px;  }
h6{		   	font-size:{$h6_font_size}px;  line-height:{$headings_line_height6}em; margin:0;	}

h1 a,h2 a,h3 a, h4 a, h5 a, h6 a{ text-decoration:none !important; }

/* 6 Background Manager */
#header{    {$background_header}    }
#slider{    {$background_slideshow} }
#intro{     {$background_intro}     }
#content{	{$background_content}	}
#footer{    {$background_footer}    }
#copyright{ {$background_copyright} }
#page-top{  {$background_top}       }

.post-wrapper{
	margin-bottom:{$blog_between}px;
}

#boxed-layout{
   margin: {$box_margin}px auto;
   max-width: {$box_max_width}px;
   height:auto;
   display:block;
   position:relative;
   z-index:0;
   box-shadow:0 0 {$box_shadow_size}px rgba(0,0,0,{$layout_shadow_opacity});
}

{$custom_css}
CSS;
?>