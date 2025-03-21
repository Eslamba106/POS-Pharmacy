<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $settings->web_name ?? "Eslam Soft" }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{  asset(main_path().'css/rtl.css') }}" rel="stylesheet">

</head>

<body>

    <div class="wrapper">

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
                 style="background-image: url('{{ asset(main_path().'img/sativa.png')}}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">

                    <div style="border-radius: 15px;" class="col-lg-5 col-md-4 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{ __('general.select_your_job') }}</h3>
                            <div class="form-inline">
                                <a class="btn btn-default col-lg-4" title="{{ __("general.manager") }}" href="{{ route('login-page') }}">  
                                    <img alt="user-img" width="120px;" src="{{asset(main_path().'img/manager.png')}}">
                                </a> 
                                <a href="{{ route('staff.login-page') }}" class="btn btn-default col-lg-4" title="{{ __("general.staff") }}" >
                                    {{-- </a>href="{{route('login.show','teacher')}}"> --}}
                                    <img alt="user-img" width="100px;" src="{{asset(main_path().'img/teacher.png')}}">
                                </a>
                                <a class="btn btn-default col-lg-4" title="{{ __("general.admin") }}" href="{{ route('admin.login-page') }}">
                                    <img alt="user-img" width="100px;" src="{{asset(main_path().'img/admin.png')}}">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <!--=================================
 login-->

    </div>
    {{-- <!-- jquery -->
    <script src="{{ asset(main_path().'js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ asset(main_path().'js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';

    </script>


    <!-- toastr -->
    @yield('js')
    <!-- custom -->
    <script src="{{ asset(main_path().'js/custom.js') }}"></script> --}}

</body>

</html>
