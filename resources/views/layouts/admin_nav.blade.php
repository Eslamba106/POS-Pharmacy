<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0"
            data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            <!--<div class="d-flex justify-content-around align-items-center align-items-stretch">-->
            <!--    <div class="aiz-topbar-item">-->
            <!--        <div class="d-flex align-items-center">-->
            <!--            <a class="btn btn-icon btn-circle btn-light" href=" " target="_blank"-->
            <!--                title="{{ __('Browse Website') }}">-->
            <!--                <i class="las la-globe"></i>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">

            <!--<div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-0 d-flex justify-content-center align-items-center">
                            <span class="d-flex align-items-center position-relative">
                                <i class="las la-bell fs-24"></i>
                               
                            </span>
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-xl py-0">
                        <div class="notifications">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" data-toggle="tab" data-type="order" href="#orders-notifications"
                                        role="tab" id="orders-tab">{{ __('Orders') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-toggle="tab" data-type="seller"
                                        href="#sellers-notifications" role="tab" id="sellers-tab">{{ __('Sellers') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-toggle="tab" data-type="seller"
                                        href="#payouts-notifications" role="tab" id="sellers-tab">{{ __('Payouts') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content c-scrollbar-light overflow-auto" style="height: 75vh; max-height: 400px; overflow-y: auto;">
                                <div class="tab-pane active" id="orders-notifications" role="tabpanel">
                                     
                                </div>
                                <div class="tab-pane" id="sellers-notifications" role="tabpanel">
                                     
                                </div>
                                <div class="tab-pane" id="payouts-notifications" role="tabpanel">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center border-top">
                            <a href=" " class="text-reset d-block py-2">
                                 
                            </a>
                        </div>
                    </div>
                </div>
            </div>-->
 
            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class=" mr-md-2">
                                <img width="40px" @if(session()->get('locale') == 'ar' ) src="{{ main_path() . 'img/flags/sa.png' }}" @else src="{{ main_path() . 'img/flags/US.png' }}" @endif>
                            </span>
                            
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="{{ route('language', 'ar') }}" class="dropdown-item">
                            {{ __('general.arabic') }}
                            <span class="float-right text-muted text-sm">
                                <img src="{{ main_path().'img/flags/sa.png'  }}" alt="">
    
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('language', 'en') }}" class="dropdown-item">
                            {{ __('general.english') }}
                            <span class="float-right text-muted text-sm">
                                <img src="{{ main_path().'img/flags/US.png'  }}" alt="">
    
                            </span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img src="{{ main_path() . 'img/avatar-place.png' }}">
                            </span>
                            <span class="d-none d-md-block">
                                <span class="d-block fw-500">{{ auth()->user()->name }}</span>
                                <span class="d-block small opacity-60">{{ auth()->user()->role_name }}</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href=" " class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span>{{ __('login.logout') }}</span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->
