<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <title>To-do list</title>
    </head>
    <body>
        <div id="app">
            <app-root></app-root>
        </div>
        <script type="text/javascript" src="{{ mix('js/app.js')}}"></script>
    </body>
</html>