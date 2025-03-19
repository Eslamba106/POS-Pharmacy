<!doctype html>

<html @if (session()->get('locale') == 'ar') dir="rtl" lang="ar"  
    
@else
dir="ltr" lang="en" @endif>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="">
    <meta name="file-base-url" content="">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">428 --}}
    <title>@yield('title')</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ asset(main_path() . 'css/vendors.css') }}">
    @if (session()->get('locale') == 'ar')
        <link rel="stylesheet" href="{{ asset(main_path() . 'css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset(main_path() . 'css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ asset(main_path() . 'css/toastr.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <style>
        body {
            font-size: 20px !important;
        }
    </style>

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!! __('Nothing selected') !!}',
            nothing_found: '{!! __('Nothing found') !!}',
            choose_file: '{{ __('Choose file') }}',
            file_selected: '{{ __('File selected') }}',
            files_selected: '{{ __('Files selected') }}',
            add_more_files: '{{ __('Add more files') }}',
            adding_more_files: '{{ __('Adding more files') }}',
            drop_files_here_paste_or: '{{ __('Drop files here, paste or') }}',
            browse: '{{ __('Browse') }}',
            upload_complete: '{{ __('Upload complete') }}',
            upload_paused: '{{ __('Upload paused') }}',
            resume_upload: '{{ __('Resume upload') }}',
            pause_upload: '{{ __('Pause upload') }}',
            retry_upload: '{{ __('Retry upload') }}',
            cancel_upload: '{{ __('Cancel upload') }}',
            uploading: '{{ __('Uploading') }}',
            processing: '{{ __('Processing') }}',
            complete: '{{ __('Complete') }}',
            file: '{{ __('File') }}',
            files: '{{ __('Files') }}',
        }
    </script>

    @stack('css_or_js')
</head>

<body class="">

    <div class="aiz-main-wrapper">
        @include('layouts.admin_sidenav')
        <div class="aiz-content-wrapper">
            @include('layouts.admin_nav')
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    @yield('content')
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; {{ config('app.name') }}</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->
    @yield('modal')
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    {{-- @if ($errors->any())
    <script>
        let errorMessage = "";
        @foreach ($errors->all() as $error)
            errorMessage += "{{ $error }}\n";
        @endforeach

        swal("خطأ!", errorMessage, "error");
    </script> --}}
    


    @yield('modal')

    <script src="{{ asset(main_path() . 'js/vendors.js') }}"></script>
    <script src="{{ asset(main_path() . 'js/aiz-core.js') }} "></script>
    <script src="{{ asset(main_path() . 'js/toastr.js') }} "></script> 


    @yield('script')

    <script type="text/javascript">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
        $('.dropdown-menu a[data-toggle="tab"]').click(function(e) {
            e.stopPropagation()
            $(this).tab('show')
        })

        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item)
                    .attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(
                            `<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`
                        );
                    }
                } else {
                    $("#search-menu").html(
                        `<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">{{ __('general.nothing_found') }}</span></li>`
                    );
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>
    {{-- <script>
        $(document).on('change', '.bulk_check_all', function() {
            $('input.check_bulk_item:checkbox').not(this).prop('checked', this.checked);
        });
    </script> --}}
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif
    @stack('script')
</body>

</html>
