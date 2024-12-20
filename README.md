# Recreation Steps

1. Create a new project with `composer create-project slim/slim-skeleton [my-app-name]`
2. `cd [my-app-name]`
3. Add statsig-core-php to the project
   - Run `composer require statsig/statsig-core-php`
   - Add Post Install script to `composer.json`. eg `"post-install-cmd": [ "cd vendor/statsig/statsig-core-php && php post-install.php" ]`
   - Add Post Update script to `composer.json`. eg `"post-update-cmd": [ "cd vendor/statsig/statsig-core-php && php post-install.php" ]`
4. Add `Statsig` as a dependency in `app/dependencies.php`
5. Get an Experiment value in `app/routes.php`

---

# Slim Framework 4 Skeleton Application

[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/slimphp/Slim-Skeleton?branch=master)

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 7.4 or newer.

```bash
composer create-project slim/slim-skeleton [my-app-name]
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

- Point your virtual host document root to your new application's `public/` directory.
- Ensure `logs/` is web writable.

To run the application in development, you can run these commands

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:

```bash
cd [my-app-name]
docker-compose up -d
```

After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.
