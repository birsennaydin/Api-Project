
## Api-Project
- API
- Purchase
- Subscription
- Worker/Job
- Database Report

## API
- Passport api was used for testing (You can find in app.php file)
- Native Laravel API support was used(app.php)
- Guzzle Basic Auth

## Worker
- Native Laravel Job process support was used. If your want you can see under the app/Job. 
- Can be set to work automatically in the desired time zone (Console/Kernel)
- Traits
- Controller
### Database Logic
- If you want see database logic You can find sql file under the database/ (File name is api-project.sql)

# Usage
To run this demo you'll need to have Mysql, Apache, Php installed
- Clone the repo
- Install the dependencies with composer install
- Copy .env.example to .env
- Create a  database
- Run php artisan key:generate
- Run php artisan migrate

# Tecnical Details
- Php 7.4.20
- Laravel 8.63.0
- Apache
- Mysql
- Passport

# Informations
 I did not use Passport as it did not fit the project scenario, but I installed and tested it to show how it is used. It's ready, you can use it easily if you want, I've set it to get a bearer token for the app and make requests.
