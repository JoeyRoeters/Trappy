<?php

namespace App\Traits;

use App\Models\Trap;
use Illuminate\Support\Facades\Hash;

trait HasIdentifier
{
    public function identifyTrap($identifier)
    {
        $traps = Trap::all();

        foreach ($traps as $trap) {
            if (Hash::check($identifier, $trap->identifier)) {
                return $trap;
            }
        }

        return null;
    }
}
