<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Open Graph properties for LinkedIn scraper -->
        <meta name="title" property="og:title" content="Interactive CV and Portfolio">
        <meta name="image" property="og:image" content="https://lh3.googleusercontent.com/pw/AM-JKLUWqC3ih7dLnmyK9421ReZh4JiDyfavRFAJTrCl_1HSaJddHTiNViHbLtX-Wkl-WggYBSAO1IFwJDDUY-56SgPB6AnbcZnLuWY5-k5G7GNXRt-Lk842KpwK2HS1QuDrt6ccjnsntRuArgJAbiXDwHI=w1341-h655-no?authuser=0">
        <meta name="description" property="og:description" content="A responsive RESTful web application built with Laravel 8, SASS, Bootstrap and Blade template engine. The data is stored on a PostgreSQL database and the website is available on Heroku.">
        <meta property="og:type" content="Web application">
        <meta name="author" content="Bogni Simone">

        <title>{{ config('app.name', 'Bogni Simone - Web developer') }}</title>
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon/favicon-16x16.png')}}">
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        @yield('styles-html-head')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        @yield('scripts-html-head')
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app" verbosity="true" showTags="true">
            <x-custom-navbar/>
            <main class="container-fluid content">
                @yield('content')
            </main>
            <x-footer/>
        </div>
    </body>
    @yield('scripts')
</html>
