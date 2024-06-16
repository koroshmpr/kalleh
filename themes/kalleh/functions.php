<?php
/**
 * Enqueue scripts and styles.
 */
function macan_scripts()
{
    wp_enqueue_style('Peyda', get_template_directory_uri() . '/public/fonts/Peyda/fontface.css', array());
//    wp_enqueue_style('IRANSansXFaNum', get_template_directory_uri() . '/public/fonts/IranSansFaNum/fontface.css', array());
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/public/css/style.css', array());
    wp_enqueue_script('main-js', get_template_directory_uri() . '/public/js/app.js', null, true);

    // Localize the script with custom_login_vars including the nonce value
    wp_localize_script('main-js', 'custom_login_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ajax-nonce')
    ));
}
add_action( 'wp_enqueue_scripts', 'macan_scripts' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function macan_setup() {
	register_nav_menu( 'headerMenuLocation', 'منوی اصلی' );
	register_nav_menu( 'footerLocationOne', 'منوی اول فوتر' );
	register_nav_menu( 'footerLocationTwo', 'منوی دوم فوتر' );
}

add_action( 'after_setup_theme', 'macan_setup' );

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'تنظیمات پوسته',
		'menu_title' => 'تنظیمات پوسته',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );
}
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

// Add AJAX handler for updating points
function update_user_points_ajax() {
    // Get current user ID
    $user_id = get_current_user_id();

    $response = array();
    // Check if user is logged in
    if ($user_id != 0) {
        // Get point value from AJAX request
        $point_value = isset($_POST['pointValue']) ? intval($_POST['pointValue']) : 0;
        error_log('Received point value: ' . $point_value);

        $current_points = get_user_meta($user_id, 'wps_wpr_points', true);
        $updated_points = intval($current_points) + $point_value; // Cast to integer before calculation
        error_log('Updated points: ' . $updated_points);
        error_log('User ID: ' . $user_id);

        update_user_meta($user_id, 'wps_wpr_points', $updated_points);

        $response['success'] = true;
        $response['message'] = 'Points updated successfully.';
    } else {
        $response['success'] = false;
        $response['message'] = 'User is not logged in.';
    }
// Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    // Always exit to avoid extra output
    exit;
}
add_action('wp_ajax_update_user_points', 'update_user_points_ajax');
function update_referral_ajax() {
    // Verify nonce
    if ( !isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax-nonce') ) {
        wp_send_json_error('Invalid nonce.');
    }

//    $userReferralId = isset($_POST['userReferralId']) ? intval($_POST['userReferralId']) : 0;
    $input_value = isset($_POST['userReferralId']) ? intval($_POST['userReferralId']) : 0;
    $userReferralId = ($input_value - 100000) / 300 ;
    $referalPoint = get_field('referalPoint' ,  get_option('page_on_front'));
    $points = get_user_meta($userReferralId, 'wps_wpr_points', true);
    $response = array();
    if ($userReferralId != 0) {
        $newPoints = $referalPoint + $points;

        // Update the referral points in the database
        update_user_meta($userReferralId, 'wps_wpr_points', $newPoints);

        // Prepare the response
        $response['success'] = true;
        $response['message'] = 'Referral points updated successfully.';
    } else {
        // If user ID is not provided or invalid
        $response['success'] = false;
        $response['message'] = 'Invalid user ID.';
    }

    // Return JSON response
    wp_send_json($response);
}
add_action('wp_ajax_update_referral_points', 'update_referral_ajax');

function check_user_existence_callback() {
    $input_value = isset($_POST['referal_id']) ? intval($_POST['referal_id']) : 0;
    $referal_id = ($input_value - 100000) / 300 ;


    // Check if the user exists
    $user = get_user_by('ID', $referal_id);
    $referalPoint = get_field('referalPoint' ,  get_option('page_on_front'));

    if ($user) {
        // Fetch points data from usermeta table
        $points = get_user_meta($referal_id, 'wps_wpr_points');

        // Prepare the response
        $response = array(
            'exists' => true,
            'points' => $points // Add user points to the response
        );

        // Send JSON success response with the user's points
        wp_send_json_success($response);
    } else {
        // Send JSON error response if user does not exist
        wp_send_json_error(array('exists' => false));
    }
}
add_action('wp_ajax_check_user_existence', 'check_user_existence_callback');