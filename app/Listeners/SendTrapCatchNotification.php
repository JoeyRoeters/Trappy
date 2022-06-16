<?php

namespace App\Listeners;

use App\Events\TrapCatch;
use App\Mail\TrapCatchMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendTrapCatchNotification implements ShouldQueue
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
     * @param  TrapCatch  $event
     * @return void
     */
    public function handle(TrapCatch $event)
    {
        $trap = $event->trap;
        $time = $event->time;

        \Illuminate\Support\Facades\Log::info($trap->id);
        $emailUsers = User::where('notification_settings->notify_email', true)
            ->whereJsonContains('notification_settings->traps', $trap->id)
            ->orWhere([['notification_settings->notify_email', true], ['notification_settings->traps', '=', '[]']])
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
