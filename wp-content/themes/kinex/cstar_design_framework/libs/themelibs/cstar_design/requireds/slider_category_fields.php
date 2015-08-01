<?php if( $_GET["id"] == 1 ){ ?>

<div class="slider_form_field">


   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
   <div class="option_holder">
      <small>First slide's image will default for responsive</small>
      <label>A Picture for Responsive Layouts (optional)</label>
      <?php render_item('upload', 's_responsive', @$c_value["s_responsive"] ); ?>
   </div>

	<hr />

	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

			<div class="option_holder">
				<label>Slider effect</label>
				<?php render_item("select", 's_effect', "scrollUp=selected,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,blindX,blindY,blindZ,cover,curtainX,curtainY,fade,fadeZoom,growX,growY,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,wipe,zoom", @$c_value['s_effect']); ?>
			</div>

			<div class="option_holder">
				<label>Navigation ?</label>
				<?php render_item("on_off_ui", 's_nav', 'on', @$c_value['s_nav']); ?>
			</div>

			<div class="option_holder">
				<label>Full-width Slider ?</label>
				<?php render_item("on_off_ui", 's_fullwidth', @$c_value['s_fullwidth'], 'off'); ?>
			</div>

			<div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "0,100,1,px", @$c_value['s_margin']); ?>
			</div>
         
		</div>
	</div>


</div>

<?php } if( $_GET["id"] == 2 ){ ?>
<div class="slider_form_field">


	<div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

			<div class="option_holder">
				<label>Slider effect</label>
				<?php render_item("select", 's_effect', "random=selected,sliceDown,sliceDownLeft,sliceUp,sliceUpLeft,sliceUpDown,sliceUpDownLeft,fold,fade,slideInRight,slideInLeft,boxRandom,boxRain,boxRainReverse,boxRainGrow,boxRainGrowReverse", @$c_value['s_effect']); ?>
			</div>

			<div class="option_holder">
				<label>Slider slices</label>
				<?php render_item("slider_ui", 's_slices', "7,50,1", @$c_value['s_slices']); ?>
			</div>
			<div class="option_holder">
				<label>Slider boxcols</label>
				<?php render_item("slider_ui", 's_boxcols', "6,50,1", @$c_value['s_boxcols']); ?>
			</div>
         
			<div class="option_holder">
				<label>Slider boxrows</label>
				<?php render_item("slider_ui", 's_boxrows', "2,50,1", @$c_value['s_boxrows']); ?>
			</div>				
         
         <div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

         <div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "30,100,1,px", @$c_value['s_margin']); ?>
			</div>

			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>


			<div class="option_holder">
				<label>Border</label>
				<?php
					render_item('on_off_ui', 's_border', @$c_value["s_border"], 'on');
				?>
			</div>
         
         <hr style="border: dashed #ddd; border-width: 0 0 1px 0; clear: both;  padding-top:0px; margin-bottom:21px; height:1px; widtH:100%; display:block;"/>
         
         <div class="option_holder">
				<label>Thumbnail</label>
				<?php
					render_item('on_off_ui', 's_thumbnail', @$c_value["s_thumbnail"], 'off');
				?>
			</div>
         
         <div class="option_holder">
            <label>Thumbnail width</label>
            <?php render_item("slider_ui", 's_thumbnail_width', "70,250,1,px", @$c_value['s_thumbnail_width']); ?>
         </div>
         
         <div class="option_holder">
            <label>Thumbnail height</label>
            <?php render_item("slider_ui", 's_thumbnail_height', "50,250,1,px", @$c_value['s_thumbnail_height']); ?>
         </div>

		</div>
	</div>
</div>
<?php } if( $_GET["id"] == 3 ){ ?>

<div class="slider_form_field">

   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
   <div class="option_holder">
      <small>First slide's image will default for responsive or:</small>
      <label>Select a picture for Responsive (optional)</label>
      <?php render_item('upload', 's_responsive', @$c_value["s_responsive"] ); ?>
   </div>

	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>
			<div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "30,100,1,px", @$c_value['s_margin']); ?>
			</div>

			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>

			<div class="option_holder">
				<label>Border</label>
				<?php
					render_item('on_off_ui', 's_border', @$c_value["s_border"], 'on');
				?>
			</div>
		</div>
	</div>

</div>
<?php } if( $_GET["id"] == 4 ){ ?>

<div class="slider_form_field">

   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
   <div class="option_holder">
      <small>First slide's image will default for responsive or:</small>
      <label>Select a picture for Responsive (optional)</label>
      <?php render_item('upload', 's_responsive', @$c_value["s_responsive"] ); ?>
   </div>

	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

			<div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "30,100,1,px", @$c_value['s_margin']); ?>
			</div>

			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>

		</div>
	</div>

</div>
<?php } if( $_GET["id"] == 5 ){ ?>

<div class="slider_form_field">

   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
   <div class="option_holder">
      <small>First slide's image will default for responsive or:</small>
      <label>Select a picture for Responsive (optional)</label>
      <?php render_item('upload', 's_responsive', @$c_value["s_responsive"] ); ?>
   </div>  

	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "30,100,1,px", @$c_value['s_margin']); ?>
			</div>

			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>

		</div>
	</div>

</div>
<?php } if( $_GET["id"] == 6 ){ ?>

<div class="slider_form_field">

   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
   <div class="option_holder">
      <small>First slide's image will default for responsive or:</small>
      <label>Select a picture for Responsive (optional)</label>
      <?php render_item('upload', 's_responsive', @$c_value["s_responsive"] ); ?>
   </div>
   
	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

			<div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "40,100,1,px", @$c_value['s_margin']); ?>
			</div>

			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>

			<div class="option_holder">
				<label>Border</label>
				<?php
					render_item('on_off_ui', 's_border', @$c_value["s_border"], 'on');
				?>
			</div>

			<div class="option_holder">
				<label>Navigation (Buttons & Arrows)</label>
				<?php
					render_item('on_off_ui', 's_nav', @$c_value["s_nav"], 'on');
				?>
			</div>

		</div>
	</div>

</div>
<?php } if( $_GET["id"] == 7 ){ ?>

<div class="slider_form_field">

   <div class="option_holder">
		<label>Slider width</label>
		<?php render_item("slider_ui", 's_width', "960,960,1,px", @$c_value['s_width']); ?>
	</div>

	<div class="option_holder">
		<label>Slider height</label>
		<?php render_item("slider_ui", 's_height', "400,1000,1,px", @$c_value['s_height']); ?>
	</div>
   
	<div class="toggle_container">
		<h3 class="toggle<?php echo ( isset($_GET['edit_id']) )?' active':''; ?>">Slider Advanced Settings</h3>
		<div class="toggle_content"<?php echo ( isset($_GET['edit_id']) )?' style="display:block;"':''; ?>>

         <div class="option_holder">
				<label>Slider effect</label>
				<?php render_item("select", 's_effect', "fade=selected,slide", @$c_value['s_effect']); ?>
			</div>

			<div class="option_holder">
				<label>Slider delay</label>
				<?php render_item("slider_ui", 's_delay', "5,50,1,second", @$c_value['s_delay']); ?>
			</div>

			<div class="option_holder">
				<label>Slider Margin (optional)</label>
				<?php render_item("slider_ui", 's_margin', "30,100,1,px", @$c_value['s_margin']); ?>
			</div>
         
         <div class="option_holder">
				<label>Autoplay (Slideshow)</label>
				<?php
					render_item('on_off_ui', 's_autoplay', @$c_value["s_autoplay"], 'on');
				?>
			</div>
         
			<div class="option_holder">
				<label>Use TimThumb</label>
				<?php
					render_item('on_off_ui', 's_timthumb', @$c_value["s_timthumb"], 'on');
				?>
			</div>

			<div class="option_holder">
				<label>Border</label>
				<?php
					render_item('on_off_ui', 's_border', @$c_value["s_border"], 'on');
				?>
			</div>

			<div class="option_holder">
				<label>Control Navigation</label>
				<?php
					render_item('on_off_ui', 's_controlnav', @$c_value["s_controlnav"], 'on');
				?>
			</div>
         
         <div class="option_holder">
				<label>Direction Navigation</label>
				<?php
					render_item('on_off_ui', 's_directionnav', @$c_value["s_directionnav"], 'on');
				?>
			</div>

		</div>
	</div>

</div>
<?php } ?>