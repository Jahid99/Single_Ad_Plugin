<?php  
/*
 *	Plugin Name: Single Advertise Plugin
 *	Plugin URI: http://www.techjahid.com
 *	Description: Allow you to post single ad on website.
 *	Version: 1.0
 *	Author: Jahidul Haque
 *	Author URI: http://www.techjahid.com
 *	License: J-Lab
 *
*/

$plugin_url = WP_PLUGIN_URL . '/single-advertise';
$options = array();

function single_ad_menu(){

	add_options_page(
		'Single Advertise Plugin',
		'Single Advertise',
		'manage_options',
		'single_ad_options',
		'single_ad_display'
	);
}

add_action('admin_menu', 'single_ad_menu');



function single_ad_display(){


	if (!current_user_can('manage_options' )){
		wp_die('You do not have enough permission to view this page');
	}

	global $plugin_url;
	global $options;

	if (isset($_POST['form_submit'])){
		
		// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );

	//echo $attachment_id;

	

	if ( is_wp_error( $attachment_id ) ) {
		echo 'Error uploading';
	} else {
		echo 'Uploaded successfully';
	}
	

			$title = esc_html($_POST['title'] );
			$description = esc_html($_POST['description'] );			

			$options['title'] = $title;
			$options['description'] = $description;
			$options['attachment_id'] = $attachment_id;
			$options['last_updated'] = time();
			update_option('single_ad', $options);

		

	}

	$options = get_option('single_ad');

	if ($options != ''){
		$title = $options['title'];
		$description = $options['description'];
		$attachment_id = $options['attachment_id'];

	}

	require('inc/options-page-wrapper.php');

}



	class Single_Advertise_Widget extends WP_Widget {
 
    /**
     * Constructs the new widget.
     *
     * @see WP_Widget::__construct()
     */
    function __construct() {
        // Instantiate the parent object.
        parent::__construct( false, __( 'Single Advertise Widget', 'textdomain' ) );
    }
 
    /**
     * The widget's HTML output.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
    function widget( $args, $instance ) {

    	extract($args);
    	$options = get_option('single_ad');

		if ($options != ''){
			$title = $options['title'];
			$description = $options['description'];
			$attachment_id = $options['attachment_id'];

		}

    	require ('inc/front-end.php');
    }
 
    /**
     * The widget update handler.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance The new instance of the widget.
     * @param array $old_instance The old instance of the widget.
     * @return array The updated instance of the widget.
     */
    function update( $new_instance, $old_instance ) {
        
       
    }
 
    /**
     * Output the admin widget options form HTML.
     *
     * @param array $instance The current widget settings.
     * @return string The HTML markup for the form.
     */
    function form( $instance ) {


    }
}
 
	add_action( 'widgets_init', 'single_ad_register_widgets' );
	 
	/**
	 * Register the new widget.
	 *
	 * @see 'widgets_init'
	 */
	function single_ad_register_widgets() {
	    register_widget( 'Single_Advertise_Widget' );
	}


	function single_ad_shortcode($atts, $content = null){

		global $post;

    	$options = get_option('single_ad');

		if ($options != ''){
			$title = $options['title'];
			$description = $options['description'];
			$attachment_id = $options['attachment_id'];
		}

	   	ob_start();

	   	require ('inc/front-end.php');

	   	$content = ob_get_clean();

	   	return $content;

}

add_shortcode('single_ad', 'single_ad_shortcode' );