<?php

namespace App\Listeners;

use App\Events\TrapCatch;
use App\Jobs\SendTrapCatchSms;
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

        $emailUsers = User::where('notification_settings->notify_email', true)
            ->whereJsonContains('notification_settings->traps', $trap->id)
            ->orWhere([['notification_settings->notify_email', true], ['notification_settings->traps', '=', '[]']])
            ->get();

        $smsUsers = User::where('notification_settings->notify_sms', true)
            ->whereJsonContains('notification_settings->traps', $trap->id)
            ->orWhere([['notification_settings->notify_sms', true], ['notification_settings->traps', '=', '[]']])
            ->get();

        foreach ($smsUsers as $user) {
            SendTrapCatchSms::dispatch($trap, $user, $time);
        }

        foreach ($emailUsers as $user) {
            Mail::to($user->email)->queue(new TrapCatchMail($trap, $user, $time));
        }

        $sendUsers = array_merge_recursive_distinct($smsUsers, $emailUsers);
        foreach ($sendUsers as $user) {
            $user->newNotification('New catch at: ' . $trap->name, $trap);
        }
    }
}
