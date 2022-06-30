<?php

namespace App\Http\Controllers\Traps;

use App\Helpers\Overview\AbstractOverviewController;
use App\Helpers\Overview\ActionButton\ActionButton;
use App\Helpers\Overview\DataTables\DataTable;
use App\Models\Trap;

class Overview extends AbstractOverviewController
{
    protected function overview(): DataTable
    {
        $dataTable = DataTable::create('Traps', route('traps.create'));

        $dataTable->addHeader('name', 'Name');
        $dataTable->addHeader('description', 'Description');
        $dataTable->addHeader('battery', 'Battery %');
        $dataTable->addHeader('actions', 'Actions');

        return $dataTable;
    }

    protected function getData(): array
    {
        $data = [];

        $traps = Trap::get();
        foreach ($traps as $trap) {
            $data[] = [
                'name' => $trap->name,
                'description' => $trap->description,
                'battery' => $trap->battery,
                'actions' => ActionButton::create('fe-eye', route('traps.show', $trap), 'Show')->render(),
            ];
        }

        return $data;
    }
}
