@extends('layouts.main')
@push('css_or_js')
@endpush
@section('content')

    <div class="col-lg-6  mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{__('users.profile')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('user_management.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{__('users.name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="{{__('users.name')}}" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{__('users.email')}}</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" placeholder="{{__('users.email')}}" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{__('users.user_name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="{{__('users.user_name')}}" name="user_name" value="{{ $user->user_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="new_password">{{__('users.new_password')}}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="{{__('users.new_password')}}" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="new_password">{{__('roles.role')}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $user->role_name }}" placeholder="{{__('roles.role')}}" readonly >
                        </div>
                    </div>
                     
                    {{-- <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{__('Avatar')}} <small>(90x90)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                <input type="hidden" name="avatar" class="selected-files" value="{{ $user->avatar_original }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{__('general.update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
