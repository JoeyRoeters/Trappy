@extends('templates/base')

@section('content')
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=mapPlacesAutocomplete&libraries=places">
    </script>
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">{{ $title }}</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trappy</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row">
                <form action="{{ isset($location) ? route('locations.update', $location) : route('locations.store') }}" id="form" method="POST">
                    @method(isset($location) ? 'PUT' : 'POST')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gerenal Information</h4>
                        </div>
                        <div class="card-body">
                            <div class=" row mb-4">
                                <label class="col-md-3 form-label">Name</label>
                                <div class="col-md-9"> <input type="text" value="{{ old('name', isset($location) ? $location->name : null) }}" class="form-control @error('name') is-invalid @enderror" name="name" data-np-checked="1"> </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label" for="description">Description</label>
                                <div class="col-md-9"> <textarea id="description" name="description" class="form-control">{{ old('description', isset($location) ? $location->description : null) }}</textarea></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Location</h4>
                        </div>
                        <div class="card-body">
                            <div style="height: 250px" class="mb-5" id="map"></div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let map;
        let value = null;

        $("#form").submit(event => {
            const val = JSON.stringify(value);

            $("<input />").attr({
                type: 'hidden',
                name: 'location',
                value: val
            }).appendTo("#form");
        });

        window.mapPlacesAutocomplete = () => {
            initMap()
        };

        function initMap() {
            let loc = { lat: {{ $lat }}, lng: {{ $lng }} };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: loc,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false,
                scaleControl: false,
                clickableIcons: false,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                },
                zoom: 10,
                mapTypeId: 'roadmap',
            }); // Create the search box and link it to the UI element.

            let markers = []; // Listen for the event fired when the user selects a prediction and retrieve


            var marker = new google.maps.Marker({
                position: loc,
                map: map,
            });

            markers.push(marker);

            google.maps.event.addListener(map, 'click', (event) => {
                markers.forEach(marker => {
                    marker.setMap(null);
                });
                markers = [];
                value = {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                };


                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                });

                markers.push(marker)
            });
        }

    </script>

@endsection
