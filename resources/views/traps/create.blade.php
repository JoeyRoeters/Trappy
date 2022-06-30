@extends('templates/base')

@section('content')
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">{{ $title }}</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trappy</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('traps.index') }}">Traps</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row">
                <form action="{{ isset($trap) ? route('traps.update', $trap) : route('traps.store') }}" id="form" method="POST">
                    @method(isset($trap) ? 'PUT' : 'POST')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gerenal Information</h4>
                        </div>
                        <div class="card-body">
                            @if(!isset($trap))
                                <div class=" row mb-4">
                                    <label class="col-md-3 form-label">Identifier</label>
                                    <div class="col-md-9"> <input type="text" value="{{ old('identifier', isset($trap) ? $trap->identifier : null) }}" class="form-control @error('identifier') is-invalid @enderror" name="identifier" data-np-checked="1"> </div>
                                </div>
                            @endif
                            <div class=" row mb-4">
                                <label class="col-md-3 form-label">Name</label>
                                <div class="col-md-9"> <input type="text" value="{{ old('name', isset($trap) ? $trap->name : null) }}" class="form-control @error('name') is-invalid @enderror" name="name" data-np-checked="1"> </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label" for="description">Description</label>
                                <div class="col-md-9"> <textarea id="description" name="description" class="form-control">{{ old('description', isset($trap) ? $trap->description : null) }}</textarea></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Location</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Locations</label>
                                <select name="location_id" class="form-control form-select " aria-hidden="true">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select></div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
