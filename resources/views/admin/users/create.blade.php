@extends('layouts.main')
@section('title')
    {{ __('roles.create_user') }}
@endsection
@push('css_or_js')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ __('Staff Information') }}</h5>
                </div>

                <form class="form-horizontal" action="{{ route('user_management.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ __('users.name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('users.name') }}" id="name" name="name"
                                    class="form-control" required>
                            </div>
                            @error('name')
                                <span class="text-red">
                                    {{ $errors->first('name') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="user_name">{{ __('users.user_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('users.user_name') }}" id="user_name" name="user_name"
                                    class="form-control" required>
                            </div>
                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="email">{{ __('users.email') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('users.email') }}" id="email" name="email"
                                    class="form-control"  >
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="mobile">{{ __('users.phone') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('users.phone') }}" id="mobile" name="phone"
                                    class="form-control"  >
                            </div>
                            @error('phone')
                                <span class="text-red">
                                    {{ $errors->first('phone') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="password">{{ __('login.password') }}</label>
                            <div class="col-sm-9">
                                <input type="password" placeholder="{{ __('login.password') }}" id="password"
                                    name="password" class="form-control" required>
                            </div>
                            @error('password')
                                <span class="text-red">
                                    {{ $errors->first('password') }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ __('roles.role') }}</label>
                            <div class="col-sm-9">
                                <select name="role_id" required class="form-control aiz-selectpicker">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role_id')
                                <span class="text-red">
                                    {{ $errors->first('role_id') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('general.save') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
