## About the app

This is a personal website meant to represent my CV and my portfolio.
The app is served on Laravel Cloud at the following url: [https://simone-bogni-portfolio.laravel.cloud/](https://simone-bogni-portfolio.laravel.cloud/)

Because I'm using app hibernation, please keep in mind that on the first connection the page might take some seconds to load completely.

The app is built in Laravel 13 with Vue 3 and Inertia (server-side rendered), and it has been built with responsiveness and accessibility in mind.
The admin panel uses Filament.
The RDBMS used is PostgreSQL, but it can also be efforlessly used with MySQL.

## Front end

The public pages are Vue single-file components rendered through Inertia, with server-side rendering (SSR).
The site has several designs that can be switched from the admin panel (**Appearance**), with a private preview mode for the admin.
See [docs/frontend.md](docs/frontend.md) for the architecture, the designs, the design tokens and how to run it locally.
