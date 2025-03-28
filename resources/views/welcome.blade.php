<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $settings->web_name ?? 'Eslam Soft' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ asset(main_path() . 'css/rtl.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(main_path() . 'css/bootstrap.min.css') }}">
    <style>
        body{
            font-size: 20px;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{ asset('assets/back-end/css/custom.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-d...">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/style.css') }}"> --}}
</head>

<body>

    <div class="wrapper">
        <section class="height-100vh d-flex align-items-center justify-content-center page-section-ptb login"
            style="background-image: url('{{ asset(main_path() . 'img/sativa.png') }}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div style="border-radius: 15px;" class="col-lg-8 col-md-6 bg-white d-flex justify-content-center align-items-center">
                        <div class="login-fancy pb-40 clearfix w-100">
                            <div class="text-center">
                                <img src="{{ main_path() . 'download.png' }}" class="mw-100 mb-4" height="100">
                                <h1 class="h3 text-primary mb-0" style="font-size: 20px">{{ __('login.welcome_to') }} {{ env('APP_NAME') }}</h1>
                                <p style="font-size: 20px">{{ __('login.login_to_your_account') }}</p>
                                <ul class="nav nav-tabs w-fit-content mb-4 d-flex justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link type_link active" href="#" id="company-link">{{ __('login.company') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link type_link" href="#" id="admin-link">{{ __('login.admin') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 login_form company-form text-center" id="company-form">
                                <form class="pad-hor" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @include('includes.auth.company_login')
                                </form>
                            </div>
                            <div class="col-md-12 login_form d-none admin-form text-center" id="admin-form">
                                <form class="pad-hor" method="POST" action="{{ route('admin.login') }}">
                                    @csrf
                                    @include('includes.auth.admin_login')
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    

    <script src="{{ asset(main_path() . 'js/vendor.min.js') }}"></script>

    <script>
        $(".type_link").click(function(e) {
            e.preventDefault();
            $(".type_link").removeClass('active');
            $(".login_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            if (form_id === 'company-link') {
                $("#company-form").removeClass('d-none').addClass('active');
                $("#admin-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'admin-link') {
                $("#admin-form").removeClass('d-none').addClass('active');
                $("#company-form").removeClass('active').addClass('d-none');
            }

        });
    </script>
</body>

</html>
