## scraping master


## startup

1) `git clone git@gitlab.com:vladimir.malits/scraping-master.git`

2) `cd scraping-master`

3) `cp .env.example .env`

4) `composer install`

5) `php artisan key:generate`

6) `cd laradock`

7) `cp .env.example .env`

8) `docker-compose up -d nginx pgsql workspace`

9) Enter the Workspace container, to execute commands like (Artisan, Composer, PHPUnit, Gulp, …)
   `docker-compose exec workspace bash`
