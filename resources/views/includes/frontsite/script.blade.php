<!-- JS Global Compulsory  -->
<script src="{{ asset('front-design/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('front-design/assets/vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/hs-unfold/dist/hs-unfold.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/hs-toggle-switch/dist/hs-toggle-switch.min.js') }}"></script>
<script src="{{ asset('front-design/assets/vendor/aos/dist/aos.js') }}"></script>

<!-- JS Front -->
<script src="{{ asset('front-design/assets/js/theme.min.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
$(document).on('ready', function () {
    // INITIALIZATION OF HEADER
    // =======================================================
    var header = new HSHeader($('#header')).init();


    // INITIALIZATION OF MEGA MENU
    // =======================================================
    var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
    desktop: {
        position: 'left'
    }
    }).init();


    // INITIALIZATION OF UNFOLD
    // =======================================================
    var unfold = new HSUnfold('.js-hs-unfold-invoker').init();


    // INITIALIZATION OF TOGGLE SWITCH
    // =======================================================
    $('.js-toggle-switch').each(function () {
        var toggleSwitch = new HSToggleSwitch($(this)).init();
    });


    // INITIALIZATION OF AOS
    // =======================================================
    AOS.init({
        duration: 650,
        once: true
    });


    // INITIALIZATION OF GO TO
    // =======================================================
    $('.js-go-to').each(function () {
        var goTo = new HSGoTo($(this)).init();
    });
});
</script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="./assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
</script>


{{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

{{-- @livewireScripts --}}