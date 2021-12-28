<?php

namespace App\Listeners;

use App\Events\NewCustomerRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsLetterListener
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
     * @param  \App\Events\NewCustomerRegisteredEvent  $event
     * @return void
     */
    public function handle(NewCustomerRegisteredEvent $event)
    {
        dump("news letter listener");
    }
}