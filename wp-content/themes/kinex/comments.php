<?php
function comment_theme($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author">
				<div class="gravatar">
					<?php echo get_avatar($comment,$size='60',$default=''); ?>
					<div class="comment-date"><?php echo get_comment_date(); ?></div>
				</div>
				<div class='comment-text'>
					<?php printf( '<cite class="author-name">%s</cite>', get_comment_author_link()) ?>
					<?php comment_text(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
					<span class="unapproved"><?php _e('Your comment is awaiting moderation.', T_NAME) ?></span>
					<?php endif; ?>
					<?php comment_reply_link(array_merge( $args, array('reply_text'=> __('(reply)', T_NAME ), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php edit_comment_link(__('(edit)', T_NAME ),'  ','') ?>
				</div>
			</div>
		</div>
<?php } ?>

<div id="comments">
	<?php if ( post_password_required() ) { ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', T_NAME ); ?></p>
	</div>
	<?php	return; } ?>

	<?php if ( have_comments() ) : ?>
	<h5 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), T_NAME ), number_format_i18n( get_comments_number() ), '"' . get_the_title() . '"' ); ?></h5>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', T_NAME ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', T_NAME ) ); ?></div>
		</div>
	<?php endif; ?>
	<ul class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'comment_theme' ) ); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
		<div class="post-navigation">
			<div class="post-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', T_NAME ) ); ?></div>
			<div class="post-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', T_NAME ) ); ?></div>
		</div>
	<?php endif; ?>
	<?php else: ?>
	<?php endif; ?>
	<?php if ( comments_open() ) { ?>
		<div id="respond">
			<h5><?php comment_form_title( __( 'Leave a Reply', T_NAME ), __( 'Leave a Reply to %s', T_NAME ) ); ?> <?php cancel_comment_reply_link(); ?></h5>
			<?php
			if ( get_option('comment_registration') && !is_user_logged_in() ) {
				printf( __('<p>You must be <a href="%s">logged in</a> to post a comment.</p>', T_NAME ), wp_login_url( get_permalink()) );
			} else {
			?>
			<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="sendcomment">
				<?php if ( is_user_logged_in() ) { ?>
				<div class="logged_out">
					<?php printf( __('Logged in as <a href="%1$s/wp-admin/profile.php">%2$s</a>.', T_NAME ), get_option('siteurl'), $user_identity ); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_html_e('Log out of this account', T_NAME); ?>"><?php esc_html_e('Log out &raquo;', T_NAME); ?></a>
				</div>
				<?php  } else { ?>
				<p>
					<input type="text" name="author" class="input" id="author" value="<?php echo $comment_author; ?>" size="30" tabindex="1"  />
					<label for="author"><?php _e('Name', T_NAME);  if ($req) _e(' (*)'); ?></label>
				</p>
				<p>
					<input type="text" name="email" class="input" id="email" value="<?php echo $comment_author_email; ?>" size="30" tabindex="2" />
					<label for="email"><?php _e('Email', T_NAME);  if ($req) _e(' ( * will not be published )', T_NAME); ?></label>
				</p>
				<p>
					<input type="text" name="url" class="input" id="email" value="<?php echo $comment_author_url; ?>" size="30" tabindex="3" />
					<label for="url"><?php _e('Website', T_NAME); ?></label>
				</p>
				<?php } ?>
				<p><textarea class="textarea" name="comment" id="comment" cols="70" rows="10" tabindex="4"></textarea></p>
				<p><a id="submit" class="cs-button <?php echo get_theme_option('advanced', 'button_color').' '.get_theme_option('advanced', 'button_size'); ?>" href="#" onclick="jQuery('#sendcomment').submit();return false;"><span><?php _e('Post Comment', T_NAME);?></span></a><?php comment_id_fields(); ?></p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
			<?php } ?>
		</div>
	<?php }  ?>
</div>