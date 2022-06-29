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
        $params = [
            'title' => 'New location',
            'lat' => 53.24097,
            'lng' => 6.53439,
        ];

        return view('locations/create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $location = new Location();

        $location->name = $request->get('name');
        $location->description = $request->get('description', 'No description given');

        $latlng = $request->get('location');
        if (!empty($latlng)) {
            $latlng = json_decode($latlng);

            $location->latitude = $latlng->lat;
            $location->longitude = $latlng->lng;
        }

        $location->save();

        Session::flash('message', 'Location created!');

        return redirect(route('locations.show', $location));
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
        $params = [
            'title' => $location->name,
            'lat' => $location->latitude,
            'lng' => $location->longitude,
            'location' => $location,
        ];

        return view('locations/create', $params);
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
        $location->name = $request->get('name');
        $location->description = $request->get('description', 'No description given');

        $latlng = $request->get('location');
        if (!empty($latlng) && $latlng !== 'null') {
            $latlng = json_decode($latlng);

            if ($latlng->lat !== $location->latitude || $latlng->lng !== $location->longitude) {
                $location->latitude = $latlng->lat;
                $location->longitude = $latlng->lng;

                $location->getAddress(true);
            }
        } else {
            $location->save();
        }

        Session::flash('message', 'Location saved!');

        return redirect(route('locations.show', $location));
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
