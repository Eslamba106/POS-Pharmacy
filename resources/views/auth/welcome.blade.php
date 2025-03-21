<!doctype html>

<html @if (session()->has('locale') && session()->get('locale') == 'en') dir="ltr" lang="en"  @else dir="rtl" lang="ar" @endif
    style="text-align: {{ Session::get('locale') == 'en' ? 'left' : 'right' }};">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="">
    <meta name="file-base-url" content="">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">428 --}}
    <title>{{ __('login.login') }}</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{main_path().'css/vendors.css'  }}">
    @if (false)
        <link rel="stylesheet" href="{{main_path().'css/bootstrap-rtl.min.css'  }}">
    @endif
    <link rel="stylesheet" href="{{main_path().'css/aiz-core.css?v='  }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-size: 12px;
        }
    </style>


</head>

<body class="">

    <div class="h-100 bg-cover bg-center py-5 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-4 mx-auto">
                    <div class="card text-left">
                        <div class="card-body">
                            <div class="mb-5 text-center">

                                <img src="{{ main_path().'download.png'  }}" class="mw-100 mb-4" height="100">
                                <h1 class="h3 text-primary mb-0">{{ __('login.welcome_to') }} {{ env('APP_NAME') }}</h1>
                                <p style="font-size: 16px">{{ __('login.login_to_your_account') }}</p>
                            </div>
                            <form class="pad-hor" method="POST" action="{{ route($route.'.login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="text"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="{{ __('login.enter_your_email_or_username') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required placeholder="{{ __('login.enter_your_password') }}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span>{{ __('Remember Me') }}</span>
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                                @if (env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <a href=" " class="text-reset fs-14">{{__('Forgot password ?')}}</a>
                                        </div>
                                    </div>
                                @endif
                            </div> --}}
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('login.login') }}
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: "{{ __('general.message') }}",
                text: "{{ Session::get('error') }}",
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 3000
            });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "{{ __('general.message') }}",
                text: "{{ Session::get('success') }}",
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 3000
            });
        </script>
    @endif

</body>
<html>
