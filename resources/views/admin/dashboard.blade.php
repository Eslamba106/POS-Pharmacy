@extends('layouts.admin.main')

@section('title')
    {{ __('general.dashboard') }}
@endsection
@section('content')
    @if (auth()->user()->can('smtp_settings') &&
            env('MAIL_USERNAME') == null &&
            env('MAIL_PASSWORD') == null)
        <div class="">
            <div class="alert alert-danger d-flex align-items-center">
                {{ __('Please Configure SMTP Setting to work all email sending functionality') }},
                <a class="alert-link ml-2" href="{{ 'smtp_settings.index' }}">{{ __('Configure Now') }}</a>
            </div>
        </div>
    @endif
    {{-- {{ dd(auth()->guard('staffs')->user()->hasPermission('admin_dashboard')) }} --}}
 
    {{-- @if (auth()->user()->can('admin_dashboard')) --}}
        <div class="row gutters-10">
            <div class="col-lg-6">
                <div class="row gutters-10">
                    <div class="col-6">
                        <div class="counter_box bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="title">
                                    <span class="fs-15 d-block">{{ __('Total') }}</span>
                                    {{ __('Customer') }}
                                </div>
                                <div class="h1 fw-600 mb-3">


                                </div>
                            </div>
                            <i class="la la-users"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="counter_box bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="title">
                                    <span class="fs-12 d-block">{{ __('Total') }}</span>
                                    {{ __('Order') }}
                                </div>
                                <div class="h1 fw-600 mb-3">


                                </div>
                            </div>
                            <i class="las la-archive"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="counter_box bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="title">
                                    <span class="fs-12 d-block">{{ __('Total') }}</span>
                                    {{ __('Product category') }}
                                </div>
                                <div class="h1 fw-600 mb-3">




                                </div>
                            </div>
                            <i class="lab la-dropbox"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="counter_box bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                            <div class="px-3 pt-3">
                                <div class="title">
                                    <span class="fs-12 d-block">{{ __('Total') }}</span>
                                    {{ __('Product brand') }}
                                </div>
                                <div class="h1 fw-600 mb-3">




                                </div>
                            </div>
                            <i class="las la-tag"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">Revenue</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>

                    </div>
                </div>

            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card rounded-lg dash-infobox">
                            <div class="card-body">
                                <h6>Pending</h6>
                                <h3>05</h3>
                            </div>
                            <i class="las la-file-alt"></i>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="card rounded-lg dash-infobox">
                            <div class="card-body">
                                <h6>Confirmed</h6>

                                <h3>05</h3>
                            </div>
                            <i class="las la-check-circle"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card rounded-lg dash-infobox">
                            <div class="card-body">
                                <h6>Delivered</h6>

                                <h3>05</h3>
                            </div>
                            <i class="las la-truck"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card rounded-lg dash-infobox">
                            <div class="card-body">
                                <h6>Cancelled</h6>

                                <h3>05</h3>
                            </div>
                            <i class="lar la-times-circle"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card rounded-lg dash-infobox">
                            <div class="card-body">
                                <h6>Out For Delivery</h6>

                                <h3>05</h3>
                            </div>
                            <i class="las la-truck-loading"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row gutters-10">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 fs-14">{{ __('Products') }}</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="pie-1" class="w-100" height="305"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 fs-14">{{ __('Orders') }}</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="pie-2" class="w-100" height="305"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gutters-10">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ __('Category wise product sale') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="graph-1" class="w-100" height="500"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ __('Category wise product stock') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="graph-2" class="w-100" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ __('Top 12 Products') }}</h6>
            </div>
            <div class="card-body">
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                    data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>

                    {{-- @foreach (filter_products($productsTop)->limit(12)->get() as $key => $product) --}}
                    <div class="carousel-box">
                        <div
                            class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                            <div class="position-relative">
                                <a href="{{ 'product' }}" class="d-block">
                                    <img class="img-fit lazyload mx-auto h-210px"
                                        src="{{ asset(main_path() . 'img/placeholder.jpg') }}" data-src=" "
                                        alt=" "
                                        onerror="this.onerror=null;this.src='{{ asset(main_path() . 'img/placeholder.jpg') }}';">
                                </a>
                            </div>
                            <div class="p-md-3 p-2 text-left">
                                <div class="fs-15">
                                    {{-- @if (home_base_price($product) != home_discounted_base_price($product))
                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                @endif --}}
                                    {{-- <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span> --}}
                                </div>
                                {{-- <div class="rating rating-sm mt-1">
                                {{ renderStarRating($product->rating) }}
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                <a href="{{ ('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>
                            </h3> --}}
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    {{-- @endif --}}
@endsection
@section('script')
    <script type="text/javascript">
        AIZ.plugins.chart('#pie-1', {
            type: 'doughnut',
            data: {
                labels: [
                    '{{ __('Total published products') }}',
                    /* '{{ __('Total sellers products') }}', */
                    '{{ __('Total admin products') }}'
                ],
                datasets: [{
                    data: [

                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });

        AIZ.plugins.chart('#pie-2', {
            type: 'doughnut',
            data: {
                labels: [

                    '{{ __('Total COD Orders') }}',
                    '{{ __('Total Online Orders') }}'
                ],
                datasets: [{
                    data: [


                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Montserrat',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });
        AIZ.plugins.chart('#graph-1', {
            type: 'bar',
            data: {
                labels: [

                ],
                datasets: [{
                    label: '{{ __('Number of sale') }}',
                    data: [

                    ],
                    backgroundColor: [

                    ],
                    borderColor: [

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#f2f3f8',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10
                        }
                    }]
                },
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                }
            }
        });
        AIZ.plugins.chart('#graph-2', {
            type: 'bar',
            data: {
                labels: [

                ],
                datasets: [{
                    label: '{{ __('Number of Stock') }}',
                    data: [

                    ],
                    backgroundColor: [

                    ],
                    borderColor: [

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#f2f3f8',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10
                        }
                    }]
                },
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                }
            }
        });


        document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#lineChart'), {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Line Chart',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
