<p align="center">
    <a href="https://github.com/LeafOS-Project">
    <img src="https://i.imgur.com/G0gNZxg.png"/>
</p>
<h2 align="center">LeafOS</h2>

## 1. Getting started
The LeafOS website runs on Symfony 6.2. You can check the [Symfony documentation](https://symfony.com/doc/current/setup.html) for the framework requirements. There are no additional requirements other than those.

After the requirements have been met, you can install the required dependencies by running `composer install`.

## 2. Running the site
There are two ways to run the site locally: by using PHP built-in webserver or by using Apache/Nginx.

### Method 1: Using the PHP built-in server
After you've installed the required dependencies, you can start the PHP server by running the following command from the project root:

```
php -S localhost:8000 -t public/
```

After that, you can check the site by going to [localhost:8000](localhost:8000) on your browser. If the port 8000 is in use in your machine, simple change it to something else.

### Method 2: using Apache/Nginx
Both Apache and Nginx are supported by Symfony. There is a dedicated section on Symfony documentation for that, please refer to [this page](https://symfony.com/doc/current/setup/web_server_configuration.html) in order to configure Apache/Nginx.

