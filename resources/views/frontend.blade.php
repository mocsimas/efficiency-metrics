<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.ico">
        <title>Efficiency metrics</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <noscript>
          <strong>We're sorry but frontend doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app"></div>

        @vite('resources/js/app.js')
    </body>
</html>
