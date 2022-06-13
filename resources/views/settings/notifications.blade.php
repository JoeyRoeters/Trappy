@extends('templates/base')

@section('content')
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Notification settings</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Trappy</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row quick statistics -->
            <div class="row">
                <form method="POST" action="{{ route('notifications.update') }}">
                    @method("PUT")
                    @csrf
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Notify me on:</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="notify_email" class="custom-switch-input" @if($notification_settings['notify_email']) checked @endif">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">email ({{ Auth::user()->email }})</span>
                                    </label>
                                </div>
                                <div class="form-group mg-b-10">
                                    <label class="custom-switch ps-0">
                                        <input type="checkbox" name="notify_sms" class="custom-switch-input" @if($notification_settings['notify_sms']) checked @endif">
                                        <span class="custom-switch-indicator me-3"></span>
                                        <span class="custom-switch-description mg-l-10">sms ({{ Auth::user()->phone }})</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="card-title">Notify me for traps:</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control select2" name="traps[]" data-placeholder="Choose traps" multiple>
                                        @foreach($traps as $trap)
                                            <option @if(in_array($trap->id, $notification_settings['traps'])) selected @endif value="{{ $trap->id }}">
                                                {{ $trap->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4 mb-0">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End row 1 -->
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
    <script src="../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>

    <script>

    </script>


@endsection
