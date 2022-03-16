<?php

namespace App\Http\Controllers\Traps;

use App\Helpers\Overview\AbstractOverviewController;
use App\Helpers\Overview\DataTables\DataTable;

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
        return [
            [
                'name' => 'Test 1',
                'description' => 'This is a test 1',
                'battery' => 5
            ]
        ];
    }
}
