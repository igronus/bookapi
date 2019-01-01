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

## Installation

```
git clone git@github.com:igronus/bookapi.git
cd bookapi
composer install
chown -R www-data:www-data storage
php artisan cache:clear
php artisan key:generate
cp .env.example .env
```

After that set up web-server to serve laravel or start server with `php artisan serve`.
