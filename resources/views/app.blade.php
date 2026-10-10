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
        {{-- Each design ships its own stylesheet (tokens, fonts, components); only the active one is loaded. --}}
        @vite(['resources/js/app/client.ts', \App\Designs\SiteDesign::from($page['props']['design'])->stylesheet()])
        @inertiaHead
    </head>
    <body>
        @inertia
        @if ($page['props']['designPreview'] ?? null)
            {{-- Only admins see this: they are previewing a design that visitors don't see. --}}
            <aside aria-label="Design preview" style="position:fixed;inset-inline-start:16px;inset-block-end:16px;z-index:2147483647;display:flex;flex-wrap:wrap;align-items:center;gap:12px;max-width:calc(100vw - 32px);padding:10px 16px;border-radius:12px;background:#111;color:#fff;font:500 14px/1.4 system-ui,sans-serif;box-shadow:0 8px 24px rgba(0,0,0,.35)">
                <span>Previewing <strong>{{ $page['props']['designPreview']['label'] }}</strong> · visitors see {{ $page['props']['designPreview']['live'] }}</span>
                <a href="{{ url()->current() }}?design=live" style="color:#fff;text-decoration:underline;text-underline-offset:3px;min-height:24px;display:inline-flex;align-items:center">Exit preview</a>
                <a href="{{ url('/admin/appearance') }}" style="color:#fff;text-decoration:underline;text-underline-offset:3px;min-height:24px;display:inline-flex;align-items:center">Appearance settings</a>
            </aside>
        @endif
    </body>
</html>
