<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
// define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.'.time() );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css', [], null);
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	
	wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.7.1.min.js', [], null, true);
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js', [], null, true);
	wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', [], CHILD_THEME_ASTRA_CHILD_VERSION, true);
	wp_localize_script('scripts', 'global', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('wp_global_nonce'),
	));

	if( is_page_template('page-login.php') ) {
		wp_enqueue_style('page-login', get_stylesheet_directory_uri() . '/css/page-login.css', [], CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
		wp_enqueue_script('page-login', get_stylesheet_directory_uri() . '/js/page-login.js', [], CHILD_THEME_ASTRA_CHILD_VERSION, true);
		wp_localize_script('page-login', 'login', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('wp_login_nonce'),
		));
	}
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function add_attributes_to_bootstrap($html, $handle) {
    if ('bootstrap-css' === $handle) {
        $integrity = 'sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr';
        $html = str_replace('/>', ' integrity="' . $integrity . '" crossorigin="anonymous" />', $html);
    }
    return $html;
}
add_filter('style_loader_tag', 'add_attributes_to_bootstrap', 10, 2);

function add_crossorigin_to_jquery($tag, $handle) {
    if ('jQuery' === $handle) {
        $integrity = 'sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=';
        return str_replace(' src', ' integrity="' . $integrity . '" crossorigin="anonymous" src', $tag);
    }
    else if ('bootstrap-js' === $handle) {
        $integrity = 'sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q';
        return str_replace(' src', ' integrity="' . $integrity . '" crossorigin="anonymous" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_crossorigin_to_jquery', 10, 2);

function wp_users_traffic() {
	if( is_user_logged_in() ) {
		if( is_page_template('page-login.php') ) {
            wp_redirect(home_url('/dashboard'));
            exit;
		}
	}
	else {
		
	}
}
add_action('template_redirect', 'wp_users_traffic');

function wp_customize_login() {
	$response = array();
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wp_login_nonce')) {
		$response['status'] = 2000;
		$response['message'] = 'Invalid nonce validation!';
		echo json_encode($response);
		wp_die();
	}

	if( is_user_logged_in() ) {
		$response['status'] = 2000;
		$response['message'] = 'You had already logged in!';
	}
	else {
		if( empty($_POST['user_login']) || empty($_POST['user_password']) ) {
			$response['status'] = 2000;
			$response['message'] = 'Invalid username or password!';
			if( empty($_POST['user_login']) ) {
				$response['error']['user_login'] = 'The username is empty!';
			}
			if( empty($_POST['user_password']) ) {
				$response['error']['password'] = 'The password is empty!';
			}
			echo json_encode($response);
			wp_die();
		}
		$user_login = sanitize_text_field($_POST['user_login']);
    	$user = get_user_by('login', $user_login);
    	$password = $_POST['user_password'];
		if(!$user) {
        	$user = get_user_by('email', $user_login);
		}

		if($user) {
			if (wp_check_password($password, $user->user_pass, $user->ID)) {
				$creds = [
					'user_login'    => $user->user_login,
					'user_password' => $password,
					'remember'      => !empty($_POST['rememberme']),
				];
				
				$signon = wp_signon($creds, false);
				if (is_wp_error($signon)) {
					$response['status'] = 2000;
					$response['message'] = 'Invalid username or password!';
					$response['error']['signon'] = 'Login failed: ' . $signon->get_error_message();
				}
				else {
					$response['status'] = 1000;
					$response['message'] = 'Login successfully!';
					$response['redirection'] = true;
				}
			}
			else {
				$response['status'] = 2000;
				$response['message'] = 'Invalid username or password!';
				$response['error']['password'] = 'Password inaccurate!';
			}
		}
		else {
			$response['status'] = 2000;
			$response['message'] = 'Invalid username or password!';
			$response['error']['user'] = 'The user is not found!';
		}
	}

	echo json_encode($response);
	wp_die();
}
add_action('wp_ajax_wp_customize_login', 'wp_customize_login');
add_action('wp_ajax_nopriv_wp_customize_login', 'wp_customize_login');