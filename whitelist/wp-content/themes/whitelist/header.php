<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package whitelist
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php if( is_user_logged_in() ) : ?>
	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<div class="navbar-row">
				<a href="<?php echo home_url();?>" class="navbar-brand">
					<?php
					$custom_logo_id = get_theme_mod('custom_logo');

					if ($custom_logo_id) {
						// Get logo image URL
						$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
						echo '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '">';
					} else {
						// Fallback: site title
						echo '<span class="site-title">' . get_bloginfo('name') . '</span>';
					}
					?>
				</a><!-- .site-branding -->
				<button class="menu-toggle hamburger hamburger--spin" aria-controls="primary-menu" aria-expanded="false">
					<span class="d-none">Menu</span>
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'menu-1',
						'menu_class'		=> 'navbar-nav',
						'menu_id'			=> 'primary-menu',
						'container_id'		=> 'menu-container',
						'container_class'	=> 'menu-container',
					)
				);
				?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<?php endif;?>