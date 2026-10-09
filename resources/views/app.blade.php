<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Simone Bogni — Tech Lead and full-stack developer in Tel Aviv. Experience, portfolio and ways of working.">
        <meta property="og:title" content="Simone Bogni — Interactive CV and Portfolio">
        <meta property="og:description" content="Tech Lead and full-stack developer in Tel Aviv. Experience, portfolio and ways of working.">
        <meta property="og:type" content="website">
        <meta name="author" content="Simone Bogni">
        <meta name="color-scheme" content="light dark">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
        {{-- Apply a saved theme before the first paint, so the page never flashes the wrong colours. --}}
        <script>
            (function () {
                try {
                    var theme = localStorage.getItem('theme');
                    if (theme === 'light' || theme === 'dark') {
                        document.documentElement.dataset.theme = theme;
                    }
                } catch (e) {}
            })();
        </script>
        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
