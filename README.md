# scraping master
# startup

1) `git clone git@gitlab.com:vladimir.malits/scraping-master.git`

2) `cd scraping-master`

3) `cp .env.example .env`

4) `php artisan key:generate`

5) `php artisan jwt:secret`

6) `cd laradock`

7) `cp .env.example .env`

8) `./run.sh` run docker containers

9) `./dc.sh` enter the workspace container, to execute commands like (Artisan, Composer, PHPUnit, …)

10) execute into container `composer install`

# Info
project running on: `http://localhost:9999`

api docs: `http://localhost:9999/api/documentation`  
