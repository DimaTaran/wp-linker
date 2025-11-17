## How to start

This app based on web application framework Laravel v12 

- git clone the repo
- create .env and fill out it with DB
- composer install
- npm install && npm run build
- php artisan key:generate , chmod -R 755 storage bootstrap/cache , php artisan storage:link
- php artisan migrate
- start page http://yout-domain/sites
- add a site http://yout-domain/sites/create
