<?php

namespace App\Listeners;

use App\Event\UserRegistered;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    protected $mailer;

    /**
     * Create the event listener.
     * @param UserMailer $mailer
     *
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // 触发事件邮件发送
        $this->mailer->welcome($event->user);

        \Log::debug('send Email,'.$event->user->email);
    }
}
