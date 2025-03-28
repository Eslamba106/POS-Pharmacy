@extends('layouts.main')
{{-- @php
    $main_route = 'admin';
    // $main_route = app()->make('main_route');
@endphp --}}

@section('title')
    {{ __('roles.roles') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ __('roles.all_roles') }}
@endsection
@section('content')



@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ __('roles.roles') }}</h1>
            </div>
            @can('create_admin_roles')
                <div class="col text-right">
                    <a href="{{ route($main_route.'.roles.create') }}" class="btn btn-circle btn-info">
                        <span>{{ __('roles.create_role') }}</span>
                    </a>
                </div>
            @endcan
        </div>
    </div>
    <br>
    @can('show_admin_roles')
        <div class="card">
            <form class="" id="sort_roles" action="" method="GET">
                <div class="card-header row gutters-5">
                    <div class="col">
                        <h5 class="mb-md-0 h6">{{ __('roles.all_users') }}</h5>
                    </div>


                    <div class="dropdown mb-2 mb-md-0">
                        <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                            {{ __('roles.bulk_action') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item confirm-alert" href="javascript:void(0)" data-target="#bulk-delete-modal">
                                {{ __('roles.delete_selection') }}</a>
                        </div>
                    </div>



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
                                <th>{{ __('roles.title') }}</th>
                                <th data-breakpoints="sm">{{ __('roles.user_count') }}</th>
                                <th data-breakpoints="sm">{{ __('roles.is_admin') }}</th>
                                <th data-breakpoints="md">{{ __('roles.created_at') }}</th>
                                <th data-breakpoints="sm" class="text-center">
                                    {{ __('general.actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>
                                        <div class="form-group d-inline-block">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" class="check-one" name="id[]"
                                                    value="{{ $role->id }}">
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->users->count() }}</td>
                                    <td>
                                        @if ($role->is_admin)
                                            <span class="text-success fas fa-check"></span>
                                        @else
                                            <span class="text-danger fas fa-times"></span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($role->created_at)->format('Y-m-d') }}</td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @can('edit_admin_roles')
                                                <a class="btn btn-soft-secondary btn-icon btn-circle btn-sm"
                                                    href="{{ route($main_route.'.roles.edit', $role->id) }}" title="{{ __('general.edit') }}">
                                                    <i class="las la-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete_admin_roles')
                                                <a href="#"
                                                    class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                    data-href="{{ route($main_route.'.roles.delete', $role->id) }}"
                                                    title="{{ __('general.delete') }}">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $roles->links() }}
                    </div>
                </div>
            </form>
        </div>
    @endcan
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')
    <!-- Bulk Delete modal -->
    @include('modals.bulk_delete_modal')
@endsection


@push('script')
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
        function bulk_delete() {
            var data = new FormData($('#sort_roles')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route($main_route.'.bulk-role-delete') }}",
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
@endpush
