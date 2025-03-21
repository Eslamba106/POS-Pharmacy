@extends('layouts.main')
@push('css_or_js')
@endpush
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
@section('title')
    {{ __('roles.all_users') }}
@endsection
@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ __('roles.all_users') }}</h1>
            </div>
            @can('create_user' )  
            <div class="col text-right">
                <a href="{{ route($route .'.user_management.create') }}" class="btn btn-circle btn-info">
                    <span>{{ __('roles.create_user') }}</span>
                </a>
            </div>
            @endcan
        </div>
    </div>
    <br>
    @can('all_users' )  
    <div class="card">
        <form class="" id="sort_users" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ __('roles.all_users') }}</h5>
                </div>

                @can('delete_user' )  
                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ __('roles.bulk_action') }}
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item confirm-alert" href="javascript:void(0)" data-target="#bulk-delete-modal">
                            {{ __('roles.delete_selection') }}</a>
                    </div>
                    
                </div>

                @endcan

                {{-- <div class="col-md-2 ml-auto">
                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type"
                        onchange="sort_products()">
                        <option value="">{{ __('Sort By') }}</option>
                        {{-- <option value="rating,desc" @isset($col_name, $query) @if ($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{__('Rating (High > Low)')}}</option>
                    <option value="rating,asc" @isset($col_name, $query) @if ($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{__('Rating (Low > High)')}}</option>
                    <option value="num_of_sale,desc"@isset($col_name, $query) @if ($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{__('Num of Sale (High > Low)')}}</option>
                    <option value="num_of_sale,asc"@isset($col_name, $query) @if ($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{__('Num of Sale (Low > High)')}}</option>
                    <option value="unit_price,desc"@isset($col_name, $query) @if ($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{__('Base Price (High > Low)')}}</option>
                    <option value="unit_price,asc"@isset($col_name, $query) @if ($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{__('Base Price (Low > High)')}}</option>  
                    </select>
                </div> --}}
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ __('general.type_enter') }}">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table aiz-table mb-0"> {{--  aiz-table --}}
                    <thead>
                        <tr>
                            <th>
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-all">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                            </th>

                            <th>{{ __('users.name') }}</th>

                            <th data-breakpoints="sm">{{ __('users.user_name') }}</th>

                            <th data-breakpoints="sm">{{ __('users.email') }}</th>
                            <th data-breakpoints="sm">{{ __('roles.role') }}</th>
                            <th data-breakpoints="md">{{ __('general.status') }}</th>
                            <th data-breakpoints="sm" class="text-center">{{ __('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($users) }} --}}
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="form-group d-inline-block">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-one" name="id[]"
                                                value="{{ $user->id }}">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class=" ">

                                        <div class="col">
                                            <span class="text-muted text-truncate-2">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $user->user_name }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_name }}</td>
                                @can('change_users_status' )  
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_user_status(this)" value="{{ $user->id }}"
                                            type="checkbox" <?php if ($user->status == 'active') {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                @endcan
                                <td class="text-center">
                                    @can('edit_user' )  
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route($route .'.user_management.view', $user->id) }}"
                                        title="{{ __('general.view') }}">
                                        <i class="las la-eye"></i>
                                    </a>
                                    @endcan
                                    @can('edit_user' )  
                                    <a class="btn btn-soft-secondary btn-icon btn-circle btn-sm"
                                        href="{{ route($route .'.user_management.edit',  $user->id) }}"
                                        title="{{ __('general.edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete_user' ) 
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route($route .'.user_management.delete', $user->id) }}"
                                        title="{{ __('general.delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $users->links() }}
                </div>
            </div>
        </form>
    </div>
    @endcan 
@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')
    <!-- Bulk Delete modal -->
    @include('modals.bulk_delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_user_status(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'inactive';
            }
            $.post('{{ route('user_management.update_status') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        AIZ.plugins.notify('success', '{{ __('general.updated_successfully') }}');
                    } else {
                        AIZ.plugins.notify('danger', '{{ __('general.error_in_update') }}');
                    }
                });
        }

  

        function bulk_delete() {
            var data = new FormData($('#sort_users')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route($route .'.bulk-user-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
