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

    public function sync(StoreTrapActivityRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $trap = $this->identifyTrap($data->identifier);

        if ($trap === null) {
            return response()->json([
                'message' => 'Trap not found',
            ], 404);
        }

        if ($trap->status === 'inactive') {
            return response()->json([
                'message' => 'Trap not connected',
            ], 422);
        }

        $type = $trap->is_open == 1 && $data->is_open == 0 ? 'catch' : 'sync';

        if ($type === 'catch') {
            TrapCatch::dispatch($trap);
        }

        $trap->is_open = $data->is_open;
        $trap->battery = $this->getBattery($data->battery);
        $trap->save();

        TrapActivity::create([
            'trap_id' =>$trap->id,
            'type' => $type,
        ]);

        return response()->json([
            'message' => 'Synced',
        ], 200);
    }

    public function getBattery($battery): string
    {
        $boom = explode(',', explode(':', $battery)[1]);

        return $boom[1];
    }
}
