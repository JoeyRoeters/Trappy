@extends('templates/base')

@section('content')
    <script async
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
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

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover pb-lg-9">
                                                <div class="bg-img"><div style="height: 250px" id="map"></div></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2">{{$title}}</h3>
                                                            <h5 class="text-muted">{{$address}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-profile">
                                                    <a class="btn btn-warning mt-1 mb-1" href="{{ route('locations.edit', $location) }}">
                                                        <i class="fa fa-edit"></i><span>Edit</span>
                                                    </a>
                                                    <form id="delete" action="{{ route('locations.destroy', $location) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" onclick="deleteLocation();" class="btn btn-danger mt-1 mb-1">
                                                            <i class="fa fa-times"></i> <span>Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-profile-contact-list">
                                <div class="me-5">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-secondary bradius me-3 mt-1"> <i class="fe fe-wifi fs-20 text-white"></i> </div>
                                        <div class="media-body">
                                            <span class="text-muted">Traps</span>
                                            <div class="fw-semibold fs-25"> {{ count($traps) }} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-5 mt-5 mt-md-0">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-danger bradius text-white me-3 mt-1"> <span class="mt-3"> <i class="fe fe-disc fs-20"></i> </span> </div>
                                        <div class="media-body">
                                            <span class="text-muted">Catches</span>
                                            <div class="fw-semibold fs-25"> {{ $totalCatches }} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">About</div>
                        </div>
                        <div class="card-body">
                            <div>
                                <p>{{ $location->description ?? 'No description set' }}</p>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="me-4 text-center text-primary"> <span><i class="fe fe-map-pin fs-20"></i></span> </div>
                                <div> <strong>{{ $address }}</strong> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title fw-semibold">Location traps</h4>
                            <a class="btn btn-primary disabled"  href="#">
                                <i class="fe fe-plus"></i>
                                Add new trap
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Trap</th>
                                        <th class="wd-15p border-bottom-0">Status</th>
                                        <th class="wd-15p border-bottom-0">Battery</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($traps as $row)
                                        <tr>
                                            @foreach($row as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-semibold">Latest catches</h4>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="task-list">
                                @if(empty($activities))
                                    <li>No catches yet</li>
                                @else
                                    @foreach($activities as $activity)
                                        <li class="d-sm-flex">
                                            <div>
                                                <i class="task-icon bg-primary"></i>
                                                <h6 class="fw-semibold">{{ $activity['name'] }}<span class="text-muted fs-11 mx-2 fw-normal">{{ $activity['date'] }}</span> </h6>
                                                <p class="text-muted fs-12">There was a catch at {{ $activity['location'] }} on trap <a href="{{ $activity['url'] }}" class="fw-semibold"> {{ $activity['name'] }}</a></p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#basic-datatable').DataTable();
        } );

        function deleteLocation() {
            swal({
                    title: "Are you sure?",
                    text: "Location {{ $title }} will be deleted.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $('#delete').submit();
                });
        }

        let map;

        function initMap() {
            const loc = { lat: {{ $lat }}, lng: {{ $lng }} };

            map = new google.maps.Map(document.getElementById("map"), {
                center: loc,
                zoom: 15,
                disableDefaultUI: true,
                scrollwheel: false,
                navigationControl: false,
                mapTypeControl: false,
                scaleControl: false,
                draggable: false,
            });

            const marker = new google.maps.Marker({
                position: loc,
                map: map,
            });
        }

        window.initMap = initMap;
    </script>

@endsection
