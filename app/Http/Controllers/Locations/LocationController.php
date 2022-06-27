<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\Trap;
use Session;

class LocationController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $traps = [];

        /** @var Trap $trap */
        foreach ($location->traps()->get() as $trap) {
            $traps[] = [
                $trap->name,
                $trap->is_open ? 'Open' : 'Closed',
                $trap->battery,
            ];
        }

        $params = [
            'title' => $location->name,
            'location' => $location,
            'activities' => $location->getLatestActivities(),
            'traps' => $traps,
            'address' => $location->getAddress(),
            'totalCatches' => $location->trapActivitiesQuery()->count(),
            'lat' => $location->latitude,
            'lng' => $location->longitude,
        ];

        return View('locations/show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $isDeleted = $location->delete();
        if ($isDeleted) {
            Session::flash('message', 'Location ' . $location->name . ' deleted!');
        }

        return redirect('locations');
    }
}
