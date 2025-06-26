$(document).ready(function() {
    $(document).on('click', '.hamburger', function() {
        var $this = $(this),
            $parents = $this.parents('#masthead');
        $this.prop('disabled', true);
        $this.toggleClass('is-active');
        $parents.toggleClass('navbar-opened');
        setTimeout(function() {
            $this.prop('disabled', false);
        }, 500);
    });
    
    $(document).on('click', '.show-password', function(e) {
        e.preventDefault();
        var $this = $(this),
            $parent = $this.parents('.password-wrapper'),
            $icon = $this.find('[data-prefix="fa"]'),
            $input = $this.siblings('.input-control');
        if( $parent.hasClass('revealed') ) {
            $icon.toggleClass('fa-eye fa-eye-slash');
            $input.attr('type', 'password');
            setTimeout(function() {
                $parent.removeClass('revealed');
            }, 150);
        }
        else {
            $icon.toggleClass('fa-eye-slash fa-eye');
            $input.attr('type', 'text');
            setTimeout(function() {
                $parent.addClass('revealed');
            }, 150);
        }
    });
});