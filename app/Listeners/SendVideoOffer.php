<?php

namespace App\Listeners;

use App\Events\BroadcastingVideo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVideoOffer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BroadcastingVideo  $event
     * @return void
     */
    public function handle(BroadcastingVideo $event)
    {
        return $event->message;
    }
}
