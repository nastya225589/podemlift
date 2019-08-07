<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @if(isset($page))
            <title>{{ $page->meta_title ?: $page->name }}</title>
            @if ($page->meta_description)
                <meta content="{{ $page->meta_description }}" name="description">
            @endif
            @if ($page->meta_keywords)
                <meta content="{{ $page->meta_keywords }}" name="keywords">
            @endif
        @endif

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    </head>
    <body data-page="@yield('data-page')">
        <div class="page__inner">
            @include('blocks.header')

            <div class="page__content">
                @yield('content')
            </div>

            @include('blocks.footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
