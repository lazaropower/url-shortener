# URL Shortener

This is a simple URL shortener made with [Laravel 10](https://laravel.com/), [Vue.js 3](https://vuejs.org/) and [MySQL](https://www.mysql.com/downloads/).

## Requirements
You need to have the following things intalled on your machine:
* [PHP](https://www.php.net/downloads.php).
* [Docker](https://www.docker.com/products/docker-desktop/).
* [Node.js](https://nodejs.org/en/download).

## How to launch the project?

### Back-End

Copy the ```.env.example``` file and rename it to ```.env```. You can configure the following parameters and Docker container will automatically detect them, for example:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=backend
DB_USERNAME=user
DB_PASSWORD=user
DB_ROOT_PASSWORD=user
```
After that, you can run the following commands:

```bash
composer install       # Thiw will install the required composer dependencies.
docker-compose up -d   # This will launch the docker container with the MySQL database.
php artisan migrate    # This will apply all the required Laravel migrations.
php artisan serve      # This will launch the Back-End.
```

### Front-End

Copy the ```.env.example``` file and rename it to ```.env```. You can configure the following parameters and Docker container will automatically detect them, for example:

```
VITE_BACKEND_URL='http://127.0.0.1:8000/'   # By default this is the localhost url.
VITE_GOOGLE_API_KEY='your-google-api-key'   # Your google API key.
```
If you don't know how to get the Google Safe Browsing API key check [here](https://developers.google.com/safe-browsing/v4/get-started?hl=es-419).

After that, you can run the following commands:
```bash
npm install   # This will install the required dependencies. 
npm run dev   # This will launch the Front-End.
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.



## License

[MIT](https://choosealicense.com/licenses/mit/)