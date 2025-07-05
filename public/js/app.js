var common = {
    togglePassword: function (input_id) {
        let input = $('#' + input_id);
        let type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
    },
    dayNightSwitch: function () {
        if (window.matchMedia) {
            var body = $('body');

            if (localStorage.getItem('theme') !== null) {
                var theme = localStorage.getItem('theme');
                body.addClass('theme-' + theme);
                body.attr('data-bs-theme', theme);

                switch (theme) {
                    case 'dark':
                        $('.js-hide-theme-dark').addClass('d-none');
                        $('.js-hide-theme-light').removeClass('d-none');
                        break;
                    case 'light':
                        $('.js-hide-theme-dark').removeClass('d-none');
                        $('.js-hide-theme-light').addClass('d-none');
                        break;
                }
            } else {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    localStorage.setItem('theme', 'dark');
                    body.attr('data-bs-theme', 'dark');
                    $('.js-hide-theme-light').addClass('d-none');
                }

                if (window.matchMedia('(prefers-color-scheme: light)').matches) {
                    localStorage.setItem('theme', 'light');
                    body.attr('data-bs-theme', 'light');
                    $('.js-hide-theme-dark').addClass('d-none');
                }
            }
        }
    }
}

$(document).ready(function () {

    common.dayNightSwitch();
    let toggle = jQuery('.js-switch-light-dark-mode');
    if (toggle !== undefined) {
        toggle.on('click', function () {
            var body = $('body');
            body.toggleClass('theme-dark');

            if (body.hasClass('theme-dark')) {
                localStorage.setItem('theme', 'dark');
                body.attr('data-bs-theme', 'dark');
                $('.js-hide-theme-dark').addClass('d-none');
                $('.js-hide-theme-light').removeClass('d-none');
            } else {
                localStorage.setItem('theme', 'light');
                body.attr('data-bs-theme', 'light');
                $('.js-hide-theme-dark').removeClass('d-none');
                $('.js-hide-theme-light').addClass('d-none');
            }
        });
    }

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })



    $('.password-toggle').on('click', function () {
        let input_id = $(this).data('input-id');
        common.togglePassword(input_id);
    });
});
