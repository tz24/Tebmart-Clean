<?php
/* Param check */
if ( empty( $_GET['group'] ) )
   die(1);

$shortcode_group = get_available_shortcodes( $_GET['group'] );
$shortcode_name = @$_GET["shortcode"];

$shortcode = $shortcode_group["options"][$shortcode_name];

/* Shortcode has atts */
if( isset($shortcode) ){
?>
<div id="sc-content">
   <table cellspacing="0" class="option_tables">
      <tbody>
         <?php if ( count( $shortcode['atts'] ) && $shortcode['atts'] ) { ?>
         <tr>
            <td>
               <?php foreach ( $shortcode['atts'] as $attr_name => $attr_info ) { ?>
               <table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
                  <tr>
                     <td class="sc_1"><div class="option_text"><?php echo $attr_info['desc'].":"; ?></div></td>
                     <td class="sc_2"><?php render_item($attr_info["type"], $attr_info['name'], @$attr_info['default'], false, @$attr_info['attr']); ?></td>
                  </tr>
               </table>
               <?php } ?>
            </td>
        </tr>
        <?php } ?>
        <?php if ( $shortcode['type'] != 'single' && $shortcode['type'] != 'multiple' && $shortcode['type'] != 'flexible' ) { ?>
        <tr>
            <td>
               <table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
                  <tr>
                     <td class="sc_1"><div class="option_text "><?php _e('Content', T_NAME); ?></div></td>
                     <td class="sc_2"><div class="option_textarea"><textarea name="shortcode-content" id="shortcode-content"><?php echo $shortcode['content']; ?></textarea></div></td>
                  </tr>
               </table>
            </td>
        </tr>
        <?php } ?>
      </tbody>
   </table>
</div><!-- end of content -->
<div id="sc-footer">
   <p><a data-type="insert" id="shortcode-insert" class="button-primary" href="#" style="color:#fff;">Insert</a> - <a data-type="preview" id="shortcode-insert" class="button-primary" href="#" style="color:#fff;">Preview</a></p>
</div>
<?php
}
$type_single	= (@$shortcode['type'] == 'single')?'true':'false';
$type_multiple	= (@$shortcode['type'] == 'multiple')?'true':'false';
$type_flexible	= (@$shortcode['type'] == 'flexible')?'true':'false';
$type_wrap		= (@$shortcode['type'] == 'wrap')?'true':'false';
$oneline			= (@$shortcode['oneline'] == true)?'true':'false';
$return 			= '<div id="shortcode-type" data-single="'.$type_single.'" data-oneline="'.$oneline.'" data-wrap="'.$type_wrap.'" data-multiple="'.$type_multiple.'" data-flexible="'.$type_flexible.'"></div><input type="hidden" name="shortcode-values" id="shortcode-values" value="" />';
echo $return;
?>