Pull Laravel/php project from git provider.
Rename .env.example file to .envinside your project root and fill the database information. (windows wont let you do it, so you have to open your console cd your project root directory and run mv .env.example .env )
Open the console and cd your project root directory
upload database todolist.sql 
setting env 
Run composer install or php composer.phar install
Run php artisan key:generate
Run php artisan serve
#####You can now access your project at localhost:8000 :)
