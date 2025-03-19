@extends('layouts.main')
@push('css_or_js')
@endpush
@section('content')

<div class="row gx-2 gy-3" id="printableArea">
    <div class="col-lg-8 col-xl-9">
        <!-- Card -->
        <div class="card h-100">
            <!-- Body -->
            <div class="card-body">
                <div class="d-flex flex-wrap gap-10 justify-content-between mb-4">
                    <div class="d-flex flex-column gap-10">
                        <h5
                            class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                            {{-- <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" class="mb-1"
                                alt=""> --}}
                            {{ __('general.general_info') }}
                        </h5>
                        <h4 class="text-capitalize">{{ __('companies.category_code') }} #{{ $category->code }}</h4>
                        <div class="">
                            <i class="tio-date-range"></i>
                            {{ date('d M Y H:i:s', strtotime($category['created_at'])) }}
                        </div>
                    </div>
                    <div class="text-sm-right">

                        <div class="d-flex flex-column gap-2 mt-3">
                            <!-- Order status -->
                            {{-- <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                <span class="title-color">{{__('status')}}: </span>
                                @if ($category['order_status'] == 'pending')
                                    <span class="badge badge-soft-info font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                        {{__(str_replace('_',' ',$category['order_status']))}}
                                    </span>
                                @elseif($category['order_status']=='failed')
                                    <span class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                        {{__(str_replace('_',' ',$category['order_status']))}}
                                    </span>
                                @elseif($category['order_status']=='processing' || $category['order_status']=='out_for_delivery')
                                    <span class="badge badge-soft-warning font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                        {{__(str_replace('_',' ',$category['order_status']))}}
                                    </span>
                                @elseif($category['order_status']=='delivered' || $category['order_status']=='confirmed')
                                    <span class="badge badge-soft-success font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                        {{__(str_replace('_',' ',$category['order_status']))}}
                                    </span>
                                @else
                                    <span class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                        {{__(str_replace('_',' ',$category['order_status']))}}
                                    </span>
                                @endif
                            </div> --}}

                            <!-- Payment Method -->
                            {{-- <div class="payment-method d-flex justify-content-sm-end gap-10 text-capitalize">
                                <span class="title-color">{{__('payment_Method')}} :</span>
                                <strong>  {{__(str_replace('_',' ',$category['payment_method']))}}</strong>
                            </div>
                            @if (isset($category['transaction_ref']) && $category->payment_method != 'cash_on_delivery' && $category->payment_method != 'pay_by_wallet' && !isset($category->offline_payments))
                                <!-- reference-code -->
                                <div class="reference-code d-flex justify-content-sm-end gap-10 text-capitalize">
                                    <span class="title-color">{{__('reference_Code')}} :</span>
                                    <strong>{{__(str_replace('_',' ',$category['transaction_ref']))}} {{ $category->payment_method == 'offline_payment' ? '('.$category->payment_by.')':'' }}</strong>
                                </div>
                            @endif --}}
                            <!-- Payment Status -->
                            {{-- <div class="payment-status d-flex justify-content-sm-end gap-10">
                                <span class="title-color">{{__('payment_Status')}}:</span>
                                @if ($category['payment_status'] == 'paid')
                                    <span class="text-success font-weight-bold">
                                        {{__('paid')}}
                                    </span>
                                @else
                                    <span class="text-danger font-weight-bold">
                                        {{__('unpaid')}}
                                    </span>
                                @endif
                            </div> --}}
                            {{-- @if (\App\CPU\Helpers::get_business_settings('order_verification') && $category->order_type == 'default_type')
                                <span class="ml-2 ml-sm-3">
                                    <b>
                                        {{__('order_verification_code')}} : {{$category['verification_code']}}
                                    </b>
                                </span>
                            @endif --}}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.country') }} :
                            <strong>{{ $country_main->country->name ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.country_code') }} :
                            <strong>{{ $country_main->country->code ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('region.region') }} :
                            <strong>{{ $country_main->region->name ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.currency_name') }} :
                            <strong>{{ $country_main->country->currency_name ?? __('general.not_available') }}</strong></span>
                    </div>


                </div>
                <div class="row mt-5">


                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.currency_symbol') }} :
                            <strong>{{ $category->symbol ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.currency_symbol') }} :
                            <strong>{{ $category->currency_code ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.denomination_name') }} :
                            <strong>{{ $category->denomination ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('country.no_of_decimals') }} :
                            <strong>{{ $category->decimals ?? __('general.not_available') }}</strong></span>
                    </div>

                </div>
                <div class="row mt-5">

                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('companies.state') }} :
                            <strong>{{ $category->state ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('companies.city') }} :
                            <strong>{{ $category->city ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('companies.location') }} :
                            <strong>{{ $category->location ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <span class="title-color break-all"> {{ __('companies.pin') }} :
                            <strong>{{ $category->pin ?? __('general.not_available') }}</strong></span>
                    </div>

                </div>


                <div class="row justify-content-md-end mb-3">
                    {{-- <div class="col-md-9 col-lg-8">
                        <dl class="row text-sm-right">
                            <dt class="col-5">{{__('item_price')}}</dt>
                            <dd class="col-6 title-color">
                                <strong> </strong>
                            </dd>
                            <dt class="col-5 text-capitalize">{{__('item_discount')}}</dt>
                            <dd class="col-6 title-color">
                                - <strong> </strong>
                            </dd>
                            <dt class="col-sm-5">{{__('extra_discount')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>-  </strong>
                            </dd>
                            <dt class="col-5 text-capitalize">{{__('sub_total')}}</dt>
                            <dd class="col-6 title-color">
                                <strong></strong>
                            </dd>
                            <dt class="col-sm-5">{{__('coupon_discount')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>- </strong>
                            </dd>
                            <dt class="col-5 text-uppercase">{{__('vat')}}/{{__('tax')}}</dt>
                            <dd class="col-6 title-color">
                                <strong> </strong>
                            </dd>
                            <dt class="col-sm-5">{{__('total')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$extra_discount-$coupon_discount))}}</strong>
                            </dd>
                        </dl>
                        <!-- End Row -->
                    </div> --}}
                </div>
                <!-- End Row -->
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->
    </div>

    <div class="col-lg-4 col-xl-3">
        <!-- Card -->
        <div class="card">

            <!-- Body -->
            @if ($category)
                <div class="card-body">
                    <h4 class="mb-4 d-flex align-items-center gap-2">
                        {{-- <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" alt=""> --}}
                        {{ __('companies.info') }}
                    </h4>

                    <div class="media flex-wrap gap-3">
                        <div class="">
                            <img class="avatar rounded-circle avatar-70"
                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                src="{{ asset('assets/' . $category->logo_image) }}" alt="Image">
                            {{-- {{ dd( asset($category->logo_image_url)) }} --}}
                        </div>
                        <div class="media-body d-flex flex-column gap-1">
                            <span class="title-color hover-c1"><strong>{{ $category->name }}</strong></span>
                            <span class="title-color hover-c1">{{ __('companies.category_code') }} :
                                <strong>{{ $category->code }}</strong></span>
                            <span class="title-color"> {{ __('companies.user_name') }} :
                                <strong>{{ $category->user_name }}</strong>
                            </span>
                            <span class="title-color break-all"> {{ __('general.phone') }} :
                                <strong>{{ '(+' . $category->phone_dail_code . ')' . $category->phone }}</strong></span>
                            <span class="title-color break-all"> {{ __('companies.fax') }} :
                                <strong>{{ '(+' . $category->fax_dail_code . ')' . $category->fax }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.email') }} :
                                <strong>{{ $category->email }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.password') }} :
                                <strong>{{ $category->my_name }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.opening_time') }} :
                                <strong>{{ Carbon\Carbon::parse($category->opening_time)->format('h:i A') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.closing_time') }} :
                                <strong>{{ Carbon\Carbon::parse($category->closing_time)->format('h:i A') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.financial_year_start_ith') }} :
                                <strong>{{ Carbon\Carbon::parse($category->financial_year)->format('Y-m-d') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.book_begining_with') }} :
                                <strong>{{ Carbon\Carbon::parse($category->book_begining)->format('Y-m-d') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.address1') }} :
                                <strong>{{ $category->address1 ?? __('general.not_available') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.address2') }} :
                                <strong>{{ $category->address2 ?? __('general.not_available') }}</strong></span>
                            <span class="title-color break-all">{{ __('companies.address3') }} :
                                <strong>{{ $category->address3 ?? __('general.not_available') }}</strong></span>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="media align-items-center">
                        <span>{{ __('login.user_not_found') }}</span>
                    </div>
                </div>
            @endif
            <!-- End Body -->
        </div>
        <!-- End Card -->
    </div>
</div>
<div class="row gx-2 gy-3" id="printableArea">
    <div class="col-lg-8 col-xl-9">
        <!-- Card -->
        <div class="card h-100">
            <!-- Body -->
            <div class="card-body">
                <div class="d-flex flex-wrap gap-10 justify-content-between mb-4">
                    <div class="d-flex flex-column gap-10">
                        <h5
                            class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                            <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" class="mb-1"
                                alt="">
                            {{ __('companies.tax_info') }}
                        </h5>
                        <h4 class="text-capitalize">{{ __('companies.id') }} # {{ $category->id }}</h4>

                    </div>
                    <div class="text-sm-right">

                        <div class="d-flex flex-column gap-2 mt-3">

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <span class="title-color break-all"> {{ __('companies.vat_no') }} :
                            <strong>{{ $category->vat_no ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <span class="title-color break-all"> {{ __('companies.group_vat_no') }} :
                            <strong>{{ $category->group_vat_no ?? __('general.not_available') }}</strong></span>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <span class="title-color break-all"> {{ __('companies.tax_registration_date') }} :
                            <strong>{{ Carbon\Carbon::parse($category->tax_reg_date)->format('Y-m-d') ?? __('general.not_available') }}</strong></span>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <span class="title-color break-all"> {{ __('companies.tax_rate') }} :
                            <strong>{{ $category->tax_rate ?? __('general.not_available') }}</strong></span>
                    </div>

                </div>



                <div class="row justify-content-md-end mb-3">
                    {{-- <div class="col-md-9 col-lg-8">
                        <dl class="row text-sm-right">
                            <dt class="col-5">{{__('item_price')}}</dt>
                            <dd class="col-6 title-color">
                                <strong> </strong>
                            </dd>
                            <dt class="col-5 text-capitalize">{{__('item_discount')}}</dt>
                            <dd class="col-6 title-color">
                                - <strong> </strong>
                            </dd>
                            <dt class="col-sm-5">{{__('extra_discount')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>-  </strong>
                            </dd>
                            <dt class="col-5 text-capitalize">{{__('sub_total')}}</dt>
                            <dd class="col-6 title-color">
                                <strong></strong>
                            </dd>
                            <dt class="col-sm-5">{{__('coupon_discount')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>- </strong>
                            </dd>
                            <dt class="col-5 text-uppercase">{{__('vat')}}/{{__('tax')}}</dt>
                            <dd class="col-6 title-color">
                                <strong> </strong>
                            </dd>
                            <dt class="col-sm-5">{{__('total')}}</dt>
                            <dd class="col-sm-6 title-color">
                                <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$extra_discount-$coupon_discount))}}</strong>
                            </dd>
                        </dl>
                        <!-- End Row -->
                    </div> --}}
                </div>
                <!-- End Row -->
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->
    </div>

    <div class="col-lg-4 col-xl-3">
        <!-- Card -->
        <div class="card">

            <!-- Body -->
            <!-- End Body -->
        </div>
        <!-- End Card -->
    </div>
</div>

@endsection
