<?php
/*	starting with bonus slider */
if( @$_GET["id"] == 1 ){
?>

<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>


<div class="postbox">

	<h3><span>Slide Layer 1</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Layer Type :</div>
			<div class="option_wrap">
				<?php render_item('select', 's_layer1_type', 'image,text,background',@$slider_item_value["s_layer1_type"], false, false, '_layer1_type' ); ?>
			</div>

			<ul id="layer1_types">
				<li id="layer1_image">
					<div class="option_set">

						<div class="option_title">Layer 1 as Image:</div>
						<div class="option_wrap">
							<?php render_item('upload', 's_layer1_image', @$slider_item_value["s_layer1_image"] ); ?>
						</div>
						<div class="clear"></div>

						<div class="option_title">Use TimThumb:</div>
						<div class="option_wrap">
							<?php render_item('on_off_ui', 's_layer1_timthumb', @$slider_item_value["s_layer1_timthumb"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
				<li id="layer1_text">
					<div class="option_set">

						<div class="option_title">Layer 1 as Text:</div>
						<div class="option_wrap">
							<a href="#" data-target="s_layer1_text" data-page="widget" class="codebox"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
							<?php render_item('textarea', 's_layer1_text', @$slider_item_value["s_layer1_text"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
				<li id="layer1_background">

					<div class="option_set">

						<div class="option_title">Layer 1 as Background:</div>
						<div class="option_wrap">
							<?php render_item('background', 's_layer1_background', @$slider_item_value["s_layer1_background"] ); ?>
						</div>
						<div class="clear"></div>

					</div>

				</li>
			</ul>


			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

      <div class="clear"></div>

	</div>

</div>


<div class="postbox">

	<h3><span>Slide Layer 2</span></h3>

	<div class="inside">

		<div class="option_set">

			<div class="option_title">Layer Type :</div>
			<div class="option_wrap">
				<?php render_item('select', 's_layer2_type', 'image,text',@$slider_item_value["s_layer2_type"], false, false, '_layer2_type' ); ?>
			</div>

			<ul id="layer2_types">
				<li id="layer2_image">
					<div class="option_set">

						<div class="option_title">Layer 2 as Image:</div>
						<div class="option_wrap">
							<?php render_item('upload', 's_layer2_image', @$slider_item_value["s_layer2_image"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
				<li id="layer2_text">
					<div class="option_set">

						<div class="option_title">Layer 2 as Text:</div>
						<div class="option_wrap">
							<a href="#" data-target="s_layer2_text" data-page="widget" class="codebox"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
							<?php render_item('textarea', 's_layer2_text', @$slider_item_value["s_layer2_text"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>



      <div class="clear"></div>

	</div>

</div>


<div class="postbox">

	<h3><span>Slide Layer 3</span></h3>

	<div class="inside">

		<div class="option_set">

			<div class="option_title">Layer Type :</div>
			<div class="option_wrap">
				<?php render_item('select', 's_layer3_type', 'image,text',@$slider_item_value["s_layer3_type"], false, false, '_layer3_type' ); ?>
			</div>

			<ul id="layer3_types">
				<li id="layer3_image">
					<div class="option_set">

						<div class="option_title">Layer 3 as Image:</div>
						<div class="option_wrap">
							<?php render_item('upload', 's_layer3_image', @$slider_item_value["s_layer3_image"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
				<li id="layer3_text">
					<div class="option_set">

						<div class="option_title">Layer 3 as Text:</div>
						<div class="option_wrap">
							<a href="#" data-target="s_layer3_text" data-page="widget" class="codebox"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
							<?php render_item('textarea', 's_layer3_text', @$slider_item_value["s_layer3_text"] ); ?>
						</div>
						<div class="clear"></div>

					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

      <div class="clear"></div>

	</div>

</div>


<div class="postbox">

	<h3><span>Slide Link</span></h3>

	<div class="inside">

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

	</div>

</div>

<?php } if( @$_GET["id"] == 2 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">
	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">
			<div class="option_title">Slide Content (optional) :</div>
			<div class="option_wrap">
				<?php render_item('textarea', 's_content', @$slider_item_value["s_content"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

	</div>

</div>
<?php } else if( @$_GET["id"] == 3 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">
	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

	</div>

</div>
<?php } else if( @$_GET["id"] == 4 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">
	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">
			<div class="option_title">Slide Content (optional) :</div>
			<div class="option_wrap">
				<?php render_item('textarea', 's_content', @$slider_item_value["s_content"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

	</div>

</div>
<?php } else if( @$_GET["id"] == 5 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">

	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">
			<div class="option_title">Slide Content (optional) :</div>
			<div class="option_wrap">
				<?php render_item('textarea', 's_content', @$slider_item_value["s_content"] ); ?>
			</div>
			<div class="clear"></div>
		</div>
      
      <div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
         
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

	</div>

</div>
<?php } else if( @$_GET["id"] == 6 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">
	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">
			<div class="option_title">Slide Content (optional) :</div>
			<div class="option_wrap">
				<?php render_item('textarea', 's_content', @$slider_item_value["s_content"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

	</div>

</div>
<?php } else if( @$_GET["id"] == 7 ){ ?>
<div id="titlediv">
	<div id="titlewrap">
		<div class="titleslide"><strong>Slide Title</strong> <em>(optional)</em></div>
		<?php render_item("input", "s_name", $slider_item_name); ?>
	</div>
</div>

<div class="postbox">
	<h3><span>Slide Custom Fields</span></h3>

	<div class="inside">

		<div class="option_set">
			<div class="option_title">Slide Featured Image :</div>
			<div class="option_wrap">
				<?php render_item('upload', 's_image', @$slider_item_value["s_image"] ); ?>
			</div>
			<div class="clear"></div>
		</div>
      
      <div class="option_set">
      
			<div class="option_title">Slide Content Position :</div>
			<div class="option_wrap">
				<?php render_item('select', 's_content_position', 'Bottom-Right,Bottom-Left,Top-Right,Top-Left', @$slider_item_value["s_content_position"]); ?>
			</div>

			<div class="clear"></div>
         
		</div>

		<div class="option_set">
			<div class="option_title">Slide Content (optional) :</div>
			<div class="option_wrap">
				<?php render_item('textarea', 's_content', @$slider_item_value["s_content"] ); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Type :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link', 'page,category,post,custom', @$slider_item_value["_post_link"], false, false, '_slider_link'); ?>
			</div>

			<ul id="link_types">
				<li id="link_page">
					<div class="option_set">

						<div class="option_title">Page Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]', @$slider_item_value["_post_link_page"]); ?>
						</div>

					</div>
				</li>
				<li id="link_category">
					<div class="option_set">

						<div class="option_title">Category Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]', @$slider_item_value["_post_link_category"]); ?>
						</div>

					</div>
				</li>
				<li id="link_post">
					<div class="option_set">
						<div class="option_title">Post Link :</div>
						<div class="option_wrap">
							<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]', @$slider_item_value["_post_link_post"]); ?>
						</div>
					</div>
				</li>
				<li id="link_custom">
					<div class="option_set">
						<div class="option_title">Custom Link :</div>
						<div class="option_wrap">
							<?php render_item('input', '_post_link_custom', @$slider_item_value["_post_link_custom"]); ?>
						</div>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
		</div>

		<div class="option_set">

			<div class="option_title">Link Target :</div>
			<div class="option_wrap">
				<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent', @$slider_item_value["_post_link_target"]); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>

	</div>

</div>
<?php } ?>