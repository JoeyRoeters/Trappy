<?php

namespace App\Http\Controllers\Traps;

use App\Events\TrapCatch;
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
                'message' => 'Trap not found',
            ], 404);
        }

        if ($trap->status === 'inactive') {
            return response()->json([
                'message' => 'Trap not connected',
            ]);
        }

        if ($request->type === 'catch') {
            TrapCatch::dispatch($request->id);
        }

        TrapActivity::create([
            'trap_id' =>$trap->id,
            'type' => $request->type,
        ]);

        return response()->json([
            'message' => 'Activity created',
        ], 201);
    }
}
