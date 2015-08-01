<?php
/* theme option render function */
function render_item($type=null, $name=null, $value=null, $custom_value=null, $attribute=null, $group=null, $class=null, $echo=null){

	global $post, $base_options;

	$str = "";
	$values = $value;
	$custom = false;
	$option_group = str_replace(T_SN . '_', '', @$_GET["page"]);
   $options_name  = '_post_options';

   $get_option = @$base_options[$option_group];

	/* set option type for current value */
	if(@$get_option[$name] != "" || is_array($get_option) ){
		$current_values = @$get_option[$name];
	}else if( !empty( $post ) ){
		$current_values = get_post_meta($post->ID, $options_name, true);
      $current_values = @$current_values[$name];
	}

	if($custom_value && empty($current_values) && empty($value) ){
		$current_values = $custom_value;
	}

	if( !empty($value) && empty($get_option[$name]) && empty($current_values) ){
		$current_values = $value;
	}

	/* make options as array */
	$value_array = "options";
	$name_framework = "[".$name."]";

	switch($type){

		/* text */
		case 'text':
			$str.= "<div class=\"option_text ".$class."\" ".$attribute.">".$name."</div>";
		break;

		/* input */
		case 'input':
			$str.= "<div class=\"option_input_text ".$class."\"><input type=\"text\" id=\"".$name."\" name=\"".$value_array.$name_framework."\" value=\"".htmlspecialchars(@$current_values)."\" ".$attribute." class=\"shortcode-attr\" data-id=\"".$name."\"></div>";
		break;

		/* textarea */
		case 'textarea':
			$str.= "<div class=\"option_textarea ".$class."\"><textarea id=\"".$name."\" name=\"".$value_array.$name_framework."\" ".$attribute." class=\"shortcode-attr\" data-id=\"".$name."\">".@$current_values."</textarea></div>";
		break;

		/* select */
		case 'select':

			$str	.= "<div class=\"option_select ".$class."\">";

         /* if select type posts */
			if (preg_match('/\[posts\]/i', $values)){

				/* explode post types [post],[desc] */
				$category = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($category[1] == "all"){
					$args["post_type"] = array( 'post' );  /* ~~ eklendi */
				}else{
					$args["post_type"] = $category[1];
				}
				$args["order"]    = $category[2];
				$args["orderby"]  = $category[3];

				/* get posts and make array */
				$options_array    = query_posts($args);
				$get_name         = "post_title";
				$check_name       = "ID";

			}else if(preg_match('/\[pages\]/i', $values)){

				/* explode pages types [post],[desc] */
				$arg = str_replace(array("[","]"), array("",""), explode(",", $values));
				$args["sort_order"]	= @$arg[1];
				$args["sort_column"]	= @$arg[2];

            /* get pages and make array */
				$options_array       = &get_pages($args);
				$get_name            = "post_title";
				$check_name          = "ID";

			}else if(preg_match('/\[categories\]/i', $values)){

				/* explode categories types [post],[desc] */
				$taxonomy = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($taxonomy[1] == "all"){
					$args["taxonomy"] = array( 'category' );
				}else{
					$args["taxonomy"] = $taxonomy[1];
				}
				$args["hide_empty"]  = false;
				$args["order"]       = $taxonomy[2];
				$args["orderby"]     = $taxonomy[3];

            /* getting categories */
				$options_array       = &get_categories($args);
				$get_name            = "name";
				$check_name          = "term_id";

			}else if(preg_match('/\[sliders\]/i', $values)){

				/* getting sliders */
				global $wpdb;
				$category_table = $wpdb->prefix . "slider_categories";

				$s_types = str_replace(array("[","]"), array("",""), explode(",", $values));
				$query_attr = "";

				if($s_types[1] != "all"){
					$query_attr = "WHERE s_id = '". $s_types[1]."'";
				}

				$options_array = $wpdb->get_results("SELECT id,c_name FROM ". $category_table ." ". $query_attr ." ORDER BY ". $s_types[3] ." ". $s_types[2]."");
            
            // if revslider active
            if (class_exists('RevSlider')) {

               $RevSlider           = new RevSlider();
               $getAllSliderAliases = $RevSlider->getAllSliderAliases();
               $getArrSlidersShort  = array_values($RevSlider->getArrSlidersShort());

               
               if( !empty($getAllSliderAliases) ){
                  foreach($getAllSliderAliases as $k => $v){
                     $addRevSlider           = new stdClass;
                     $addRevSlider->id       = $v;
                     $addRevSlider->c_name   = $getArrSlidersShort[$k];
                     $options_array[]        = $addRevSlider;
                  }
               }

            }
            
            
				$get_name = "c_name";
				$check_name = "id";

			}else{
				$options_array = explode(',', $values);
				$custom = true;
			}

			/* set option array */
			if($get_option[$name] != ""){
				$mkarray = explode(",", $get_option[$name]);
			}else if( !empty( $post ) ){
            $option = get_post_meta($post->ID, $options_name, true);
				$mkarray = explode(",", @$option[$name]);
			}else if($custom_value != ""){
				$mkarray = explode(",", $custom_value);
			}else{
				$mkarray = array();
			}

			/* creating select */
			$str	.= "<select name=\"".$value_array."[selectboxes][".$name."][]\" ".$attribute." class=\"shortcode-attr\" data-id=\"".$name."\">";

			if ( !empty( $options_array[0] ) ){

				if( !preg_match('/multiple/i', $attribute) ){
               $str	.= "<option value=\"\">-- Choose one --</option>";
				}

				foreach ( $options_array as $option ){

					if($custom == true){

						$selected         = '';
						$orginal_option   = $option;
						$option           = str_replace("=selected", "", $option);

						if ( in_array( trim($option), $mkarray) ) {
							$selected = ' selected="selected"';
						}else if( preg_match('/=selected/i', $orginal_option) && empty($get_option) && empty( $post ) && !$custom_value ){
							$selected = ' selected="selected"';
						}

						$str	.= "<option value=\"".$option."\" ".$selected.">".$option."</option>";

					}else{

						$selected = '';
						if ( in_array( trim($option->$check_name), $mkarray) ) {
							$selected = ' selected="selected"';
						}

						$str	.= "<option value=\"".$option->$check_name."\" ".$selected.">".$option->$get_name."</option>";

					}

				}

			} else {
				$str	.= '<option value="">No Items Available</option>';
			}

			$str	.= "</select>";

			if( preg_match('/multiple/i', $attribute) && !empty ( $options_array[0] ) ){
				$str	.= "<div><span class=\"select_all span_select\">Select All</span> <span class=\"span_select\">&nbsp;-&nbsp;</span> <span class=\"unselect_all span_select\">Reset</span></div>";
			}

			$str	.= "</div>";

		break;


      /* fonts select */
		case 'fonts':

			$str	.= "<div class=\"option_select ".$class."\">";

			if($get_option[$name] != ""){
				$current_value = $get_option[$name];
			}else if( !empty( $post ) ){
            $option = get_post_meta($post->ID, $options_name, true);
				$current_value = $option[$name];
			}else if($custom_value != ""){
				$current_value = $custom_value;
			}else{
				$current_value = '';
			}

         /* get all fonts */
         $all_fonts = get_available_fonts();

         /* get current fonts */
			$fonts = explode(",", $values);

         /* creating font select */
			$str	.= "<select name=\"".$value_array."[selectboxes][".$name."][]\" ".$attribute.">";
         $str	.= "<option value=\"\">-- Choose one --</option>";

         foreach($fonts as $key=>$val){

            /* if font is group make optgroup */
            $str	.= (count($fonts) > 1 && !empty($all_fonts[$val]))?'<optgroup label="'.ucfirst($val).' Fonts">':'';

            /* selected current font */
            foreach ( $all_fonts[$val] as $value ){
               $selected = ( $current_value == $value ) ? ' selected="selected"':'';
               $str	.= "<option value=\"".$value."\" ".$selected.">".$value."</option>";
				}
            $str	.= (count($fonts) > 1 && !empty($all_fonts[$val]))?'</optgroup>':'';

         }

			$str	.= "</select>";
			$str	.= "</div>";

		break;


		/* radio */
		case 'radio':

			$class 	!= "" ? $class_out = " class=\"".$class."\"": $class_out = "";
			$str	.= "<div".$class_out.">";

			if (preg_match('/\[posts\]/i', $values)){

				$category = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($category[1] == "all"){
					$args["post_type"] = array( 'post' );
				}else{
					$args["post_type"] = $category[1];
				}
				$args["order"] = $category[2];
				$options_array = query_posts($args);
				$get_name      = "post_title";
				$check_name    = "ID";


			}else if(preg_match('/\[pages\]/i', $values)){

				$arg = str_replace(array("[","]"), array("",""), explode(",", $values));
				$args["sort_order"]	= $arg[1];
				$args["sort_column"]	= $arg[2];

				$options_array = &get_pages($args);
				$get_name = "post_title";
				$check_name = "ID";

			}else if(preg_match('/\[categories\]/i', $values)){

				$taxonomy = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($taxonomy[1] == "all"){
					$args["taxonomy"] = array( 'category' );
				}else{
					$args["taxonomy"] = $taxonomy[1];
				}
				$args["hide_empty"] = false;
				$args["order"]      = $taxonomy[2];
				$args["orderby"]    = $taxonomy[3];
				$options_array      = &get_categories($args);
				$get_name           = "name";
				$check_name         = "term_id";

			}else if(preg_match('/\[sliders\]/i', $values)){

				global $wpdb;
				$category_table = $wpdb->prefix . "slider_categories";

				$s_types = str_replace(array("[","]"), array("",""), explode(",", $values));
				$query_attr = "";

				if($s_types[1] != "all"){
					$query_attr = "WHERE s_id = '". $s_types[1]."'";
				}

				$options_array = $wpdb->get_results("SELECT id,c_name FROM ". $category_table ." ". $query_attr ." ORDER BY ". $s_types[3] ." ". $s_types[2]."");
				$get_name = "c_name";
				$check_name = "id";

			}else{
				$options_array = explode(',', $values);
				$custom = true;
			}

			if($get_option[$name] != ""){
				$mkarray = explode(",", $get_option[$name]);
			}else if( !empty( $post ) ){
            $option = get_post_meta($post->ID, $options_name, true);
				$mkarray = explode(",", $option[$name]);
			}else if($custom_value != ""){
				$mkarray = explode(",", $custom_value);
			}else{
				$mkarray = array();
			}

			if ( $options_array[0] != "" ){

				$str	.= "<ul>";
				foreach ( $options_array as $option ){

					if($custom == true){

						$checked = '';

						$orginal_option = $option;
						$option	= str_replace("=selected", "", $option);

						if ( in_array( trim($option), $mkarray) ) {
							$checked = ' checked="checked"';
						}else if( preg_match('/=selected/i', $orginal_option) ){
							$checked = ' checked="checked"';
						}

						$str	.= "<li class=\"radio_" . $name."_".$option . "\"><label><input type=\"radio\" name=\"".$value_array."[radios][".$name."][]\" value=\"".$option."\" ".$checked.">&nbsp;".$option."</label></li>";
					}else{

						$checked = '';

						if ( in_array( trim($option->$check_name), $mkarray) ) {
							$checked = ' checked="checked"';
						}

						$str	.= "<li class=\"radio_" . $name."_".$option->$get_name . "\"><label><input type=\"radio\" name=\"".$value_array."[radios][".$name."][]\" value=\"".$option->$check_name."\" ".$checked.">&nbsp;".$option->$get_name."</label></li>";
					}

				}
			}else {
				echo "<li style=\"list-style:none;\">No Items Available</li>";
			}
			$str	.= "</ul>";

			$str	.= "<input type=\"hidden\" name=\"".$value_array."[radios][".$name."][]\" value=\"\" checked=\"checked\">";

			$str	.= "</div>";

		break;

		/* checkbox */
		case 'checkbox':

			$class 	!= "" ? $class_out = " class=\"".$class."\"": $class_out = "";
			$str	.= "<div".$class_out.">";

			if (preg_match('/\[posts\]/i', $values)){

				$category = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($category[1] == "all"){
					$args["post_type"] = array( 'post' );
				}else{
					$args["post_type"] = $category[1];
				}
				$args["order"] = $category[2];
				$options_array = query_posts($args);
				$get_name = "post_title";
				$check_name = "ID";

			}else if(preg_match('/\[pages\]/i', $values)){

				$arg = str_replace(array("[","]"), array("",""), explode(",", $values));
				$args["sort_order"]	= $arg[1];
				$args["sort_column"]	= $arg[2];

				$options_array = &get_pages($args);
				$get_name = "post_title";
				$check_name = "ID";

			}else if(preg_match('/\[categories\]/i', $values)){

				$taxonomy = str_replace(array("[","]"), array("",""), explode(",", $values));
				if($taxonomy[1] == "all"){
					$args["taxonomy"] = array( 'category' );
				}else{
					$args["taxonomy"] = $taxonomy[1];
				}
            
				$args["hide_empty"] = false;
				$args["order"]      = $taxonomy[2];
				$args["orderby"]    = $taxonomy[3];
				$options_array      = &get_categories($args);
				$get_name           = "name";
				$check_name         = "term_id";

			}else if(preg_match('/\[sliders\]/i', $values)){

				global $wpdb;
            $category_table = $wpdb->prefix . "slider_categories";

				$s_types = str_replace(array("[","]"), array("",""), explode(",", $values));
				$query_attr = "";

				if($s_types[1] != "all"){
					$query_attr = "WHERE s_id = '". $s_types[1]."'";
				}

				$options_array = $wpdb->get_results("SELECT id,c_name FROM ". $category_table ." ". $query_attr ." ORDER BY ". $s_types[3] ." ". $s_types[2]."");
				$get_name = "c_name";
				$check_name = "id";

			}else{
				$options_array = explode(',', $values);
				$custom = true;
			}

			if(@$get_option[$name] != ""){
				$mkarray = explode(",", $get_option[$name]);
			}else if( !empty( $post ) ){
            $option = get_post_meta($post->ID, $options_name, true);
				$mkarray = explode(",", @$option[$name]);
			}else if($custom_value != ""){
				$mkarray = explode(",", $custom_value);
			}else{
				$mkarray = array();
			}

			if ( $options_array[0] != "" ){

				$str	.= "<ul>";
				foreach ( $options_array as $option ){

					if($custom == true){

						$checked = '';

						$orginal_option = $option;
						$option	= str_replace("=selected", "", $option);

						if ( in_array( trim($option), $mkarray) ) {
							$checked = ' checked="checked"';
						}else if( preg_match('/=selected/i', $orginal_option) && empty($get_option) && empty( $post ) && !$custom_value ){
							$checked = ' checked="checked"';
						}

						$str	.= "<li class=\"check_" . $name."_".$option . "\"><label><input type=\"checkbox\" name=\"".$value_array."[checkboxes][".$name."][]\" value=\"".$option."\" ".$checked." class=\"shortcode-attr\" data-id=\"".$name."\">&nbsp;".$option."</label></li>";
					}else{

						$checked = '';

						if ( in_array( trim($option->$check_name), $mkarray) ) {
							$checked = ' checked="checked"';
						}

						$str	.= "<li class=\"radio_" . $name."_".$option->$get_name . "\"><label><input type=\"checkbox\" name=\"".$value_array."[checkboxes][".$name."][]\" value=\"".$option->$check_name."\" ".$checked.">&nbsp;".$option->$get_name."</label></li>";
					}

				}
			} else {
				echo "<li style=\"list-style:none;\">No Items Available</li>";
			}
			$str	.= "</ul>";

			if($options_array[0] != ""){
				$str	.= "<span class=\"checkbox_all span_select\">Select All</span> <span class=\"span_select\">&nbsp;-&nbsp;</span> <span class=\"uncheckbox_all span_select\">Reset</span>";
			}
         
			$str	.= "<div class=\"cleardiv\"></div></div>";

		break;

		/* colorpicker */
		case 'colorpicker':
		ob_start();
		$class 	!= "" ? $class_out = " class=\"".$class."\"": $class_out = "";
		?>
		<div <?php echo $class_out; ?> style="width:65%;" <?php echo $attribute; ?>>
			<script type="text/javascript">make_colorpicker("<?php echo $name; ?>");</script>
			<div class="option_colorpicker">
				<input type="text" name="<?php echo $value_array.$name_framework; ?>" id="colorpic_<?php echo $name; ?>" value="<?php echo $current_values; ?>" class="shortcode-attr inputcolor_<?php echo $name; ?>" data-id="<?php echo $name; ?>"/>
			</div>
			<div id="colordiv_<?php echo $name; ?>" class="cp_box">
			  <div style="background-color:<?php echo $current_values; ?>;">&nbsp;</div>
			</div>
		</div>
		<?php
		$str	.= ob_get_clean();
		break;

		/* sub header */
		case 'subheader':
			$str	.= "<div class=\"option_subheader ".$class."\" ".$attribute.">". $value ."</div>";
		break;

      /* header */
		case 'header':
			$str	.= "<div class=\"option_header ".$class."\" ".$attribute.">". $value ."</div>";
		break;

		/* content text */
		case 'full_text':
			$str	.= "<div class=\"option_full_text ".$class."\" ".$attribute.">". $value ."</div>";
		break;


		/* upload */
		case 'upload':
			$class 	!= "" ? $class_out = " class=\"".$class."\"": $class_out = "";
			$str	.= "<div".$class_out.">";
			$str	.= "<div class=\"option_upload_input\"><textarea id=\"upload_".$name."\" name=\"".$value_array.$name_framework."\" class=\"upload_input shortcode-attr upload_".$name."\" ".$attribute." data-id=\"".$name."\">". $current_values ."</textarea></div>";
			$str	.= "<div class=\"option_upload_insert\"><a href=\"media-upload.php?post_id=0&TB_iframe=1\" id=\"upload_".$name."\" class=\"set_input thickbox\" title=\"Uploading...\">&nbsp;</a></div>";
			$str	.= "</div>";
		break;


 		/* background */
		case 'background':

         preg_match_all('/background-[a-z]+:\s*(?:url\()?(.*?)(?:\))?;/i', $current_values, $background, PREG_PATTERN_ORDER);
         $str  .= "<div id=\"".$name."\" class=\"background_uploader\">";
         $str  .= '<a href="media-upload.php?post_id=0&TB_iframe=1" id="upload_'.$name.'" class="set_input thickbox"><span id="upload_'.$name.'_preview" class="upload_background_pic" style="'.$current_values.'"></span></a>';
			$str	.= "<div class=\"option_upload_input\"><textarea id=\"upload_".$name."\" class=\"upload_bg_input upload_".$name."\">".$background[1][0]."</textarea></div>";
			$str	.= "<div class=\"option_upload_insert\"><a href=\"media-upload.php?post_id=0&TB_iframe=1\" id=\"upload_".$name."\" class=\"set_input thickbox\" title=\"Uploading...\">&nbsp;</a></div>";
         $str  .= "<div class=\"background_attributes\">";
         $str  .= "<div class=\"bg_attribute option_select\">";
         $str	.= "<span>Position:</span>";
         $positions = array(
			'0% 0%'		=> 'left top',
			'0% 50%'		=> 'left center',
			'0% 100%'	=> 'left bottom',
			'100% 0%'	=> 'right top',
			'100% 50%'	=> 'right center',
			'100% 100%'	=> 'right bottom',
			'50% 0%'		=> 'center top',
			'50% 50%'	=> 'center center',
			'50% 100%'	=> 'center bottom',
         );
         
         $str  .= "<select class=\"background_position\">";         
         foreach ($positions as $key => $val ){
            ($key == $background[1][3] ) ? $selected = " selected=\"selected\"" : $selected = '' ;
            $str	.= "<option value=\"".$key."\" ".$selected.">".$val."</option>";
         }         
         $str	.= "</select>";
         
         $str	.= "</div>";
         $str  .= "<div class=\"bg_attribute option_select\">";
         $str	.= "<span>Repeat:</span>";
         $positions = array('no-repeat' => 'No Repeat', 'repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically');
         
         $str  .= "<select class=\"background_repeat\">";
         foreach ($positions as $key => $val ){
            ($key == $background[1][1] ) ? $selected = " selected=\"selected\"" : $selected = '' ;
            $str	.= "<option value=\"".$key."\" ".$selected.">".$val."</option>";
         }
         $str	.= "</select>";
         
         $str	.= "</div>";
         $str  .= "<div class=\"bg_attribute option_select\">";
         $str	.= "<span>Attachment:</span>";
         $positions = array('scroll' => 'Scroll', 'fixed' => 'Fixed');
         
         $str  .= "<select class=\"background_attachment\">";
         foreach ($positions as $key => $val ){
            ($key == $background[1][2] ) ? $selected = " selected=\"selected\"" : $selected = '' ;
            $str	.= "<option value=\"".$key."\" ".$selected.">".$val."</option>";
         }
			$str	.= "</select>";
         
         $str	.= "</div>";
         $str  .= "<div class=\"bg_attribute option_select last\">";
         $str	.= "<span>Color:</span>";
         ob_start();
         ?>
         <script type="text/javascript">make_colorpicker("<?php echo $name; ?>");</script>
         <div class="option_colorpicker">
         <input type="text" name="" id="colorpic_<?php echo $name; ?>" value="<?php echo $background[1][4]; ?>" class="inputcolor_<?php echo $name; ?> bg_pic" />
         </div>
         <?php
         $str	.= ob_get_clean();
         $str	.= "</div>";
         $str  .= "<input type=\"text\" style=\"width:100%; height:50px;\" class=\"bg_result\" name=\"".$value_array.$name_framework."\" value=\"".$current_values."\" />";
         $str  .= "</div>";
         $str  .= "</div>";
         
		break;

		/* slider_ui */
		case 'slider_ui':
      
			$valuem = explode(",", $values);
			if($get_option[$name] != ""){
				$cur_val = $get_option[$name];
			}else if( !empty( $post ) ){
				$cur_val = get_post_meta($post->ID, $options_name, true);

				if( empty($cur_val[$name]) ){
					$cur_val = $valuem[0];
				}else{
					$cur_val = $cur_val[$name];
				}

			}else if($custom_value != ""){
				$cur_val = $custom_value;
			}else{
				$cur_val = $valuem[0];
			}

		ob_start();
		$class 	!= "" ? $class_out = " class=\"".$class."\"": $class_out = "";
		?>
		<script type="text/javascript">make_slider_ui("<?php echo $name; ?>", "<?php echo $cur_val; ?>", "<?php echo $valuem[1]; ?>", "<?php echo $valuem[2]; ?>");</script>

		<div <?php echo $class_out; ?> <?php echo $attribute; ?>>

			<div class="option_slider_holder">

				<div class="option_slider_drag">
					<div id="slider_ui_<?php echo $name; ?>"></div>
				</div>

			</div>

			<div class="option_slider_text">
				<input type="text" class="slider_ui_name_<?php echo $name; ?> shortcode-attr" name="<?php echo $value_array.$name_framework; ?>" value="<?php echo $cur_val; ?>" data-id="<?php echo $name; ?>"/>
				<div class="option_slider_info"><?php echo $valuem[3]; ?></div>
			</div>

			<?php if ( @$valuem[4] == "font" ) { ?>
			<div class="slider_ui_size_<?php echo $name; ?>" style="display:table; clear:both; font-size:<?php echo $cur_val; ?>px; line-height:<?php echo $cur_val; ?>px; margin:5px 0;">(Live Preview Size)</div>
			<?php } else if ( @$valuem[4] == "alpha" ) { ?>
			<div class="slider_ui_alpha_<?php echo $name; ?> option_slider_alpha">Live Alpha</div>
			<?php } ?>

		</div>

		<?php
		$str	.= ob_get_clean();
		break;

		/* on-off */
		case 'on_off_ui':
			if( $current_values == "on"  ) { $status = "on"; } else { $status = "off"; }
			?>
			<script type="text/javascript"> make_on_off_ui("<?php echo $name; ?>"); </script>
			<?php
			$str	.= "<div class=\"lambs lamb_".$status."\"></div>";
			$str	.= "<input id=".$name." type=\"checkbox\" name=\"".$value_array."[checkboxes][".$name."][]\" value=\"".$status."\" checked=\"checked\" ".$attribute." class=\"shortcode-attr\" data-id=\"".$name."\">";
		break;

		case 'tinymce':

			ob_start();
			if( function_exists('wp_editor') ){
				wp_editor($current_values, $name, array('dfw' => false, 'textarea_rows'=> 10, 'textarea_name' => $value_array.$name_framework, 'tabindex' => 1) );
			}else{
				$str.= "<div class=\"option_textarea ".$class."\"><textarea id=\"".$name."\" name=\"".$value_array.$name_framework."\" ".$attribute.">".$current_values."</textarea></div>";
			}
			$str	.= ob_get_clean();

		break;
      
      /* help */
		case 'help':
			$str.= "<div class=\"option_help\" ".$attribute."><img src=\"[path_libs]/images/help.png\" alt=\"\" class=\"help_img\"/> ". $name ."</div>";
		break;

      /* tooltip help */
		case 'tooltip':
			$str.= "<div class=\"option_tooltip\"><img src=\"[path_libs]/images/help.png\" alt=\"\" class=\"help_img\"/> <span class=\"tooltip\">". $name ."</span></div>";
		break;

      /* blank */
		case 'blank':
			$str.= "<div>&nbsp;</div>";
		break;

      /* icons colored */
		case 'colored_icons':

			/* getting colored icons  */
			$path = T_PATH.'/images/icons/colored_icons/16/';
			$dirs = glob($path.'*.png');

			$str	.= '<div class="option_select">';
			$str	.= '<select class="shortcode-attr" data-id="'.$name.'">';
			$str	.= "<option value=\"\">-- Choose one --</option>";
         
			foreach($dirs as $dir){
				$value = str_replace(array($path, '_16.png'),'',$dir);
				$str .= '<option value="'.$value.'" style="background:url('.T_URI.'/images/icons/colored_icons/16/'.$value.'_16.png) no-repeat 95% 5px scroll transparent;">'.$value.'</option>';
			}
         
			$str	.= '</select>';
			$str	.= '</div>';

		break;

      /* icon sweets */
		case 'iconsweets':

         /* getting icons sweets */
			$path = T_PATH.'/images/icons/iconsweets/black/16/';
			$dirs = glob($path.'*.png');

			$str	.= '<div class="option_select">';
			$str	.= '<select class="shortcode-attr" data-id="'.$name.'">';
			$str	.= "<option value=\"\">-- Choose one --</option>";
         
			foreach($dirs as $dir){
				$value = str_replace(array($path, '.png'),'',$dir);
				$str .= '<option value="'.$value.'" style="background:url('.T_URI.'/images/icons/iconsweets/black/16/'.$value.'.png) no-repeat 95% 5px scroll transparent;">'.$value.'</option>';
			}
         
			$str	.= '</select>';
			$str	.= '</div>';

		break;
      
      
      /* update check */
		case 'update':
			$str	.= '<div class="updated below-h2" id="update_notifier"><iframe src="http://codestarlive.com/themeforest/redirect/notifier.php?theme='.T_NAME.'&ver='.T_VER.'&referer='.@$_SERVER["HTTP_HOST"].'" style="width:100%; height:115px; border:0;"></iframe></div>';
		break;

	}

	$str  = str_replace(array('[path]', '[path_libs]', '[path_wp_admin]', '[path_req]', '[path_inc]'), array( T_URI, T_URI."/".F_PATH."/libs", site_url()."/wp-admin/", T_URI."/".F_REQ, T_URI."/".F_INC), $str);
	if( empty($echo) ){ echo $str; }else{ return $str; }
   
}
?>