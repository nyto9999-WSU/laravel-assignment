
IF YOU CANNOT RUN PROJECT PLEASE UPDATE COMPOSER  ```composer update --no-scripts```

FIrst time setup:
    step1
        - Run ```composer update --no-scripts```
    step2
    your local database connection in `.env`
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dev <-Your local db name
    DB_USERNAME=root
    DB_PASSWORD=root <-your may have db password
    
    
Laravel command

run server
`php artisan serve`

migrate model to local database
`php artisan migrate`

migrate model to local database and delete your database record
`php artisan migrate:fresh`

fake user data
`php artisan db:seed`

fake order*10 
`php artisan db:seed --class=OrderSeeder`

fake user*10
`php artisan db:seed --class=UserSeeder`

load route setting
`php artisan optimize` or `php artisan route:cache` 

