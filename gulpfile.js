var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // ADMIN

    mix.sass('admin/app.scss', 'public/css/admin.css')
        .copy('resources/assets/fonts/admin', 'public/fonts')
        .copy('resources/assets/js/admin', 'public/js/admin')
        .copy('resources/assets/js/jQuery-2.2.0.min.js', 'public/js/jquery.js')
        .copy('resources/assets/plugins/iCheck/square/blue.png', 'public/images/plugins/iCheck/square')
        .copy('resources/assets/plugins/iCheck/square/blue@2x.png', 'public/images/plugins/iCheck/square')
        .copy('resources/assets/plugins/iCheck/minimal/blue.png', 'public/images/plugins/iCheck/minimal')
        .copy('resources/assets/plugins/iCheck/minimal/blue@2x.png', 'public/images/plugins/iCheck/minimal')
        .copy('resources/assets/images/admin', 'public/images');

    mix.styles([
        '../plugins/datatables/dataTables.bootstrap.css',
        '../plugins/iCheck/square/blue.css',
        '../plugins/datepicker/datepicker3.css',
        '../plugins/iCheck/minimal/blue.css'
    ], 'public/css/plugins.css');

    mix.scripts([
        '../plugins/iCheck/icheck.min.js',
        '../foundry/js/timer.jquery.min.js',
        '../plugins/datepicker/bootstrap-datepicker.js',
        'admin/custom.js'
    ], 'public/js/plugins.js')
        .copy('resources/assets/plugins/datatables/jquery.dataTables.min.js', 'public/js/admin')
        .copy('resources/assets/plugins/datatables/dataTables.bootstrap.min.js', 'public/js/admin')
        .copy('resources/assets/plugins/chartjs/Chart.min.js', 'public/js/admin')
        .copy('resources/assets/js/consultant/custom.js', 'public/js/consultant');

    mix.copy('resources/assets/sounds/notification_sound.mp3', 'public/sounds/');

    // CONSULTANT

    // USER

    mix.less('frontend/theme.less', 'public/css/frontend.css')
        .copy('resources/assets/foundry/img', 'public/images')
        .copy('resources/assets/images/frontend', 'public/images')
        .copy('resources/assets/foundry/video', 'public/video')
        .copy('resources/assets/videos', 'public/video')
        .copy('resources/assets/fonts/frontend', 'public/fonts');
    mix.styles([
        '../foundry/css/bootstrap.min.css',
        '../foundry/css/themify-icons.css',
        '../foundry/css/flexslider.css',
        '../foundry/css/lightbox.min.css',
        '../foundry/css/ytplayer.css',
        '../plugins/datepicker/datepicker3.css',
        '../plugins/bootstrap-slider/slider.css'
    ], 'public/css/front-plugins.css');
    mix.styles([
        'frontend/tinymce.css'
    ], 'public/css/tinymce.css');
    mix.styles([
        'frontend/custom.css'
    ], 'public/css/front-custom.css')
        .copy('resources/assets/css/frontend/fonts.css', 'public/css');
    mix.scripts([
        '../foundry/js/jquery.min.js',
        '../foundry/js/bootstrap.min.js',
        '../foundry/js/flickr.js',
        '../foundry/js/flexslider.min.js',
        '../foundry/js/lightbox.min.js',
        '../foundry/js/masonry.min.js',
        '../foundry/js/twitterfetcher.min.js',
        '../foundry/js/spectragram.min.js',
        '../foundry/js/ytplayer.min.js',
        '../foundry/js/smooth-scroll.min.js',
        '../plugins/datepicker/bootstrap-datepicker.js',
        '../plugins/bootstrap-slider/bootstrap-slider.js',
        '../foundry/js/parallax.js',
        '../foundry/js/scripts.js',
        '../foundry/js/countdown.min.js',
        'frontend/custom.js'
    ], 'public/js/front-plugins.js');
});
