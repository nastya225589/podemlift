<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @if(isset($seoData))
            <title>{{ $seoData->meta_title ?: $page->name }}</title>
            @if ($seoData->meta_description)
                <meta content="{{ $seoData->meta_description }}" name="description">
            @endif
            @if ($seoData->meta_keywords)
                <meta content="{{ $seoData->meta_keywords }}" name="keywords">
            @endif
        @elseif(isset($page))
            <title>{{ $page->meta_title ?: $page->name }}</title>
            @if ($page->meta_description)
                <meta content="{{ $page->meta_description }}" name="description">
            @endif
            @if ($page->meta_keywords)
                <meta content="{{ $page->meta_keywords }}" name="keywords">
            @endif
        @endif

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Play:400,700Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap&subset=cyrillic" rel="stylesheet">
        <script src="https://api-maps.yandex.ru/2.1/?apikey=e6985fd9-2ab1-469e-a04a-f5e8a4f661d9&lang=ru_RU"></script>
    </head>
    <body data-page="@yield('data-page')">
        <div class="page__inner">
            @include('blocks.header')

            <div class="page__content">
                @yield('content')
            </div>

            @include('blocks.footer')
        </div>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
