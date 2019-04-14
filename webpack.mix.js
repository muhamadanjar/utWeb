let mix = require('laravel-mix');
mix.webpackConfig({
   module: {
      rules: [
         {
            test: /\.less$/,
            use: [{
               loader: 'css-loader' // translates CSS into CommonJS
            }, {
               loader: 'less-loader', // compiles Less to CSS
               
            }]            
         },
      ]
   }
});
mix.react('resources/assets/js/app.jsx', 'public/js')
mix
   .js('resources/assets/js/rm.js', 'public/js')
   .js('resources/assets/js/calculatesdiiri.js', 'public/js')
   .js('resources/assets/js/datatable_app.js', 'public/js')
   .js('resources/assets/js/map.js', 'public/js')
// .sass('resources/assets/sass/app.scss', 'public/css');
.copy('node_modules/ol-contextmenu/dist/ol-contextmenu.min.css','public/css/ol-contextmenu.min.css')
.copy('node_modules/ol-geocoder/dist/ol-geocoder.min.css','public/css/ol-geocoder.min.css')
mix.scripts([
   'public/js/rm.js',
   'public/js/datatable_app.js'
], 'public/js/all.js');