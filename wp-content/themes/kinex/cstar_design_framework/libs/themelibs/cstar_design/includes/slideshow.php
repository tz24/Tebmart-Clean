<?php
if ( !class_exists('CodeStarSlideshows') ){


class CodeStarSlideshows{

	var $sliders = array("Cycle", "Nivo", "Flashmo", "Piecemaker 3D", "Accordion", "Codestar's", "Flex");
	var $is_resp = array("no", "yes", "no", "no", "no", "no","yes");

	function __construct(){
      global $wpdb;

      $this->cp_db_version	   = "1.1";
      $this->category_table	= $wpdb->prefix . "slider_categories";
      $this->item_table		   = $wpdb->prefix . "slider_items";

      if( get_option("cp_db_version") != $this->cp_db_version ) { $this->install_cp_db(); };

		$this->_save_operation();

      add_action('admin_menu', array(&$this, 'add_slider_menu') );
   }

   function add_slider_menu(){
      global $menu;

      $slider_position = 33;
      if( !empty ( $menu[$slider_position] ) ){ $slider_position = null; }
		add_menu_page('Sliders', 'Sliders', 'manage_options', 'sliders', array(&$this, 'sliders'), false, $slider_position);

   }


   function implode_categories($requests){

      $data = "";
      foreach($requests as $option_name => $op) {

         $categories = array();

         foreach($op as $k => $v){

            if($v != ""){
               $categories[]	=  $v;
            }

         }

      }

      $data =  implode(",", $categories);

      return $data;

   }

   function get_serialize_requests(){

      $options = @$_REQUEST["options"];
      $exclude_opts = array('c_name', 's_name', 'cats', 'categories');
      $exclude_vals = array();


      
      $opts = array();

      
      foreach($options as $key => $option) {
         
         if( !is_array( $option ) ){
            if( !in_array($option, $exclude_vals) && !in_array($key, $exclude_opts) && !empty($option) || $option == "0" ){
               $opts[$key] = stripslashes($option);

            }
         } else {

            
            foreach($option as $op => $val){

               $values = array();

               
               foreach ($val as $k => $v){
                  if($v != ""  && !in_array($v, $exclude_vals) ){
                     $values[] =  $v;
                  }
               }

               if( !empty($values) && !in_array($op, $exclude_opts) ){
                  
                  $opts[$op] = implode(",", $values);
               }
            }
         }
      }

      return serialize($opts);

   }

   function _save_operation(){
		global $wpdb;

		$action = @$_REQUEST["do"];

		switch($action){

			case 'add_category':

            $s_id    = @$_POST["slider_id"];
            $c_name  = @$_REQUEST["options"]["c_name"];
            if( $c_name ) {

               $sql_exec = "INSERT INTO ". $this->category_table ." SET
               s_id     = '". $s_id ."',
               c_name	= '". $c_name . "',
               c_value	= '". $this->get_serialize_requests() . "',
               orderby	= '0'";
               $wpdb->query( $sql_exec );

               $get_insert_id = $wpdb->insert_id;
               $upgrade_insert_id = "UPDATE ". $this->category_table ." SET
               orderby = '". $get_insert_id ."'
               WHERE id = '". $get_insert_id ."'";

               $wpdb->query( $upgrade_insert_id );
               $this->mysqlresult = "New slider has been <strong><em>created!</em></strong>";

				} else {
					$this->mysqlerror = "error!";
				}

			break;

			case 'edit_category':

            $c_name  = @$_REQUEST["options"]["c_name"];

				if( $c_name ) {

					$c_id		= $_POST["edit_id"];

					$sql_exec = "UPDATE ". $this->category_table ." SET
               c_name	= '". $c_name . "',
					c_value = '". $this->get_serialize_requests() . "'
					WHERE id = '". $c_id ."'";
					$wpdb->query( $sql_exec );

					$this->mysqlresult = "Slider has been <strong><em>updated!</em></strong>";

				} else {

					$this->mysqlerror = "error!";

				}

			break;


			case 'del_category':

				$insert = "DELETE FROM ". $this->category_table ." WHERE id = '". @$_GET["del_id"] ."'";
				$wpdb->query( $insert );

				$this->mysqlresult = "Slider has been <strong><em>deleted!</em></strong>";

			break;

			case 'add_item':

				$request_options = @$_REQUEST["options"];

				if( $request_options["cats"] != "" ) {

					$s_value	   = addslashes($this->get_serialize_requests());
					$s_name		= @$_POST["options"]["s_name"];
					$s_id		   = $_POST["slider_id"];
					$c_id		   = $this->implode_categories($request_options["cats"]);

					$sql_exec = "INSERT INTO ". $this->item_table ." SET
					c_id = '". $c_id ."',
					s_id = '". $s_id ."',
					s_name = '". $s_name ."',
					s_value = '". $s_value . "',
					orderby = '0'";
					$wpdb->query( $sql_exec );

					$get_insert_id = $wpdb->insert_id;
					$upgrade_insert_id = "UPDATE ". $this->item_table ." SET
					orderby = '". $get_insert_id ."'
					WHERE id = '". $get_insert_id ."'";

					$wpdb->query( $upgrade_insert_id );

					$this->mysqlresult = "New slider item has been <strong><em>created!</em></strong>";


				} else {

					$this->mysqlerror = "error!";

				}

			break;

			case 'edit_item':

				$request_options = @$_REQUEST["options"];

				if( $request_options["cats"] != "" ) {

					$s_value	   = addslashes($this->get_serialize_requests());
					$s_name		= $_POST["options"]["s_name"];
					$c_id		   = $this->implode_categories($request_options["cats"]);
					$item_id 	= $_POST["item_id"];

					$sql_exec = "UPDATE ". $this->item_table ." SET
					c_id = '". $c_id ."',
					s_name = '". $s_name ."',
					s_value = '". $s_value . "'
					WHERE id = '" . $item_id . "'";
					$wpdb->query( $sql_exec );

					$this->mysqlresult = "Slider item has been <strong><em>updated!</em></strong>";

				} else {

					$this->mysqlerror = "error!";
				}

			break;


			case 'del_item':

				$insert = "DELETE FROM ". $this->item_table ." WHERE id = '". @$_GET["del_id"] ."'";
				$wpdb->query( $insert );

				$this->mysqlresult = "Slider item has been <strong><em>deleted!</em></strong>";

			break;

		}

   }

   function get_slider_title(){

      
      return $this->sliders[(@$_GET["id"]-1)];


   }



   function sliders(){
	global $wpdb;

	echo '<div class="wrap"><div class="icon32" id="icon-edit"><br /></div>';


	$page = @$_GET["p"];

	switch ($page){

		case 'show':
			echo "<h2>Sliders of ". $this->get_slider_title() ."<a class=\"button add_new_button\"  href=\"?page=sliders&p=add&id=". @$_GET["id"] ."\">Add New Item</a></h2>";
		break;

		case 'add':
			echo "<h2>Add New Slider Item</h2>";
		break;

		case 'category':
			echo "<h2>Sliders of ". $this->get_slider_title() ."</h2>";
		break;

		case 'settings':
			echo "<h2>Settings of ". $this->get_slider_title() ."</h2>";
		break;

		default:
			echo "<h2>List of Slider Managers</h2>";
		break;
	}

	if ( isset($this->mysqlresult) ){
		echo '<div class="updated"><p>'. $this->mysqlresult .'</p></div>';
	}

	if ( isset($this->mysqlerror) ){
		echo '<div class="error"><p>There is a <strong><em>'. $this->mysqlerror .'</em></strong>.</p></div>';
	}

	if( !@$_REQUEST["id"] ){
?>
<div class="framework_wrapper" style="width:800px;">
<div class="framework_band framework_top"><div class="framework_logo"></div></div>

<div class="framework_content">

<table cellspacing="0" class="option_tables">
	<tbody>
		<tr>
			<td>
            <?php
            $item_count = 0;
            foreach ($this->sliders as $key => $slider){
               $cur_slider_id = $key+1;
               $item_count = $wpdb->get_var($wpdb->prepare("SELECT count(s_id) FROM ". $this->item_table ." WHERE s_id = %d", $cur_slider_id));
            ?>
            <table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
               <tr>
						<td class="for_0">
                     <span class="slider_img slider_id_<?php echo $cur_slider_id; ?>">
                        <?php if( $this->is_resp[$cur_slider_id-1] == 'yes'){ ?>
                           <span class="slider_responsive">Responsive</span>
                        <?php } ?>
                     </span>                     
                  </td>
                  <td class="for_1">

                     <div class="slider_buttons">

                        <h2><?php echo $slider; ?> Slider</h2>
                        <ul>
                           <li class="icon_preview"><a href="?page=sliders&p=show&id=<?php echo $cur_slider_id; ?>">Show all slider items (<?php echo $item_count; ?>)</a></li>
                           <li class="icon_add"><a href="?page=sliders&p=add&id=<?php echo $cur_slider_id; ?>">Add new slider item</a></li>
                           <li class="icon_category"><a href="?page=sliders&p=category&id=<?php echo $cur_slider_id; ?>">Create new slider</a></li>
                        </ul>
                        
                        
                     </div>
                  </td>
               </tr>
            </table>
            <?php } ?>
         </td>
      </tr>
   </tbody>
</table>
</div><!-- end of content -->

<div class="framework_band framework_bottom"></div>
</div>
<?php
	}
	else if(@$_REQUEST["p"] == "show"){

		if(@$_GET["m"] != "" && @$_GET["cur_id"] != "") {
			$this->move_item(@$_GET["cur_id"], @$_GET["m"], $this->item_table, "orderby", "DESC", "c_id");
		}
?>

   <div class="shownav">

		<div class="alignleft filterby">
			<form method="post" action="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>">
				<select class="slider_filter" name="filterby">
				<?php
					$filter_categories = $wpdb->get_results("SELECT * FROM ". $this->category_table ." WHERE s_id = '". @$_GET["id"] ."' ORDER BY orderby DESC");
					if(count($filter_categories) <= 0){

						echo "<option value=''>There is not any slider item.</option>";

					} else {

						echo "<option value=''>View all sliders</option>";

						foreach ($filter_categories as $get_data) {

							$d = $get_data->id;
							$count_filter = $wpdb->get_var($wpdb->prepare("SELECT count(id) FROM ". $this->item_table ." WHERE c_id REGEXP '(^".$d.",)|(,".$d."$)|(,".$d.",)|^".$d."$'", ''));

							$selected = "";
							if( @$_REQUEST["filterby"] == $get_data->id ){ $selected = "selected=\"selected\""; }
							echo "<option value=\"" . $get_data->id . "\" " . $selected . ">" . $get_data->c_name . " " . "(" . $count_filter . ")" . "</option>";

						}
					}
				?>
				</select>
				<input type="submit" class="button-secondary" value="Filter" />
			</form>
		</div>
		<!-- end filter by -->

		<!-- begin slider buttons -->
      <div class="view-switch">
			<a class="button" href="?page=sliders&p=add&id=<?php echo @$_GET["id"]; ?>">Add new slider item</a>
			<a class="button" href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>">Add new slider</a>
			<a href="javascript:history.back();" class="button">Go Back</a>
		</div>
		<div class="clear"></div>
		<!-- end slider buttons -->

   </div>

   <div class="clear"></div>

	<!-- begin slider items -->
   <table cellspacing="0" class="widefat slideshow-table">

		<thead>
			<tr>
				<th style="width:25px;" align="center">ID</th>
				<th class="column-column_preview">Preview</th>
				<th class="manage-column column-title" id="title" scope="col">Title</th>
				<th style="width:200px;">Sliders</th>
				<th style="width:50px;">&nbsp;</th>
				<th style="width:50px;">&nbsp;</th>
				<th style="width:50px;">&nbsp;</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th colspan="7">&nbsp;</th>
			</tr>
		</tfoot>

		<tbody>

			<?php
				$sql_regex = "";
				if( @$_REQUEST["filterby"] != ""){

					$v = @$_REQUEST["filterby"];
					$sql_regex = "AND c_id REGEXP '(^".$v.",)|(,".$v."$)|(,".$v.",)|^".$v."$'";

				}

				$slider_items	= $wpdb->get_results("SELECT * FROM ". $this->item_table ." WHERE s_id = '". @$_GET["id"] ."' " . $sql_regex . " ORDER BY orderby DESC");
				$total_items	= count($slider_items);

				if($total_items <= 0){
					echo "<tr><th height=\"50\" colspan=\"7\">There is not any slider item.</th></tr>";
				}

				$a = 1; 
				$i = 0; 
				foreach ($slider_items as $item) {
            $i_value = unserialize($item->s_value);
			?>
			<tr valign="middle" class="<?php if($a > 1){ echo "alternate"; $a = 0; } ?>">

				<th><?php echo $item->id; ?></th>
				<th><a href="?page=sliders&p=add&id=<?php echo @$_GET["id"]; ?>&edit_id=<?php echo $item->id;?>"><span class="<?php if( preg_match('/gif$|jpg$|png$|GIF$|JPG$|PNG$/', @$i_value['s_layer1_image'] ) || preg_match('/gif$|jpg$|png$|GIF$|JPG$|PNG$/', @$i_value['s_image'] ) ) { echo "upload_pic"; } else { echo "external_pic"; } ?>"><?php if( preg_match('/gif$|jpg$|png$|GIF$|JPG$|PNG$/', @$i_value['s_image'] ) ) { ?><img height="75" width="150" alt="" src="<?php echo @$i_value['s_image']; ?>" /><?php } ?><?php if( preg_match('/gif$|jpg$|png$|GIF$|JPG$|PNG$/', @$i_value['s_layer1_image'] ) ) { ?><img height="75" width="150" alt="" src="<?php echo @$i_value['s_layer1_image']; ?>" /><?php } ?><?php if(!empty($i_value["s_layer1_background"]) && @$i_value["s_layer1_type"] == 'background'){ preg_match_all('/background-[a-z]+:\s*(?:url\()?(.*?)(?:\))?;/i', @$i_value['s_layer1_background'], $background, PREG_PATTERN_ORDER); ?><img height="75" width="150" alt="" src="<?php echo $background[1][0]; ?>" /><?php } ?></span></a></th>
				<th><strong><a href="?page=sliders&p=add&id=<?php echo @$_GET["id"]; ?>&edit_id=<?php echo $item->id;?>" class="item-title"><?php echo $item->s_name; ?></a></strong></th>
				<th>
				<?php
					$cats = explode(",", $item->c_id);
					foreach($cats as $cat){
						$cat_name = $wpdb->get_row("SELECT id,c_name FROM " . $this->category_table . " WHERE id = '" . $cat . "'");
						echo "<a class=\"category-title\" href=\"?page=sliders&p=show&id=" . @$_GET["id"] . "&filterby=" .  $cat . "\">" . $cat_name->c_name . "</a><br />";
					}
				?>
				</th>

				<th><a href="?page=sliders&p=add&id=<?php echo @$_GET["id"]; ?>&edit_id=<?php echo $item->id;?>" class="icon_edit">edit</a></th>

				<th><a href="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>&do=del_item&del_id=<?php echo $item->id;?>" onclick="return confirm('Are you sure you want to delete?');" class="icon_remove">del</a></th>

				<th>

					<?php if( @$_REQUEST["filterby"] != ""){ ?>

						<?php if($i!=0) { ?>
						<a href="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>&m=up&cur_id=<?php echo $item->id; ?>&filterby=<?php echo $cat; ?>" class="icon_up">up</a>

						<?php } if($i != $total_items-1 ) { ?>
						<a href="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>&m=down&cur_id=<?php echo $item->id; ?>&filterby=<?php echo $cat; ?>" class="icon_down">down</a>
						<?php } ?>

					<?php } ?>

				</th>

			</tr>
			<?php $a++; $i++; } ?>

		</tbody>

   </table>
	<!-- end slider items -->
	<br />
<?php

	}

	else if(@$_REQUEST["p"] == "add"){

		$slider_item_name 	= "";
		$slider_item_desc 	= "";
		$slider_item_value 	= "";
		if(@$_GET["edit_id"]){
			$edit_data_slider = $wpdb->get_row("SELECT * FROM ". $this->item_table ." WHERE id = '". @$_GET["edit_id"] ."'");
			$slider_item_name 	= $edit_data_slider->s_name;
			$slider_item_value 	= unserialize($edit_data_slider->s_value);
		}
?>

	<form method="post" action="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>">

		<div class="has-right-sidebar" id="poststuff">

			<div class="inner-sidebar">

				<div id="side-sortables">

					<div class="postbox" id="submitdiv">

						<h3><span>Choose a slider(s)</span></h3>

						<div class="inside">

							<div class="categorydiv">

								<ul class="category-tabs">
									<li class="tabs">All Sliders</li>
									<li><a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>">+ Add more slider(s)</a></li>
								</ul>

								<div class="tabs-panel">

									<ul>

										<?php
										$getting_sliders = $wpdb->get_results("SELECT * FROM ". $this->category_table ." WHERE s_id = '". @$_GET["id"] ."' ORDER BY orderby DESC");

										if( count($getting_sliders) <= 0 ){
											echo "<li>There is not any slider</li>";
										}
										
										foreach ($getting_sliders as $get_data){

											$str_out	= "";

											$str_out	.= '<li><label class="selectit">';

											$str_out	.= '<input type="checkbox" class="categories_sliders" name="options[cats][categories][]" value="' . $get_data->id . '" ';

											if( @$_GET["c_id"] == $get_data->id ) {

												$str_out	.= "checked=\"checked\"";

											}

											if( @$edit_data_slider->c_id != ""){

												$mkarray = explode(",", $edit_data_slider->c_id);

												if ( in_array( trim( $get_data->id ), $mkarray) ) {

													$str_out	.= "checked=\"checked\"";

												}

											}

											$str_out	.= '> ';
											$str_out	.= $get_data->c_name;
											$str_out	.= '</label></li>';

											echo $str_out;

										}

										?>

									</ul>

								</div>

							</div>

							<div id="major-publishing-actions">

								<div class="go_back_save"><a href="javascript:history.back();" class="button">Go Back</a></div>

								<div id="publishing-action">

									<?php if(@$_GET["edit_id"]){ ?>

									<input type="hidden" value="edit_item" name="do">
									<input type="hidden" value="<?php echo @$_GET["edit_id"]; ?>" name="item_id">
									<input type="submit" value="Update" class="button-primary save_new_item" name="update">

									<?php } else { ?>

									<input type="hidden" value="add_item" name="do">
									<input type="hidden" value="<?php echo @$_GET["c_id"]; ?>" name="c_id">
									<input type="hidden" value="<?php echo @$_GET["id"]; ?>" name="slider_id">
									<input type="submit" value="Save" class="button-primary save_new_item" name="save">

									<?php } ?>

								</div>

								<div class="clear"></div>

							</div>

						</div>

					</div>

				</div>

			</div>


			<div id="post-body">


				<div id="post-body-content" class="slider_items">

					<?php include_once( T_PATH ."/". F_REQ ."/slider_item_fields.php"); ?>

				</div>

			</div>

		</div>

	</form>



<?php
	}

	else if(@$_REQUEST["p"] == "category"){


		if(@$_GET["m"] != "" && @$_GET["cur_id"] != "") {

			$this->move_item(@$_GET["cur_id"], @$_GET["m"], $this->category_table, "orderby", "DESC", "s_id");

		}
?>

	<div id="col-container">

		<div id="col-right">

			<div class="tablenav">
				<div class="alignright actions">
					<a href="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>" class="button" style="float:left; margin-right:10px;">Show all slider items</a>
					<a href="javascript:history.back();" class="button" style="float:left;">Go Back</a>
				</div>
			</div>

			<div class="clear"></div>

			<table cellspacing="0" class="widefat slideshow-table">

				<thead>
					<tr>
						<th style="width:25px;" align="center">ID</th>
						<th>Slider Name</th>
						<th style="width:50px;">&nbsp;</th>
						<th style="width:50px;">&nbsp;</th>
						<th style="width:50px;">&nbsp;</th>
						<th class="num" style="width:75px;"></th>
						<th style="width:50px;">&nbsp;</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th colspan="7"><em>( Choose a slider for add to slider item )</em></th>
					</tr>
				</tfoot>

				<tbody>
					<?php
					$slider_categories = $wpdb->get_results("SELECT * FROM ". $this->category_table ." WHERE s_id = '". @$_GET["id"] ."' ORDER BY orderby DESC");
					$slider_count = count($slider_categories);

					if($slider_count <= 0){

						echo '<tr><th height="50" colspan="7">There is not any slider</th></tr>';

					}

					$a = 1;
					$i = 0;



					foreach ($slider_categories as $get_data) {
						$h = $get_data->id;
						$item_count = $wpdb->get_var($wpdb->prepare("SELECT count(c_id) FROM ". $this->item_table ." WHERE c_id RLIKE '^".$h."$' OR c_id RLIKE ',".$h."$' OR c_id RLIKE '^".$h.",' OR c_id RLIKE ',".$h.",'", ''));
					?>
					<tr class="<?php if($a > 1){ echo "alternate"; $a = 0; } ?>">

						<th height="50" align="center"><?php echo $get_data->id; ?></th>

						<td><strong><a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>&edit_id=<?php echo $get_data->id;?>" class="slider-title"><?php echo $get_data->c_name;?></a></strong></td>

						<th><a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>&edit_id=<?php echo $get_data->id;?>" class="icon_edit">edit</a></th>

						<th><a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>&do=del_category&del_id=<?php echo $get_data->id;?>" onclick="return confirm('Are you sure you want to delete?');" class="icon_remove">remove</a></th>

						<th>

							<!-- begin up/down -->
							<?php if($i!=0) { ?>
							<a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>&m=up&cur_id=<?php echo $get_data->id; ?>" class="icon_up">up</a>
							<?php } if($i != $slider_count-1 ) { ?>
							<a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>&m=down&cur_id=<?php echo $get_data->id; ?>" class="icon_down">down</a>
							<?php } ?>
							<!-- end up/down -->

						</th>

						<th class="num"><a href="?page=sliders&p=show&id=<?php echo @$_GET["id"]; ?>&filterby=<?php echo $get_data->id; ?>"><?php echo $item_count;?> item(s)</a></th>


						<th><a href="?page=sliders&p=add&id=<?php echo @$_GET["id"]; ?>&c_id=<?php echo $get_data->id;?>" class="icon_add_slide">add</a></th>

					</tr>
					<?php $a++; $i++; } ?>

				</tbody>

			</table>

		</div>
		<!-- end slider categories -->

		<?php
			$slider_name	= "";
			$slider_desc	= "";
			$slider_value	= "";
			if(@$_GET["edit_id"]){

				$edit_data = $wpdb->get_row("SELECT * FROM ". $this->category_table ." WHERE id = '". @$_GET["edit_id"] ."'");
            $c_value = unserialize($edit_data->c_value);

            $slider_name	= $edit_data->c_name;
            $slider_desc	= $c_value['c_desc'];
			}
		?>
		<div id="col-left">

			<div class="col-wrap">

				<div class="form-wrap">

					<form action="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>" method="post">

						<?php if(@$_GET["edit_id"]){ ?>
						<h3>Update "<?php echo $slider_name; ?>"</h3>
						<?php } else { ?>
						<h3>Add New <?php echo $this->get_slider_title(); ?></h3>
						<?php } ?>

						<div class="slider_form_field">
							<label for="c_name">Slider Name</label>
							<?php render_item("input", 'c_name', $slider_name ); ?>
						</div>

						<div class="slider_form_field">
							<label for="c_desc">Slider Description <em>(optional)</em></label>
							<?php render_item("textarea", 'c_desc', $slider_desc ); ?>
						</div>

                  <h3>Slider General Settings</h3>

						<?php include_once( T_PATH ."/". F_REQ ."/slider_category_fields.php"); ?>

						<?php
							if(@$_GET["edit_id"]){
						?>

						<input type="hidden" value="edit_category" name="do">
						<input type="hidden" value="<?php echo @$_GET["edit_id"]; ?>" name="edit_id">
						<input type="submit" value="Update" id="submit_slider_category" name="submit" class="button">
						<a href="?page=sliders&p=category&id=<?php echo @$_GET["id"]; ?>" class="button cancel_update">Cancel</a>

						<?php } else { ?>

						<input type="hidden" value="<?php echo @$_GET["id"]; ?>" name="slider_id">
						<input type="hidden" value="add_category" name="do">
						<input type="submit" value="Add New <?php echo $this->get_slider_title(); ?>" id="submit_slider_category" name="submit" class="button">

						<?php } ?>

					</form>

				</div>

			</div>

		</div>

	</div>

<?php } ?>

</div>
<!-- end wrap -->
<?php

   }



	function move_item($id, $mode, $table, $column = null, $order, $filter_id) {

		global $wpdb;

		if($order == "DESC"){

			$order_up = "ASC";
			$icon_up = ">";
			$order_down = "DESC";
			$icon_down = "<";

		}else{

			$order_up = "DESC";
			$icon_up = "<";
			$order_down = "ASC";
			$icon_down = ">";

		}

		if($mode != ""){

			$count	= $wpdb->get_var($wpdb->prepare("SELECT count(id) FROM ". $table ." WHERE id = %d", $id));
			$f_id	= $wpdb->get_var($wpdb->prepare("SELECT ". $filter_id ." FROM ". $table ." WHERE id = %d", $id));

			if($count > 0) {

				$thisone = $wpdb->get_row("SELECT id, " . $column . " FROM " . $table . " WHERE id = '" . $id . "' LIMIT 1");


				switch($mode) {

					case "up":


						$count = $wpdb->get_var($wpdb->prepare("SELECT id, " . $column . " FROM ". $table ." WHERE " . $column . " " . $icon_up . " ".$thisone->$column." ORDER BY " . $column . " " . $order_up . " LIMIT 1", ''));

						if($count > 0) {

							$upper = $wpdb->get_row("SELECT id, " . $column . " FROM ". $table ." WHERE ". $filter_id ." = '" . $f_id . "' AND " . $column . " " . $icon_up . " ".$thisone->$column." ORDER BY " . $column . " " . $order_up . " LIMIT 1");

							$update = $wpdb->query("UPDATE ". $table ." SET " . $column . " = ".$upper->$column." WHERE id = ".$thisone->id." LIMIT 1");
							$update = $wpdb->query("UPDATE ". $table ." SET " . $column . " = ".$thisone->$column." WHERE id = ".$upper->id." LIMIT 1");

						}

					break;

					case "down":

						$count = $wpdb->get_var($wpdb->prepare("SELECT id, " . $column . " FROM ". $table ." WHERE " . $column . " " . $icon_down . " ".$thisone->$column." ORDER BY " . $column . " " . $order_down . " LIMIT 1", ''));
						if($count > 0) {

							$upper = $wpdb->get_row("SELECT id, " . $column . " FROM ". $table ." WHERE ". $filter_id ." = '" . $f_id . "' AND " . $column . " " . $icon_down . " ".$thisone->$column." ORDER BY " . $column . " " . $order_down . " LIMIT 1");

							$update = $wpdb->query("UPDATE ". $table ." SET " . $column . " = ".$upper->$column." WHERE id = ".$thisone->id." LIMIT 1");
							$update = $wpdb->query("UPDATE ". $table ." SET " . $column . " = ".$thisone->$column." WHERE id = ".$upper->id." LIMIT 1");

						}

					break;

				}


			}

		}

	}


   function install_cp_db(){

      global $wpdb;

      if( $wpdb->get_var("SHOW TABLES LIKE '". $this->category_table ."'") != $this->category_table ){

         $sql_exec = "CREATE TABLE " . $this->category_table . " (
           id bigint(9) NOT NULL AUTO_INCREMENT,
           s_id int(11) NOT NULL,
           c_name varchar(255) NOT NULL,
           c_value text NOT NULL,
           orderby int(11) NOT NULL,
           PRIMARY KEY (id),
           UNIQUE KEY id (id)
         ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
         dbDelta($sql_exec);

      }

      if( $wpdb->get_var("SHOW TABLES LIKE '". $this->item_table ."'") != $this->item_table ){

         $sql_exec = "CREATE TABLE " . $this->item_table . " (
           id bigint(9) NOT NULL AUTO_INCREMENT,
           c_id varchar(255) NOT NULL,
           s_id int(11) NOT NULL,
           s_name varchar(255) NOT NULL,
           s_value text NOT NULL,
           orderby int(11) NOT NULL,
           PRIMARY KEY (id),
           UNIQUE KEY id (id)
         ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
         dbDelta($sql_exec);

      }

   }
} 

} 

global $CodeStarSlideshows;
$CodeStarSlideshows = new CodeStarSlideshows();