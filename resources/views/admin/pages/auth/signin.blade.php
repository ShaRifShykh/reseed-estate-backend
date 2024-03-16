@extends("admin.layout.app")
@section("title", "Login - ")

@section("styles")
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}"/>
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section("section")
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="#" class="app-brand-link gap-2">
{{--                                <span class="app-brand-logo demo">--}}
{{--                                    <img src="{{ asset("assets/img/logo.png") }}" alt="Image Not Found!" width="50">--}}
{{--                                </span>--}}
                                <span class="app-brand-text demo text-body fw-bold text-uppercase">Reseed Estate</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Reseed Estate! 👋</h4>
                        <p class="mb-4">Please sign-in to your account to access POMI Admin Panel</p>

                        @livewire("admin.auth.sign-in-form")
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section("scripts")
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection
