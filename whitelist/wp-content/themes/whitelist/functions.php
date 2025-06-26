<?php
/**
 * whitelist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package whitelist
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	// define( '_S_VERSION', '1.0.0' );
	define( '_S_VERSION', '1.0.'.time() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function whitelist_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on whitelist, use a find and replace
		* to change 'whitelist' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'whitelist', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'whitelist' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'whitelist_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'whitelist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function whitelist_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'whitelist_content_width', 640 );
}
add_action( 'after_setup_theme', 'whitelist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function whitelist_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'whitelist' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'whitelist' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'whitelist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function whitelist_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css', [], null);
    wp_enqueue_style('hamburgers', get_stylesheet_directory_uri() . '/css/hamburgers.min.css', [], null);
    wp_enqueue_style('intl-phone', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css', [], null);
	wp_enqueue_style('whitelist-style', get_stylesheet_directory_uri() . '/style.css', array(), _S_VERSION, 'all');
	
	wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.7.1.min.js', [], null, true);
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js', [], null, true);
	wp_enqueue_script('intl-phone', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js', [], _S_VERSION, true);
	wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', [], _S_VERSION, true);
	wp_localize_script('scripts', 'global', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('wp_global_nonce'),
	));

	if( is_page_template('page-login.php') ) {
		wp_enqueue_style('page-login', get_stylesheet_directory_uri() . '/css/page-login.css', [], _S_VERSION, 'all');
		wp_enqueue_script('page-login', get_stylesheet_directory_uri() . '/js/page-login.js', [], _S_VERSION, true);
		wp_localize_script('page-login', 'login', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('wp_login_nonce'),
		));
	}
	if( is_page_template('page-create-user.php') ) {
		wp_enqueue_script('page-create-user', get_stylesheet_directory_uri() . '/js/page-create-user.js', [], _S_VERSION, true);
		wp_localize_script('page-create-user', 'create_user', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('wp_create_user_nonce'),
		));
	}
	
    wp_enqueue_style('media-query', get_stylesheet_directory_uri() . '/css/media.css', [], null);
}
add_action( 'wp_enqueue_scripts', 'whitelist_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

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

function wp_password_validation($password, &$message = '') {
    if (strlen($password) < 8) {
        $message = 'Password must be at least 8 characters.';
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $message = 'Password must include at least one uppercase letter.';
        return false;
    }
    if (!preg_match('/[a-z]/', $password)) {
        $message = 'Password must include at least one lowercase letter.';
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        $message = 'Password must include at least one number.';
        return false;
    }
    if (!preg_match('/[\W]/', $password)) {
        $message = 'Password must include at least one special character.';
        return false;
    }

    $message = 'Password is strong.';
    return true;
}

function wp_create_new_user() {
	$response = array();
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wp_create_user_nonce')) {
		$response['status'] = 2000;
		$response['message'] = 'Invalid nonce validation!';
		echo json_encode($response);
		wp_die();
	}

	if( is_user_logged_in() ) {
		$user_login = sanitize_text_field($_POST['user_login']);
		$user_email = sanitize_email($_POST['user_email']);
		$user_password = sanitize_text_field($_POST['user_password']);
		$user_password_repeat = sanitize_text_field($_POST['user_password_repeat']);
		$fullname = sanitize_text_field($_POST['fullname']);
		$dial_code = sanitize_text_field($_POST['dial_code']);
		$mobile = sanitize_text_field($_POST['mobile']);
		if( empty(trim($fullname)) ) { 
			$response['status'] = 2000;
			$response['message'] = 'Fullname must not be empty!';
			$response['error']['fullname'] = true;
		}
		else {
			if ( strlen($user_login) == 0 || !preg_match('/^[a-z0-9\-]+$/', $user_login)) {
				$response['status'] = 2000;
				$response['message'] = 'Invalid username format (eg: temp-admin). Only lowercase letters, numbers, and hyphens are allowed.';
				$response['error']['user_login'] = true;
			}
			else {
				if( username_exists($user_login) ) {
					$response['status'] = 2000;
					$response['message'] = 'This username has been taken! Please try another username.';
					$response['error']['user_login'] = true;
				}
				else {
					if( !is_email($user_email) ) {
						$response['status'] = 2000;
						$response['message'] = 'This is an invalid email address!';
						$response['error']['user_email'] = true;
					}
					else {
						if( email_exists($user_email) ) {
							$response['status'] = 2000;
							$response['message'] = 'This email address has been taken! Please try another email address.';
							$response['error']['user_email'] = true;
						}
						else {
							$valid = wp_password_validation($user_password, $return_message);
							if( !$valid ) {
								$response['status'] = 2000;
								$response['message'] = $return_message;
								$response['error']['user_password'] = true;
							}
							else {
								if( $user_password_repeat === $user_password ) {
									$user_id = wp_create_user($user_login, $user_password, $user_email);
									if (is_wp_error($user_id)) {
										$response['status'] = 2000;
										$response['message'] = $user_id->get_error_message();
									}
									else {
										$user = new WP_User($user_id);
										$user->set_role('editor');
										wp_update_user([
											'ID'           => $user_id,
											'first_name'   => $fullname,
											'display_name' => $fullname,
											'nickname'     => $fullname
										]);
										update_field('user_information', array(
											'dial_code' => $dial_code,
											'mobile' => $mobile,
										), 'user_' . $user_id);

										$response['status'] = 1000;
										$response['message'] = 'New user "<b>'.$user_login.'</b>" is created successfully!';
									}
								}
								else {
									$response['status'] = 2000;
									$response['message'] = 'The repeated password is inaccurate!';
									$response['error']['user_password_repeat'] = true;
								}
							}
						}
					}
				}
			}
		}
	}
	else {
		$response['status'] = 2000;
		$response['message'] = 'This is an unauthorized access!';
	}

	echo json_encode($response);
	wp_die();
}
add_action('wp_ajax_wp_create_new_user', 'wp_create_new_user');
add_action('wp_ajax_nopriv_wp_create_new_user', 'wp_create_new_user');