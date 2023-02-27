# Installation

- git clone git@github.com:Galinka999/Album-singers.git .
- cp .env.example .env  !!! IMPORTANT
- set up database connection (PostgreSQL)
- composer install
- docker compose build
- docker compose up -d
- ./vendor/bin/sail artisan migrate --seed

Open Api documentation: http://localhost/api/documentation

# Deploy
