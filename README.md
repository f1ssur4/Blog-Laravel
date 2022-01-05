1) console: composer update

2) console: composer install

3) create database

4) console: copy .env.example .env
   4.1) Open .env and set your data in DB_DATABASE, DB_USERNAME, DB_PASSWORD 
   If you need work with "google reCAPTCHA" set data in NOCAPTCHA_SECRET, NOCAPTCHA_SITEKEY.

5)

6) 
      
7) console: php artisan migrate
       
 if you need seeds: 
     console: php artisan db:seed --class=UsersSeeder
     console: php artisan db:seed --class=PostsSeeder
     console: php artisan db:seed --class=ReviewsSeeder

8)  console: php artisan storage:link

9) console: php artisan key:generate 

10) console: php artisan serve

11) go to localhost:8000

To display test posts you need: Register and go to the admin panel, 
go to the posts table and publish all the posts you need.

Files and images for posts are stored in: storage/app/public/myImage.

