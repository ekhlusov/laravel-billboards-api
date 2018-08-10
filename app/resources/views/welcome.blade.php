<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

        <script>

        </script>
    </head>
    <body>
            <div class="content">
                <style>
                    html, body, #map {
                        width: 100%; height: 100vh; padding: 0; margin: 0;
                    }
                </style>
                <div id="map"></div>
            </div>
        </div>
    </body>
</html>
