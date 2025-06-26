$(document).ready(function() {
    const input = document.querySelector("#phone");
    const iti = window.intlTelInput(input, {
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
        initialCountry: "my", 
    });

    $(document).on('submit', '#form-create-user', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error = $this.find('.error'),
            $loading = $this.find('.loading'),
            $serialize = $this.serialize();
        
        $loading.fadeIn();
        $this.find('.input-control').removeClass('focus-error');
        if (!iti.isValidNumber()) {
            $error.html("Please enter a valid contact number!").addClass('failed').fadeIn();
            $loading.fadeOut();
            $this.find('#phone').addClass('focus-error');
        }
        else {
            const phoneNumber = iti.getNumber();
            const dialcode = iti.getSelectedCountryData().dialCode;
            $formData = $serialize+'&mobile='+phoneNumber+'&dial_code='+dialcode+'&action=wp_create_new_user&nonce='+create_user.nonce;
            $.ajax({
                type: 'POST',
                url: create_user.ajax_url,
                data: $formData,
                beforeSend: function() {
                    $error.hide().html("").removeClass('success failed');
                    $this.addClass('disabled');
                },
                success: function(data) {
                    var $response = JSON.parse(data);
                    $loading.fadeOut();
                    if( $response.status == 1000 || $response.status == 2000 ) {
                        if( $response.status == 1000 ) {
                            $error.html($response.message).addClass('success').fadeIn();
                            $('#form-create-user')[0].reset();
                        }
                        if( $response.status == 2000 ) {
                            $error.html($response.message).addClass('failed').fadeIn();
                            if (Object.prototype.hasOwnProperty.call($response, 'error')) {
                                for (const slug in $response.error) {
                                    if (Object.prototype.hasOwnProperty.call($response.error, slug)) {
                                        $(`.input-control#${slug}`).addClass('focus-error');
                                    }
                                }
                            }
                        }
                    }
                    else {
                        $error.html("Something went wrong!").addClass('failed').fadeIn();
                    }
                    $this.removeClass('disabled');
                },
                error: function(xhr) {
                    $loading.fadeOut();
                    $error.html("Something went wrong!").addClass('failed').fadeIn();
                    $this.removeClass('disabled');
                }
            });
        }

    });
});