@extends('layouts.main')
@section('title')
    {{ __('roles.create_category') }}
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
                    <h5 class="mb-0 h6">{{ __('roles.create_category') }}</h5>
                </div>

                <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="category_name_ar">{{ __('categories.category_name_ar') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('categories.category_name_ar') }}" id="category_name_ar" name="category_name_ar"
                                    class="form-control" required>
                            </div>
                            @error('category_name_ar')
                                <span class="text-red">
                                    {{ $errors->first('category_name_ar') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="category_name_en">{{ __('categories.category_name_en') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ __('categories.category_name_en') }}" id="category_name_en" name="category_name_en"
                                    class="form-control" required>
                            </div>
                            @error('category_name_en')
                                <span class="text-red">
                                    {{ $errors->first('category_name_en') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="category_description_ar">{{ __('categories.category_description_ar') }}</label>
                            <div class="col-sm-9">
                                <textarea id="category_description_ar" name="category_description_ar" class="form-control"></textarea>

                            </div>
                            @if ($errors->has('category_description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="category_description_en">{{ __('categories.category_description_en') }}</label>
                            <div class="col-sm-9">
                                <textarea id="category_description_en" name="category_description_en" class="form-control"></textarea>
 
                            </div>
                            @if ($errors->has('category_description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_description_en') }}</strong>
                                </span>
                            @endif
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
