<?php

use App\Events\SomeMessageEvent;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

/**
 * Dispatch a broadcast event.
 *
 * @return void
 */
Artisan::command('test:broadcast', function () {
    event(new SomeMessageEvent([
        'message' => 'Success'
    ]));
});