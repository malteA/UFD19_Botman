<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Middleware\ApiAi;

class BotmanController extends Controller
{
    public function handle()
    {
        $dialogflow = ApiAi::create(env('APIAI_KEY'))->listenForAction();

        $botman = app('botman');
        $botman->middleware->received($dialogflow);

        $botman->hears('/start', function ($bot) {
            $firstName = $bot->getUser()->getFirstName();
            $bot->reply('Hello '.$firstName);
        });

        $botman->hears('Test', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            $apiReply = $extras['apiReply'];
            $apiAction = $extras['apiAction'];
            $apiIntent = $extras['apiIntent'];

            $bot->reply('this is my reply');
        })->middleware($dialogflow);

        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Fallback');
        });

        $botman->listen();
    }
}