@extends('layouts.main')


@section('title')
    {{ __('roles.edit_role') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset(main_path() .'css/select2.min.css') }}" rel="stylesheet" />
@endpush
 
@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
               
                {{ __('roles.edit_role') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route($main_route.'.roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
 
                                        <div class="form-group @error('name') is-invalid @enderror">
                                            <label>{{ trans('roles.name') }}</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ !empty($role) ? $role->name : old('name') }}" placeholder="" />
                                        </div>

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $error }}
                                            </div>
                                        @enderror 

                                    <div class="form-group @error('caption') is-invalid @enderror">
                                        <label>{{ trans('roles.caption') }}</label>
                                        <input type="text" name="caption" class="form-control"
                                            value="{{ !empty($role) ? $role->caption : old('caption') }}" placeholder="" />

                                        @error('caption')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>



                                </div>
                            </div>


                            <div class="form-group" id="sections">

                                @can('edit_admin_roles')
                                    <div class="mt-3"></div>
                                    <div class="row">
                                        @foreach ($sections as $section)
                                            <div
                                                class="section-card is_{{ $section->type }} col-12 col-md-6 col-lg-4 {{ (!empty($role) and $role->is_admin and $section->type == 'panel') ? 'd-none' : '' }} {{ (!empty($role) and !$role->is_admin and $section->type == 'admin') ? 'd-none' : '' }} {{ (empty($role) and $section->type == 'admin') ? 'd-none' : '' }}">
                                                <div class="card card-primary section-box">
                                                    <div class="card-header">
                                                        <input type="checkbox" name="permissions[]"
                                                            id="permissions_{{ $section->id }}" value="{{ $section->id }}"
                                                            {{ isset($permissions[$section->id]) ? 'checked' : '' }}
                                                            class="form-check-input mt-0 section-parent">
                                                        <label
                                                            class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                                            for="permissions_{{ $section->id }}">
                                                            {{ __('roles.' . $section->caption) }}
                                                        </label>
                                                    </div>

                                                    @if (!empty($section->children))
                                                        <div class="card-body">

                                                            @foreach ($section->children as $key => $child)
                                                                <div class="form-check mt-1">
                                                                    <input type="checkbox" name="permissions[]"
                                                                        id="permissions_{{ $child->id }}"
                                                                        value="{{ $child->id }}"
                                                                        {{ isset($permissions[$child->id]) ? 'checked' : '' }}
                                                                        class="form-check-input section-child">
                                                                    <label
                                                                        class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                                                        for="permissions_{{ $child->id }}">
                                                                        {{ __('roles.' . $child->caption) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endcan
                            </div>


                            @php
                                $lang = Session::get('locale');
                                $default_lang = 'ar';
                            @endphp


                            <div class="d-flex gap-3 justify-content-end">

                                <button type="submit" class="btn btn-primary px-4">{{ __('general.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




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
@push('script')
    <script src="{{ asset(main_path().'js/roles.min.js') }}"></script>
@endpush
