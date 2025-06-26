$(document).ready(function() {
    console.log('Login');

    $(document).on('submit', '#form-login', function(e) {
        e.preventDefault();
        var $this = $(this),
            $loading = $this.find('.loading'),
            $btn_submit = $this.find('button[type="submit"]'),
            $error = $this.find('.error'),
            $serialize = $this.serialize(),
            $formData = $serialize+'&action=wp_customize_login&nonce='+login.nonce;
        $.ajax({
            type: 'POST',
            url: login.ajax_url,
            data: $formData,
            beforeSend: function() {
                $loading.fadeIn();
                $error.hide().removeClass('success failed').html("");
                $btn_submit.prop('disabled', true);
                $this.addClass('disabled');
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 || $response.status == 2000 ) {
                    if( $response.status == 1000 ) {
                        $error.html($response.message).addClass('success');
                        location.reload();
                    }
                    else if( $response.status == 2000 ) {
                        $this.removeClass('disabled');
                        $btn_submit.prop('disabled', false);
                        $error.html($response.message).addClass('failed');
                    }
                }
                else {
                    $this.removeClass('disabled');
                    $btn_submit.prop('disabled', false);
                    $error.html("Something went wrong unexpectedly!").addClass('failed');
                }
                setTimeout(function() {
                    $error.fadeIn();
                }, 150);
            },
            error: function(xhr) {
                $loading.fadeOut();
                $this.removeClass('disabled');
                $btn_submit.prop('disabled', false);
                $error.html("Something went wrong unexpectedly!").addClass('failed');
                $error.fadeIn();
            }
        });
    });
});