<?php
/*
* Template name: Dashboard
*/

if( !is_user_logged_in() ) {
    wp_redirect(home_url());
    exit;
}

get_header();
?>
<main id="primary" class="site-main">
    <div class="wp-page-inner px-4 py-5 min-vh-100">
        Dashboard
    </div>
</main>
<?php
get_footer();
?>