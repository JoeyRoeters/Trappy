<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNotificationsRequest;
use App\Models\Trap;
use Auth;

class Notifications extends Controller
{
    protected function showPage()
    {
        $notification_settings = Auth::user()->notification_settings;

        $parameters = [];

        $parameters['title'] = 'Notifications';
        $parameters['traps'] = Trap::all('id', 'name');
        $parameters['notification_settings'] = [
            'notify_email' => $notification_settings['notify_email'],
            'notify_sms' => $notification_settings['notify_sms'],
            'traps' => $notification_settings['traps'],
        ];

        return View('settings/notifications', $parameters);
    }

    public function update(UpdateNotificationsRequest $request)
    {
        $notify_email = $request->has('notify_email');
        $notify_sms = $request->has('notify_sms');
        $traps = $request->get('traps') === null ? [] : $request->get('traps');

        Auth::user()->update([
            'notification_settings' => [
                'notify_email' => $notify_email,
                'notify_sms' => $notify_sms,
                'traps' => array_map('intval', $traps),
            ],
        ]);

        return back();
    }
}
