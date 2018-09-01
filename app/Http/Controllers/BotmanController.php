<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;

class BotmanController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('/start', function ($bot) {
            $firstName = $bot->getUser()->getFirstName();
            $bot->reply('Hello '.$firstName);
        });

        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Fallback');
        });

        $botman->listen();
    }
}