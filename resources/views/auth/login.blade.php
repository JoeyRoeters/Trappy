@extends('templates/base_clean')

@section('body')
    <div class="col col-login mx-auto mt-7">
        <div class="text-center">
            <img src="../assets/images/brand/logo-white.png" class="header-brand-img" alt="">
        </div>
    </div>

    <div class="container-login100">
        <div class="wrap-login100 p-6">
            <form action="{{ route('auth.login') }}" method="post" class="login100-form validate-form">
                @csrf
                <span class="login100-form-title pb-5 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/images/logo_only.png') }}" style="position: absolute" height="100" alt="logo">
                                <span class="pt-9">Login</span>
                            </span>
                <div class="panel panel-primary">
                    @error('failed')
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                    <div class="wrap-input100 input-group" style="width: 361px !important;">
                                        <input class="input100 form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email">
                                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="wrap-input100 input-group" id="Password-toggle" style="width: 361px !important;">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password">
                                        @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="text-end pt-4">
                                        <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
                                    </div>

                                    <button type="submit" class="login100-form-btn btn btn-primary mt-3">Sign-in</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
