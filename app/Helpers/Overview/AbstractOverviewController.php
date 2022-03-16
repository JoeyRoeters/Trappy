<?php

namespace App\Helpers\Overview;

use App\Helpers\Overview\DataTables\DataTable;
use App\Http\Controllers\Controller;
use View;

abstract class AbstractOverviewController extends Controller
{
    private DataTable $dataTable;
    private array $data;

    protected function loadData(): void
    {
        $this->dataTable = $this->overview();
        $this->data = $this->getData();
    }

    protected function showPage()
    {
        $dataTable = $this->dataTable;

        foreach ($this->data as $row) {
            $dataTable->addRow($row);
        }

        [$headers, $rows] = $dataTable->export();

        $parameters = [
            'title' => $dataTable->getName(),
            'headers' => $headers,
            'rows' => $rows
        ];

        return View('templates/overview', $parameters);
    }

    abstract protected function overview(): DataTable;

    abstract protected function getData(): array;
}
