<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Trap;
use App\Models\TrapActivity;

class Overview extends Controller
{
    protected function showPage()
    {
        $parameters = [];

        $parameters['title'] = 'Dashboard';
        $parameters['traps'] = [
            'total' => Trap::count(),
            'catches' => TrapActivity::whereType(TrapActivity::TYPE_CATCH)->count(),
            'activity' => TrapActivity::count(),
            'actions' => $this->getClosedTraps(),
        ];
        $parameters['activities'] = $this->getLatestActivities();

        return View('dashboards/overview', $parameters);
    }

    private function getClosedTraps(): array
    {
        $data = [];

        $traps = Trap::whereIsOpen(false)->get();
        foreach ($traps as $trap) {
            $data[] = [
                'name' => $trap->name,
                'location' => $trap->getLocationName(),
                'action' => 'The gate of the trap is closed',
            ];
        }

        return $data;
    }

    private function getLatestActivities(): array
    {
        $data = [];

        $activities = TrapActivity::whereType(TrapActivity::TYPE_CATCH)->orderByDesc('created_at')->take(5)->get();
        foreach ($activities as $activity) {
            $data[] = [
                'name' => $activity->trap->name,
                'location' => $activity->trap->getLocationName(),
                'date' => $activity->created_at?->format('d F H:i'),
                'url' => route('traps.id', $activity->trap_id),
            ];
        }

        return $data;
    }
}
