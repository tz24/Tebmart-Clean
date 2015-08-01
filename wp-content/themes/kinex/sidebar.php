<?php wp_reset_query(); ?>
<div id="sidebar"><?php if(isset($post)){get_theme_generator('sidebar_widgets',$post->ID);}else{get_theme_generator('sidebar_widgets');} ?></div>