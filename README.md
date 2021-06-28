## About the app

This is a personal website meant to represent my CV and my portfolio.
The app is served on Heroku at the following url: [https://simonebogni.herokuapp.com/](https://simonebogni.herokuapp.com/).

Because Heroku puts the apps to sleep when they are not used, please keep in mind that on the first connection the page might take some seconds to load completely.

The app is built in Laravel 8, using Bootstrap and Blade as a templating engine, and it has been built with responsiveness and accessibility in mind.
The RDBMS used is PostgreSQL, but it can also be efforlessly used with MySQL.

When instanciating the project locally, make sure to properly set the ENV variables.
I've provided seeders for the major database entities.
After the app has been built, remember to create and fill the database with the folling commands:

```
php artisan migrate:fresh
php artisan db:seed
```