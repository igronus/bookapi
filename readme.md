## Task

```
Build a books search application. 

Using your service, users should be able to:
1. Find book by name and/or author
2. Get list of books with preview and short description 
Feel free to add any features, such as modern interactive UI, tests, sorting, offline work, authorisation, API and etc. 
Api example - https://www.googleapis.com/books/v1/volumes?q=Stephen+King

Requirements:
- any modern framework (e.g. Symphony 3+)
```

## Solution

This project runs on laravel 5.5 on the backend and vue.js 2.5 on the frontend.

Live demo is available at: http://bookapi.pellinen.ru/

## Installation

Just follow next instructions:

```
git clone git@github.com:igronus/bookapi.git
cd bookapi
composer install
chown -R www-data:www-data storage
cp .env.example .env
php artisan cache:clear
php artisan key:generate
```

After that set up web-server to serve laravel or start server with `php artisan serve`.

### Frontend developing

Run `npm ci` to install dependencies and `npm run dev` to build public/js/app.js.

If it doesn't work, check you have latest stable npm and node installed and do the following:

```
rm -rf node_modules
rm package-lock.json yarn.lock
npm cache clear --force
npm install
```
### Testing

Execute `./vendor/bin/phpunit` to test project components.
