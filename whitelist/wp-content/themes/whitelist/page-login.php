<?php
/*
* Template name: Home - Login
*/
get_header();

?>
<main id="primary" class="site-main">
    <section class="section section-login">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-xl-5 px-4">
                    <form class="wp-form form-login" id="form-login">
                        <div class="loading"><span class="loader"></span></div>
                        <div class="wp-form-row row-fields">
                            <div class="wp-form-group">
                                <div class="login-site-logo">
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
                                </div>
                            </div>
                            <div class="wp-form-group">
                                <label for="user_login">Username / Email Address</label>
                                <input type="text" name="user_login" class="input-control" id="user_login"/>
                            </div>
                            <div class="wp-form-group">
                                <label for="user_password">Password</label>
                                <div class="password-wrapper">
                                    <input type="password" name="user_password" class="input-control" id="user_password"/>
                                    <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="wp-form-row row-submit">
                            <div class="wp-form-group">
                                <button type="submit" class="btn btn-submit"><span>Login</span></button>
                                <div class="error text-center"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>