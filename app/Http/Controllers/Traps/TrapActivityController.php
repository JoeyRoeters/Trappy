<?php

namespace App\Http\Controllers\Traps;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrapActivityRequest;
use App\Models\TrapActivity;
use App\Traits\HasIdentifier;
use Illuminate\Http\JsonResponse;

class TrapActivityController extends Controller
{
    use HasIdentifier;

    public function store(StoreTrapActivityRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $trap = $this->identifyTrap($data->id);

        if (!$trap) {
            return response()->json([
                'message' => 'Trap not found'
            ], 404);
        }

        if ($trap->status === 'inactive') {
            return response()->json([
                'message' => 'Trap not connected'
            ]);
        }

        TrapActivity::create([
            'trap_id' =>$trap->id,
            'type' => $request->type
        ]);

        return response()->json([
            'message' => 'Status updated'
        ], 200);
    }
}
