const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/admin-lte/dist/css/adminlte.min.css', 'public/vendor/admin-lte/css')
   .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/vendor/admin-lte/js')
   .copy('node_modules/admin-lte/plugins', 'public/vendor/admin-lte/plugins')
   .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/vendor/bootstrap/css')
   .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/vendor/bootstrap/js')
   .copy('node_modules/jquery/dist/jquery.min.js', 'public/vendor/jquery')
   .copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/vendor/popper.js')
   .copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/vendor/fontawesome/css')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/vendor/fontawesome/webfonts');
