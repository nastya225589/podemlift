<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
              rel="stylesheet">
        <script>
            document.querySelector('html').classList.replace('no-js', 'js');
            'ontouchstart' in window ? document.querySelector('html').classList.add('touch') : document.querySelector('html').classList.add('no-touch');
        </script>
    </head>
    <body>
        <div class="page__inner">
            @include('blocks.header')

            <div class="page__content">
                @yield('content')
            </div>

            @include('blocks.footer')
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
