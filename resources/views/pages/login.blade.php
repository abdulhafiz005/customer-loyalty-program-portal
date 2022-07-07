{{-- Extends layout --}}
@extends('layout.default_simple')

{{-- Content --}}
@section('content')

    {{-- Login --}}

    <div class="d-flex flex-column flex-root ar_login">
        <!--begin::Login-->
        <div class="login login-5 d-flex flex-row-fluid login-signin-on" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid">

                <div class="login-form col-md-4 text-center text-white p-2 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-10">
                        <a href="#">
                            <img src="{{ asset('media/svg/shell/rimula logo transparent.png') }}" class="max-h-100px" alt="">
                        </a>
                    </div>
                    <!--end::Login Header-->

                    <!--begin::Login Sign in form-->
                    <div class="login-signin">

                        <div class="mb-10">
                            <h1 class="font-weight-bold">Loyalty Program</h1>
                        </div>

                        @if (count($errors->login) > 0)
                            <br> <br>
                            <div class="alert alert-warning">
                                <ul>
                                    @foreach ($errors->login->all() as $error)
                                        <P>{{ $error }}</p>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                        @endif

                        <form class="form fv-plugins-bootstrap fv-plugins-framework bg-white rounded-xl p-10" id="kt_login_signin_form" novalidate="novalidate" action="{{action('AuthController@postLogin')}}" method="post">
                            {{ csrf_field() }}
                            <div class="mb-10">
                                <h1 class="font-weight-bolder">Sign In </h1>
                            </div>
                            <div class="form-group fv-plugins-icon-container">
                                <label>User Name</label>
                                <input class="form-control bg-input h-auto border-0 py-4 px-8" type="text" placeholder="Email" name="username" autocomplete="off">
                                <div class="fv-plugins-message-container"></div>
                            </div>

                            <div class="form-group fv-plugins-icon-container">
                                <label>Password</label>
                                <input class="form-control bg-input h-auto border-0 py-4 px-8" type="password" placeholder="Password" name="password">
                                <div class="fv-plugins-message-container"></div>
                            </div>

                            <div class="form-group text-center mt-10">
                                <button id="kt_login_signin_submit" type="submit" class="btn btn-danger btn-shadow-hover font-weight-bolder w-100 py-3">Sign In</button>
                            </div>
                            <input type="hidden">
                            <div></div>
                        </form>

                    </div>
                    <!--end::Login Sign in form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>

    <div class="footer ar-login-footer py-2 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->

        <div class="container-fluid d-flex flex-column text-center align-items-center justify-content-between">
            <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted font-weight-bold mr-2">Copyright 2020 &#169; </span>
                    <a href="#" target="_blank" class="text-dark-75 text-hover-primary">Shell Pakistan</a>
                </div>
            <!--end::Copyright-->
        </div>
    <!--end::Container-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
