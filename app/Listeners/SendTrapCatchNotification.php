<?php

namespace App\Listeners;

use App\Events\TrapCatch;
use App\Mail\TrapCatchMail;
use App\Models\User;
use App\Traits\HasIdentifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendTrapCatchNotification implements ShouldQueue
{
    use HasIdentifier;

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
     * @param  TrapCatch  $event
     * @return void
     */
    public function handle(TrapCatch $event)
    {
        $trap = $this->identifyTrap($event->identifier);
        $time = $event->time;

        $emailUsers = User::where('notification_settings->notify_email', true)
            ->whereJsonContains('notification_settings->traps', $trap->id)
            ->get();

        //TODO
        $smsUsers = User::where('notification_settings->notify_sms', true)
            ->whereJsonContains('notification_settings->traps', $trap->id)
            ->get();

        foreach ($emailUsers as $user) {
            Mail::to($user->email)->queue(new TrapCatchMail($trap, $user, $time));
        }
    }
}
