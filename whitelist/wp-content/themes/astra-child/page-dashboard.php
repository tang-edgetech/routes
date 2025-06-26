<?php
/*
* Template name: Dashboard
*/

if( !is_user_logged_in() ) {
    wp_redirect(home_url('/dashboard'));
    exit;
}

get_header();
?>
<main id="primary" class="site-main">
    Dashboard
</main>
<?php
get_footer();
?>