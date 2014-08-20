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

require '/path/to/laravel/bootstrap/autoload.php';

$app = require_once '/path/to/laravel/bootstrap/start.php';
$app->setRequestForConsoleEnvironment();

$shell = new Symfony\Component\Console\Shell(Clearvox\Whiz\Application::start($app));
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
