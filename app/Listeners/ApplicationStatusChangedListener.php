<?php

namespace App\Listeners;

use App\Events\ApplicationStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationStatusChangedListener
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
     * @param  ApplicationStatusChanged  $event
     * @return void
     */
    public function handle(ApplicationStatusChanged $event)
    {
        //
    }
}
