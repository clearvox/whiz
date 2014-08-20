<?php
namespace Clearvox\Whiz;

class Application extends \Illuminate\Console\Application
{
    public static function start($app, $ownCommands = false)
    {
        return static::make($app)->boot($ownCommands);
    }

    public static function make($app)
    {
        $console = parent::make($app);

        $console->setName(\Config::get('whiz::name'));
        $console->setVersion(\Config::get('whiz::version'));

        return $console;
    }

    public function boot($ownCommands = false)
    {
        if (false === $ownCommands) {
            return parent::boot();
        } else {

            if (isset($this->laravel['events']))
            {
                $this->laravel['events']
                        ->fire('whiz.start', array($this));
            }

            return $this;
        }
    }
}