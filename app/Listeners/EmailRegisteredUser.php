<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailRegisteredUser implements ShouldQueue
{
    use InteractsWithQueue;
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        echo "kirim email ke : ".$event->email;
        // untuk release proses ketika gagal
        $this->release(30);
 
        // jika gagal 3x apa yang dilakukan
        if ($this->attempts() > 3) {
            //code
        }
    }
}
