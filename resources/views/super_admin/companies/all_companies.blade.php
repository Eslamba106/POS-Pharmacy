@extends('layouts.admin.main')
@push('css_or_js')
@endpush
@section('title')
    {{ __('roles.all_companies') }}
@endsection
@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ __('roles.all_companies') }}</h1>
            </div>
            @can('create_company' )  
            <div class="col text-right">
                <a href="{{ route('admin.companies.create') }}" class="btn btn-circle btn-info">
                    <span>{{ __('roles.create_company') }}</span>
                </a>
            </div>
            @endcan
        </div>
    </div>
    <br>
    @can('all_companies' )  
    <div class="card">
        <form class="" id="sort_companies" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ __('roles.all_companies') }}</h5>
                </div>

                @can('delete_company' )  
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
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <div class="form-group d-inline-block">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-one" name="id[]"
                                                value="{{ $company->id }}">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class=" ">

                                        <div class="col">
                                            <span class="text-muted text-truncate-2">{{ $company->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $company->user_name }}
                                </td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->role_name }}</td>
                                @can('change_companies_status' )  
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_user_status(this)" value="{{ $company->id }}"
                                            type="checkbox" <?php if ($company->status == 'active') {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                @endcan
                                <td class="text-center">
                                    @can('edit_user' )  
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route('user_management.view', $company->id) }}"
                                        title="{{ __('general.view') }}">
                                        <i class="las la-eye"></i>
                                    </a>
                                    @endcan
                                    @can('edit_user' )  
                                    <a class="btn btn-soft-secondary btn-icon btn-circle btn-sm"
                                        href="{{ route('user_management.edit',  $company->id) }}"
                                        title="{{ __('general.edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete_user' ) 
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('user_management.delete', $company->id) }}"
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
                    {{ $companies->links() }}
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
            var data = new FormData($('#sort_companies')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-user-delete') }}",
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
