# scraping master
# startup

$ `git clone git@gitlab.com:vladimir.malits/scraping-master.git`

$ `cd scraping-master`

$ `cp .env.example .env`

$ `php artisan key:generate`

$ `php artisan jwt:secret`

$ `./dc.sh composer install`

$ `./dc.sh php artisan test`

# Info
project running on: `http://localhost:9999`

api docs: `http://localhost:9999/api/documentation`  
