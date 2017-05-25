<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wpex_slides_metabox_settings() {
	$prefix = 'wpex_';
	return apply_filters( 'wpex_slides_metabox_settings', array(
		'id' 		=> 'wpex-slides-meta-box-slider',
		'title' 	=>  __( 'Post Options', 'portafolio' ),
		'page' 		=> 'slides',
		'context' 	=> 'normal',
		'priority'	=> 'high',
		'fields' 	=> array(
			array(
				'name'	=> __( 'Video URL', 'portafolio' ),
				'desc' 	=> __( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'portafolio' ) .' <a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'portafolio' ),
				'id' 	=> $prefix . 'slides_video',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> __( 'Link URL', 'portafolio' ),
				'desc' 	=> __( 'Enter a URL to link this slide to. Example: http://wpexplorer.com', 'portafolio' ) .'</a>',
				'id' 	=> $prefix . 'slides_url',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> __( 'Link Target', 'portafolio' ),
				'desc' 	=> __( 'Select a target for the URL.', 'portafolio' ) .'</a>',
				'id' 	=> $prefix . 'slides_url_target',
				'type'	=> 'select',
				'options' 	=> array(
					'self' 	=> 'self',
					'blank'	=> 'blank'
				)
			)
		),
	) );
}

/*-----------------------------------------------------------------------------------*/
// Display meta box in edit slides page
/*-----------------------------------------------------------------------------------*/
function wpex_add_box_slides_settings() {
	$meta_settings = wpex_slides_metabox_settings();
	add_meta_box(
		$meta_settings['id'],
		$meta_settings['title'],
		'wpex_show_box_slides_settings',
		$meta_settings['page'],
		$meta_settings['context'],
		$meta_settings['priority']
	);
}
add_action( 'add_meta_boxes', 'wpex_add_box_slides_settings' );

/*-----------------------------------------------------------------------------------*/
//	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function wpex_show_box_slides_settings() {
	global $post;

	$meta_settings = wpex_slides_metabox_settings();

	// Use nonce for verification
	echo '<input type="hidden" name="wpex_meta_box_nonce" value="' . esc_attr( wp_create_nonce( basename(__FILE__) ) ) .'" />';

	echo '<table class="form-table">';

	$count = 0;
	foreach ( $meta_settings['fields'] as $field ) :
		$count ++;

		// Get value
		$value = get_post_meta( $post->ID, $field['id'], true );

			// Set to default if empty
			if ( empty( $value ) && isset( $field['std'] ) ) {
				$value = $field['std'];
			}

			if ( $count > 1 ) {
				echo '<tr style="border-top:1px solid #eeeeee;">';
			} else {
				echo '<tr>';
			}

			// Text
			if ( 'text' == $field['type'] ) : ?>

				<th style="width:25%"><label for="<?php echo esc_attr( $field['id'] ); ?>"><strong><?php echo esc_html( $field['name'] ); ?></strong><span style=" display:block; color:#777; margin:5px 0 0 0;"><?php echo wp_strip_all_tags( $field['desc'] ); ?></span></label></th>
				<td>

				<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo $value; ?>" size="30" style="width:75%; margin-right: 20px; float:left;" />

			<?php

			//If Select
			elseif ( 'select' == $field['type'] ) : ?>

				<th style="width:50%"><label for="<?php echo esc_attr( $field['id'] ); ?>"><strong><?php echo esc_html( $field['name'] ); ?></strong><span style=" display:block; color:#777; margin:5px 0 0 0;"><?php echo wp_strip_all_tags( $field['desc'] ); ?></span></label></th>
				<td>

				<select name="<?php echo esc_attr( $field['id'] ); ?>">

				<?php foreach ( $field['options'] as $key => $label ) { ?>
					<option <?php selected( $value, $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php } ?>

				</select>

			<?php
			endif;

			echo '</tr>';

		endforeach;

	echo '</table>';
}

add_action( 'save_post', 'wpex_save_data_slides' );

/*-----------------------------------------------------------------------------------*/
//	Save data when slides is edited
/*-----------------------------------------------------------------------------------*/

function wpex_save_data_slides($post_id) {

	$meta_settings = wpex_slides_metabox_settings();

	if (!isset($_POST['wpex_meta_box_nonce'])) $_POST['wpex_meta_box_nonce'] = "undefine";

	// verify nonce
	if (!wp_verify_nonce($_POST['wpex_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ( 'page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can( 'edit_post', $post_id)) {
		return $post_id;
	}

	//Save fields
	foreach ($meta_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true );
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ( '' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}