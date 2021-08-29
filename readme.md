# Chat Application

## Installation & Local Run

## Technologies
Project is created with:
* php: 7.4 
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* composer
* mysql: 5.7

```
git clone https://github.com/artashvt/chat-app.git
cd chat-app
composer install --no-dev -o
```

### Set the access credentials in .env

```
cp .env.example .env
```
Fill right credentials in .env

### Complete the deployment process
```
php artisan key:generate
php artisan migrate
```

### Run

```
php artisan serve
```

## Installation with Docker and Run

```
git clone https://github.com/artashvt/chat-server.git
cd chat-server
```

### Set the access credentials in .env.js
```
cp env.js.example env.js
```
Fill right credentials in .env for mysql can use this
* DB_CONNECTION=mysql
* DB_HOST=db
* DB_PORT=3306
* DB_DATABASE=chatdb
* DB_USERNAME=chatuser
* DB_PASSWORD=chatpassword

### Complete the deployment process
```
docker-compose build app
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

### Run

```
docker-compose up -d    
```
