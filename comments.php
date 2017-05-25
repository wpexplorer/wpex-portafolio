 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * wpex_comment() which is located at functions/comments-callback.php
 *
 * @package   Portafolio WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright WPExplorer.com
 * @link      http://www.wpexplorer.com
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<section id="comments" class="comments-area <?php if ( ! comments_open() && get_comments_number() < 1 ) echo 'empty-closed-comments'; ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
        	<span>
				<?php
				// Get comments title
				$comments_number = number_format_i18n( get_comments_number() );
				if ( '1' == $comments_number ) {
					$comments_title = esc_html__( 'One Comment', 'portafolio' );
				} else {
					$comments_title = sprintf( esc_html__( '%s Comments', 'portafolio' ), $comments_number );
				}
				$comments_title = apply_filters( 'wpex_comments_title', $comments_title );
				echo esc_html( $comments_title ); ?>
            </span>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'wpex_comment', 'style' => 'ol' ) ); ?>
		</ol>

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation row clr" role="navigation">
			<h4 class="assistive-text section-heading heading"><span><?php _e( 'Comment navigation', 'portafolio' ); ?></span></h4>
			<div class="nav-previous span_12 col clr-margin"><?php previous_comments_link( __( '&larr; Older Comments', 'portafolio' ) ); ?></div>
			<div class="nav-next span_12 col"><?php next_comments_link( __( 'Newer Comments &rarr;', 'portafolio' ) ); ?></div>
		</nav>
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><i class="icon-remove-circle"></i><?php _e( 'Comments are closed.' , 'portafolio' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
    
	<?php comment_form(); ?>

</section><!-- #comments -->