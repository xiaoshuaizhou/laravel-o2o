<?php

namespace App\Listeners;

use App\Events\UserChangeStatus;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendChangeStatusEmail
{
    public $email;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserMailer $email)
    {
        $this->email = $email;
    }

    /**
     * Handle the event.
     *
     * @param  UserChangeStatus  $event
     * @return void
     */
    public function handle(UserChangeStatus $event)
    {
        $this->email->changeStatusSend($event->bis);
    }
}
