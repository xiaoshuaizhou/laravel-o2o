<?php

namespace App\Listeners;

use App\Events\UserRegister;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail
{
    public $email;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserMailer $userMailer)
    {
        $this->email = $userMailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $this->email->registerSend($event->bis);
    }
}
