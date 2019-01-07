<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bookapi</title>
    </head>
    <body>
        <div id="app">
            <search></search>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
