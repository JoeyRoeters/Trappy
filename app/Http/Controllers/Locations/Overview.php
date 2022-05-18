<?php

namespace App\Http\Controllers\Locations;

use App\Helpers\Overview\AbstractOverviewController;
use App\Helpers\Overview\DataTables\DataTable;
use App\Models\Location;
use App\Models\Trap;

class Overview extends AbstractOverviewController
{
    protected function overview(): DataTable
    {
        $dataTable = DataTable::create('Locations');

        $dataTable->addHeader('name', 'Name');
        $dataTable->addHeader('description', 'Description');

        return $dataTable;
    }

    protected function getData(): array
    {
        $data = [];

        $locations = Location::get();
        foreach ($locations as $location) {
            $data[] = [
                'name' => $location->name,
                'description' => $location->description
            ];
        }

        return $data;
    }
}
