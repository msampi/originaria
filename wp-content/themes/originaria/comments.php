<?php
/**
 * The template for displaying comments
 *
 * @package Originaria
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title alt-font text-extra-dark-gray margin-40px-bottom">
			<?php
			$originaria_comment_count = get_comments_number();
			if ( '1' === $originaria_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Un comentario en &ldquo;%1$s&rdquo;', 'originaria' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', $originaria_comment_count, 'comments title', 'originaria' ) ),
					number_format_i18n( $originaria_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 60,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Los comentarios están cerrados.', 'originaria' ); ?></p>
			<?php
		endif;

	endif;

	comment_form(
		array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title alt-font text-extra-dark-gray margin-40px-bottom">',
			'title_reply_after'  => '</h3>',
			'class_submit'       => 'btn btn-dark-gray btn-small',
			'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
		)
	);
	?>

</div>

