<?php

namespace App\Http\Controllers\Traps;

use App\Helpers\Overview\AbstractOverviewController;
use App\Helpers\Overview\DataTables\DataTable;
use App\Models\Trap;

class Overview extends AbstractOverviewController
{
    protected function overview(): DataTable
    {
        $dataTable = DataTable::create('Traps');

        $dataTable->addHeader('name', 'Name');
        $dataTable->addHeader('description', 'Description');
        $dataTable->addHeader('battery', 'Battery %');

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
            ];
        }

        return $data;
    }
}
