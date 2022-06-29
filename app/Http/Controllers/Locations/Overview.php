<?php

namespace App\Http\Controllers\Locations;

use App\Helpers\Overview\AbstractOverviewController;
use App\Helpers\Overview\ActionButton\ActionButton;
use App\Helpers\Overview\DataTables\DataTable;
use App\Models\Location;
use App\Models\Trap;

class Overview extends AbstractOverviewController
{
    protected function overview(): DataTable
    {
        $dataTable = DataTable::create('Locations', route('locations.create'));

        $dataTable->addHeader('name', 'Name');
        $dataTable->addHeader('description', 'Description');
        $dataTable->addHeader('actions', 'Actions');

        return $dataTable;
    }

    protected function getData(): array
    {
        $data = [];

        $locations = Location::get();
        foreach ($locations as $location) {
            $data[] = [
                'name' => $location->name,
                'description' => $location->description,
                'actions' => ActionButton::create('fe-eye', route('locations.show', $location), 'Show')->render(),
            ];
        }

        return $data;
    }
}
