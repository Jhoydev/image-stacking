# Image stacking

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/Jhoydev/image-stacking.git
composer install
npm install
cp .env.example .env
```

Then create the necessary database.

```
create database image_stacking
```

And run the initial migrations

```
php artisan migrate
```


