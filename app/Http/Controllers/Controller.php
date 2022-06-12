<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function run()
    {
        $this->loadData();

        if ($this->exists()) {
            return $this->showPage();
        }

        return new View('404');
    }

    protected function exists(): bool
    {
        return true;
    }

    protected function loadData(): void
    {
    }
}
