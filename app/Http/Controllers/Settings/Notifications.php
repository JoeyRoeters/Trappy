<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNotificationsRequest;
use App\Models\Trap;
use Illuminate\Support\Facades\Auth;

class Notifications extends Controller
{
    protected function showPage()
    {
        $notificationSettings = Auth::user()->notification_settings;

        $parameters = [];

        $parameters['title'] = 'Notifications';
        $parameters['traps'] = Trap::all('id', 'name');
        $parameters['notification_settings'] = [
            'notify_email' => $notificationSettings['notify_email'],
            'notify_sms' => $notificationSettings['notify_sms'],
            'traps' => $notificationSettings['traps'],
        ];

        return View('settings/notifications', $parameters);
    }

    public function update(UpdateNotificationsRequest $request)
    {
        $notifyEmail = $request->has('notify_email');
        $notifySms = $request->has('notify_sms');
        $traps = $request->get('traps') === null ? [] : $request->get('traps');

        Auth::user()->update([
            'notification_settings' => [
                'notify_email' => $notifyEmail,
                'notify_sms' => $notifySms,
                'traps' => array_map('intval', $traps),
            ],
        ]);

        return back();
    }
}
