<?php
    use BotMan\BotMan\BotMan;
    use App\Http\Controllers\BotmanController;
    use Illuminate\Support\Facades\Log;


    $botman = resolve('botman');
    Log::info('botman');

    $botman->hears('Hi', function ($bot) {
        Log::info('botman heared Hi');
        $bot->reply('Hello!');
    });

    $botman->hears('/start', function ($bot) {
        $bot->reply(
            'Before you use this service you have to link this messenger with the finn app! Use /link to get started or /help to see all available commands.');
    });

    $botman->hears('Start conversation', BotmanController::class.'@startConversation');