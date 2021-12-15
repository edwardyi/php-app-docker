<?php

namespace App\Listeners;

use App\Events\NewCustomerRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyViaSlackListener
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
        sleep(10);
        dump("notify slack inside listener");
    }
}
