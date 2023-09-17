## Banking System

# Requirement
- Composer, PHP and Node     
- Minimum PHP 8.1     

# Steps
- Clone the repo
- `npm i`
- `npm run build`
- copy the content of `.env.example` to `.env` 
- `php artisan key:generate`
- `php artisan migrate` this will ask to create sqlite file. Please allow to continue
- `php artisan serve`
