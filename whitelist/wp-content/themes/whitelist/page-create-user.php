<?php
/*
* Template name: Create User
*/

if( !is_user_logged_in() ) {
    wp_redirect(home_url());
    exit;
}

get_header();

?>
<main id="primary" class="site-main">
    <div class="wp-page-inner px-4 py-5 min-vh-100">
        <section class="section section-create-user">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 px-0">
                        <form class="wp-form wp-form-tab form-create-user p-0" id="form-create-user">
                            <div class="loading"><span class="loader"></span></div>
                            <div class="wp-form-row row-fields gap-0">
                                <div class="col-12 col-md-4 px-0">
                                    <div class="d-flex flex-wrap form-tab-header p-4 mb-4 mb-md-0">
                                        <h3>User Information</h3>
                                        <p>Lorem ipsum dolor, Ab neque, quibusdam eligendi sit amet consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 px-0 px-md-4">
                                    <div class="d-flex flex-wrap form-tab-body row-2-columns p-4">
                                        <div class="wp-form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" name="fullname" class="input-control" id="fullname"/>
                                        </div>
                                        <div class="wp-form-group">
                                            <label for="phone">Contact Number</label>
                                            <input type="text" name="phone" class="input-control" id="phone"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wp-form-row row-fields gap-0">
                                <div class="col-12 col-md-4 px-0">
                                    <div class="d-flex flex-wrap form-tab-header p-4 mb-4 mb-md-0">
                                        <h3>Login Access</h3>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab neque, quibusdam eligendi eveniet minus adipisci?</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 px-0 px-md-4 mb-5 mb-md-0">
                                    <div class="d-flex flex-wrap form-tab-body row-2-columns p-4">
                                        <div class="wp-form-group">
                                            <label for="user_login">Username</label>
                                            <input type="text" name="user_login" class="input-control" id="user_login"/>
                                        </div>
                                        <div class="wp-form-group">
                                            <label for="user_email">Email Address</label>
                                            <input type="email" name="user_email" class="input-control" id="user_email"/>
                                        </div>
                                        <div class="wp-form-group">
                                            <label for="user_password">Password</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="user_password" class="input-control" id="user_password"/>
                                                <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <div class="wp-form-group">
                                            <label for="user_password_repeat">Repeat Password</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="user_password_repeat" class="input-control" id="user_password_repeat"/>
                                                <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wp-form-row row-submit">
                                <div class="col-12 col-md-8 px-0 px-md-4 ms-auto me-0">
                                    <div class="d-flex flex-wrap">
                                        <div class="wp-form-group">
                                            <button type="submit" class="btn btn-submit me-0"><span>Login</span></button>
                                            <div class="error text-start"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
get_footer();
?>