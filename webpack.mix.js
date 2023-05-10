const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const assetPath = process.env.NODE_ENV === 'production' ? '/assets' : '/dev';
mix.js('resources/js/app.js', `public${assetPath}/js`)
    .postCss(`resources/css/app.css`, `public${assetPath}/css`, [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
mix.js('resources/assets/js/erp.js', `public${assetPath}/js`);
mix.sass(`resources/assets/sass/erp.scss`, `public${assetPath}/css`)
    .options({
        processCssUrls: false,
        postCss: [tailwindcss(__dirname + '/tailwind.config.js')],
    });

if (mix.inProduction()) {
    mix.version();
}
mix.browserSync(process.env.APP_URL);
