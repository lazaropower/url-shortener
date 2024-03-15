# URL Shortener

This is a simple URL shortener made with [Laravel 10](https://laravel.com/), [Vue.js 3](https://vuejs.org/) and [MySQL](https://www.mysql.com/downloads/).

## Requirements
You need to have the following things intalled on your machine:
* [PHP](https://www.php.net/downloads.php).
* [Docker](https://www.docker.com/products/docker-desktop/).
* [Node.js](https://nodejs.org/en/download).

## How it works?

You can introduce any URL you want, your desired folder and click on submit. Afer that we will check if there is any folder and url saved already in the database and just return it. If the url is new, we will make a request to the [Google Safe Browsing API](https://safebrowsing.google.com/) to make sure the URL does not contains any malware. 

In case of malware, we will not save or provide any shortened url. If the url is clean, we will proceed saving in the database the original url, the generated 6 characters hash and the folder and returning the shortened url to the Front-End.

Home page:

![image](https://github.com/lazaropower/url-shortener/assets/20268108/7bb1db92-6ea8-47c8-ade0-2925be3002f4)
![image](https://github.com/lazaropower/url-shortener/assets/20268108/56222e0f-8c5d-4740-87e3-a7ab6b1a1483)
![image](https://github.com/lazaropower/url-shortener/assets/20268108/0c6fb74c-608a-4d6d-8579-8f3778c74580)

Loading page:

![image](https://github.com/lazaropower/url-shortener/assets/20268108/aa9aedb1-0333-4eee-bb3a-595d847872d2)


404 Not Found:

![image](https://github.com/lazaropower/url-shortener/assets/20268108/e03c322b-16ab-4a36-8f78-05792253b6ca)

## Architecture
![Untitled-2024-02-19-1854](https://github.com/lazaropower/url-shortener/assets/20268108/dab8194d-a935-4406-81fc-ef411d27bd23)

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
Also you must enter your Google Safe Browser API Key:
```
GOOGLE_API_KEY=your-google-api-key
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
