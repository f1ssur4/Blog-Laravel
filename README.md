1) console: composer update

2) console: composer install

3) console: copy .env.example .env
3.1) Open .env and set your data in DB_DATABASE, DB_USERNAME, DB_PASSWORD

4) create database

5) console: php artisan migrate
   
if you need seeds: 
    console: php artisan db:seed --class=UsersSeeder
    console: php artisan db:seed --class=PostsSeeder
    console: php artisan db:seed --class=ReviewsSeeder
      
7) console: php artisan storage:link 

8) console: php artisan key:generate  

9) console: php artisan serve

10) go to localhost:8000
