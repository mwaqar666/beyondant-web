<?php

if ($_SERVER['SERVER_NAME'] === 'dev.beyondant.com') {

    session_id("testing_site_session");
    session_start();

    [$devUsername, $devPassword] = ['testing', 'testing123'];

    if (
        ! isset($_SESSION['testingUsername'], $_SESSION['testingPassword'])
        ||
        ! ($_SESSION['testingUsername'] === $devUsername && $_SESSION['testingPassword'] === $devPassword)
    ) {
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $html = '
                <!doctype html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Testing Portal</title>
                </head>
                <body>
                    <form action="' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '" method="POST">
                        <input type="text" name="username">
                        <input type="password" name="password">
                        <input type="submit">
                    </form>
                </body>
                </html>
            ';

            echo $html;
            die();
        } else {
            [$inputUsername, $inputPassword] = [$_POST['username'], $_POST['password']];

            if ($inputUsername === $devUsername && $inputPassword === $devPassword) {
                // session_start();
                [$_SESSION['testingUsername'], $_SESSION['testingPassword']] = [$devUsername, $devPassword];
                header(
                    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
                );
            }
        }

        session_write_close();
    }
}

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
