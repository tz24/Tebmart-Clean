<?php
/* detecting blog page */
function is_blog($post_id=null) {
	global $is_blog;
	
	if($is_blog == true){return true;}
	$blog_page_id = get_theme_option('blog','blog_page');
   
	if(empty($blog_page_id)){
		return false;
	}

	if( get_queried_object_id() == $blog_page_id || $post_id == $blog_page_id){
		$is_blog = true;
		return true;
	}
	
	return false;
}

/* detecting portfolio page */
function is_portfolio($post_id=null) {
	
   global $is_portfolio;
	
	if($is_portfolio == true){return true;}
	$portfolio_page_id = get_theme_option('portfolio','portfolio_page');
   
	if(empty($portfolio_page_id)){
		return false;
	}

	if( get_queried_object_id() == $portfolio_page_id || $post_id == $portfolio_page_id ){
		$is_portfolio = true;
		return true;
	}
   
	return false;
   
}

/* detecting single portfolio page */
function is_single_portfolio() {
	
   global $is_single_portfolio;
	
	if($is_single_portfolio == true){return true;}
   
   $default_category = explode(',', get_theme_option('portfolio','portfolio_cats'));
   $single_category  = explode(',', get_theme_option('portfolio','portfolio_single_cats'));

   $cats = array_unique(array_merge($default_category, $single_category));
   
   if(empty($cats)){
		return false;
	}
   
   if (in_category( $cats )){
		$is_single_portfolio = true;
      return true;
   }
  
	return false;
   
}

/* add li-children */
class Children_Menu_Walker extends Walker_Nav_Menu{
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		
		if( ! empty( $children_elements[$element->$id_field] ) )
			array_push($element->classes,'li-children');

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}


/* selecbox hooks */
class Walk_Page_SelectBox extends Walker{
	
   var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

	function start_el(&$output, $page, $depth) {
   
      global $page_id;
  
		$pad = str_repeat('-', $depth * 3);
		$output .= "\t<option class=\"level-$depth\" value=\"".get_page_link( $page->ID )."\"";
		if ( $page->ID == $page_id )
         $output .= ' selected="selected"';
		$output .= '>';
		$title = apply_filters( 'list_pages', $page->post_title, $page );
		$output .= $pad . esc_html( $title );
		$output .= "</option>\n";
	}
}

/* dropdown selectbox for responsive design */
function get_page_selectbox() {
   $args    = func_get_args();
	$walker  = new Walk_Page_SelectBox;
	return call_user_func_array(array(&$walker, 'walk'), $args);
}
?>