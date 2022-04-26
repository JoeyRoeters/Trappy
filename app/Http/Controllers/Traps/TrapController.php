<?php

namespace App\Http\Controllers\Traps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConnectTrapRequest;
use App\Http\Requests\StoreTrapRequest;
use App\Models\Trap;
use App\Traits\HasIdentifier;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TrapController extends Controller
{
    use HasIdentifier;

    public function store(StoreTrapRequest $request): Response
    {
        $data = (object) $request->validated();

        Trap::create([
            'name' => $data->name,
            'description' => $data->description,
            'location_id' => $data->location_id,
            'identifier' => Hash::make($data->identifier)
        ]);

        return response('Trap created', 201);
    }

    public function connect(ConnectTrapRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $trap = $this->identifyTrap($data->id);

        if (!$trap) {
            return response()->json([
                'message' => 'Trap not found'
            ], 404);
        }

        if ($trap->status !== 'inactive') {
            return response()->json([
                'error' => 'Trap already connected'
            ]);
        }

        $trap->update([
            'status' => 'active'
        ]);

        return response()->json([
            'status' => 'active'
        ], 200);
    }
}
