<?php

namespace App\Http\Controllers\Traps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConnectTrapRequest;
use App\Http\Requests\StoreTrapRequest;
use App\Models\Trap;
use App\Traits\HasIdentifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrapController extends Controller
{
    use HasIdentifier;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new Overview())->run();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trap  $trap
     * @return \Illuminate\Http\Response
     */
    public function show(Trap $trap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trap  $trap
     * @return \Illuminate\Http\Response
     */
    public function edit(Trap $trap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trap  $trap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trap $trap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trap  $trap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trap $trap)
    {
        //
    }

    public function store(StoreTrapRequest $request)
    {
        $data = (object) $request->validated();

        $identifierCheck = $this->identifyTrap($data->identifier);

        if ($identifierCheck !== null) {
            return response()->json([
                'message' => 'Trap already exists',
            ], 422);
        }

        Trap::create([
            'name' => $data->name,
            'description' => $data->description,
            'location_id' => $data->location_id,
            'identifier' => Hash::make($data->identifier),
        ]);

        return response('Trap created', 201);
    }

    public function connect(ConnectTrapRequest $request): JsonResponse
    {
        $data = (object) $request->validated();

        $trap = $this->identifyTrap($data->id);

        if (!$trap) {
            return response()->json([
                'message' => 'Trap not found',
            ], 404);
        }

        if ($trap->status !== 'inactive') {
            return response()->json([
                'error' => 'Trap already connected',
            ], 422);
        }

        $trap->update([
            'status' => 'active',
        ]);

        return response()->json([
            'status' => 'active',
        ], 200);
    }
}
