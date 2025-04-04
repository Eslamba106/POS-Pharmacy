 @php
     $url = url()->current();
     $url_array = explode('/' , $url);
     if(in_array('admin' , $url_array)){
        $route = 'admin';
     }
     else if(in_array('staff' , $url_array)){
        $route = 'staff';
     }
     else{
        $route = 'web';
     }
 @endphp
 <div class="aiz-sidebar-wrap">
     <div class="aiz-sidebar left c-scrollbar">
         <div class="aiz-side-nav-logo-wrap">
             <a href="" class="d-block text-left">
                 {{-- @if (get_setting('system_logo_white') != null && true)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else --}}
                 <img width="150" height="auto" src="{{ main_path() . 'download.png' }}" class="brand-icon"
                     alt=" ">
                 {{-- @endif --}}
             </a>
         </div>
         <div class="aiz-side-nav-wrap">
             <div class="px-20px mb-3">
                 <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text"
                     name="" style="font-size: 20px" placeholder="{{ __('general.search_in_menu') }}"
                     id="menu-search" onkeyup="menuSearch()">
             </div>
             <ul class="aiz-side-nav-list" id="search-menu">
             </ul>
             <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">

                 @can('admin_dashboard')
                     <li class="aiz-side-nav-item">
                         <a href="{{ route($route.'.dashboard') }}" class="aiz-side-nav-link">
                             <i class="las la-home aiz-side-nav-icon" style="font-size: 20px"></i>
                             <span class="aiz-side-nav-text" style="font-size: 20px">{{ __('general.dashboard') }}</span>
                         </a>
                     </li>
                 @endcan
             
                 @can('companies')
                     <li class="aiz-side-nav-item  ">
                         <a href="#" class="aiz-side-nav-link">
                             <i class="las la-users aiz-side-nav-icon" style="font-size: 20px"></i>
                             <span class="aiz-side-nav-text" style="font-size: 20px">{{ __('roles.companies') }}</span>
                             <span class="aiz-side-nav-arrow"></span>
                         </a>
                         <!--Submenu-->
                         <ul class="aiz-side-nav-list level-2">
                             @can('all_companies')
                                 <li class="aiz-side-nav-item">
                                     <a class="aiz-side-nav-link" href="{{ route( 'admin.companies') }}">
                                         <span class="aiz-side-nav-text"
                                             style="font-size: 16px">{{ __('roles.all_companies') }}</span>
                                     </a>
                                 </li>
                             @endcan
                             @can('create_company')
                                 <li class="aiz-side-nav-item">
                                     <a class="aiz-side-nav-link" href="{{ route( 'admin.companies.create') }}">
                                         <span class="aiz-side-nav-text"
                                             style="font-size: 16px">{{ __('roles.create_company') }}</span>
                                     </a>
                                 </li>
                             @endcan
                         </ul>
                     </li>
                 @endcan
                  
                 @can('user_management')
                 <li class="aiz-side-nav-item  ">
                     <a href="#" class="aiz-side-nav-link">
                         <i class="las la-users aiz-side-nav-icon" style="font-size: 20px"></i>
                         <span class="aiz-side-nav-text"
                             style="font-size: 20px">{{ __('roles.user_management') }}</span>
                         <span class="aiz-side-nav-arrow"></span>
                     </a>
                     <!--Submenu-->
                     <ul class="aiz-side-nav-list level-2">
                         @can('all_users')
                             <li class="aiz-side-nav-item">
                                 <a class="aiz-side-nav-link" href="{{ route($route.'.user_management') }}">
                                     <span class="aiz-side-nav-text"
                                         style="font-size: 16px">{{ __('roles.all_users') }}</span>
                                 </a>
                             </li>
                         @endcan
                         @can('create_user')
                             <li class="aiz-side-nav-item">
                                 <a class="aiz-side-nav-link" href="{{ route($route.'.user_management.create') }}">
                                     <span class="aiz-side-nav-text"
                                         style="font-size: 16px">{{ __('roles.create_user') }}</span>
                                 </a>
                             </li>
                         @endcan
                     </ul>
                 </li>
                 @endcan
                 @can('admin_roles')
                     <li class="aiz-side-nav-item  ">
                         <a href="#" class="aiz-side-nav-link">
                             <i class="las la-users aiz-side-nav-icon" style="font-size: 20px"></i>
                             <span class="aiz-side-nav-text" style="font-size: 20px">{{ __('roles.roles') }}</span>
                             <span class="aiz-side-nav-arrow"></span>
                         </a>
                         <!--Submenu-->
                         <ul class="aiz-side-nav-list level-2">
                             @can('show_admin_roles')
                                 <li class="aiz-side-nav-item">
                                     <a class="aiz-side-nav-link" href="{{ route($route.'.roles') }}">
                                         <span class="aiz-side-nav-text"
                                             style="font-size: 16px">{{ __('roles.all_roles') }}</span>
                                     </a>
                                 </li>
                             @endcan
                             @can('create_admin_roles')
                                 <li class="aiz-side-nav-item">
                                     <a class="aiz-side-nav-link" href="{{ route($route.'.roles.create') }}">
                                         <span class="aiz-side-nav-text"
                                             style="font-size: 16px">{{ __('roles.create_role') }}</span>
                                     </a>
                                 </li>
                             @endcan
                         </ul>
                     </li>
                 @endcan
             </ul><!-- .aiz-side-nav -->
         </div><!-- .aiz-side-nav-wrap -->
     </div><!-- .aiz-sidebar -->
     <div class="aiz-sidebar-overlay"></div>
 </div><!-- .aiz-sidebar -->
