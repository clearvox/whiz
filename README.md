whiz
====

An Artisan Shell Package for Laravel

## Usage

Add the WhizServiceProvider to your providers in app.php

## The Shell Script

I didn't commit the shell script because it requires the full path to your application.

* Change the path location in the script below.
* Move it to /bin
* Edit /etc/shells
* Use chsh or edit /etc/passwd

```php
#!/usr/bin/env php
<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require '/path/to/laravel/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstrap the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight these users.
|
*/

$app = require_once '/path/to/laravel/bootstrap/start.php';

/*
|--------------------------------------------------------------------------
| Load The Artisan Console Application
|--------------------------------------------------------------------------
|
| We'll need to run the script to load and return the Artisan console
| application. We keep this in its own script so that we will load
| the console application independent of running commands which
| will allow us to fire commands from Routes when we want to.
|
*/

$app->setRequestForConsoleEnvironment();

$shell = new Symfony\Component\Console\Shell(Clearvox\Whiz\Application::start($app));

/*
|--------------------------------------------------------------------------
| Run The Artisan Application
|--------------------------------------------------------------------------
|
| When we run the console application, the current CLI command will be
| executed in this console and the response sent back to a terminal
| or another output device for the developers. Here goes nothing!
|
*/
$shell->run();


```

## Restricted Artisan Commands

If you want only a limited amount of commands to the Shell, pass true to the `Clearvox\Whiz\Application::start($app, true);`
then add a listener for 'whiz.start' to register your commands.

```php

$this->app->bind('command.private', '\Private\Command');

$commands = ['command.private'];

$this->app['events']->listen('whiz.start', function($whiz) use($commands)
{
    $whiz->resolveCommands($commands);
});
```
