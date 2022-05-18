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
            'actions' => $this->getClosedTraps()
        ];

        return View('dashboards/overview', $parameters);
    }

    private function getClosedTraps(): array
    {
        $data = [];

        $traps = Trap::whereIsOpen(false)->get();
        foreach ($traps as $trap) {
            $location = $trap->location?->name ?: 'Not coupled';

            $data[] = [
                'name' => $trap->name,
                'location' => $location,
                'action' => 'The gate of the trap is closed'
            ];
        }

        return $data;
    }
}
