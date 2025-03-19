@extends('layouts.back-end.app')


@section('title')
{{__('roles.edit_user')}}
@endsection
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img width="80px" height="80px" src="{{asset('/public/assets/back-end/img/user_edit.png')}}" alt="">
                {{__('roles.edit_user')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('user_management.update' , $user->id) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('patch')

            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <img src="{{asset('/public/assets/back-end/img/seller-information.png')}}" class="mb-1" alt="">
                        <h4 class="mb-0">{{ __('roles.edit_user') . " " .$user->name }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('roles.name') }}</label>
                                <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                            </div>
                        </div>
                       
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="user_name" class="title-color">{{ __('roles.user_name') }}</label>
                                <input type="text" value="{{ $user->user_name }}"  class="form-control" name="user_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <label for="user_name" class="title-color">{{ __('roles.password') }}</label>

                            <div class="form-group input-group input-group-merge">

                                <input type="password" class="js-toggle-password form-control"
                                    name="password" id="signupSrPassword"
                                    placeholder="{{ __('8+_characters_required') }}" 
                                    data-hs-toggle-password-options='{
                                    "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",  
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>
                                <div id="changePassTarget" class="input-group-append">
                                    <a class="input-group-text" href="javascript:">
                                        <i id="changePassIcon" class="tio-visible-outlined"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ __('roles.roles') }}</label>
                                <select class="js-select2-custom form-control" name="role"
                                        required>
                                    <option value="{{ old('role') }}" selected disabled>{{ __('general.select') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
                
        
            </div>

            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ __('reset') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ __('submit') }}</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(function() {
            $('#color_switcher').click(function(){
                var checkBoxes = $("#color_switcher");
                if ($('#color_switcher').prop('checked')) {
                    $('.color_image_column').removeClass('d-none');
                    $('.additional_image_column').removeClass('col-md-9');
                    $('.additional_image_column').addClass('col-md-12');
                    $('#color_wise_image').show();
                    $('#additional_Image_Section .col-md-4').addClass('col-lg-2');
                } else {
                    $('.color_image_column').addClass('d-none');
                    $('.additional_image_column').addClass('col-md-9');
                    $('.additional_image_column').removeClass('col-md-12');
                    $('#color_wise_image').hide();
                    $('#additional_Image_Section .col-md-4').removeClass('col-lg-2');
                }
            });

            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 15,
                rowHeight: 'auto',
                groupClassName: 'col-6 col-md-4 col-lg-3 col-xl-2',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset("public/assets/back-end/img/400x400/img2.jpg") }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error('{{ __("please_only_input_png_or_jpg_type_file") }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ __("file_size_too_big") }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>
    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="col-md-6"><div class="form-group"><input type="hidden" name="choice_no[]" value="' + i + '"><label class="title-color">' + n + '</label><input type="text" name="choice[]" value="' + n +
                '" hidden><div class=""><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{ __('enter_choice_values') }}" data-role="tagsinput" onchange="update_sku()"></div></div></div>'
            );

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $('#colors-selector').on('change', function() {
            update_sku();
            $('#color_switcher').prop('checked')
            {
                color_wise_image($('#colors-selector'));
            }
            $('.remove_button').on('click',function(){
                alert('ok');
                $(this).parents('.upload_images').find('.color_image').attr('src','{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}')
            })
        });


        function color_wise_image(t){
            let colors = t.val();
            $('#color_wise_image').html('')
            $.each(colors, function(key, value){
                let value_id = value.replace('#','');
                let color= "color_image_"+value_id;

                html = `<div class="col-sm-12 col-md-4">
                            <div class="custom_upload_input position-relative border-dashed-2">
                                <input type="file" name="`+color+`" class="custom-upload-input-file" id="color-img-upload-`+value_id+`" data-index="1" data-imgpreview="additional_Image_${value_id}"
                                    accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required onchange="uploadColorImage(this)">

                                <div class="position-absolute right-0 top-0 d-flex gap-2">
                                    <label for="color-img-upload-`+value_id+`" class="delete_file_input_css btn btn-outline-danger btn-sm square-btn position-relative" style="background: ${value};border-color: ${value};color:#fff">
                                        <i class="tio-edit"></i>
                                    </label>

                                    <span class="delete_file_input btn btn-outline-danger btn-sm square-btn position-relative" style="display: none">
                                        <i class="tio-delete"></i>
                                    </span>
                                </div>

                                <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                    <img id="additional_Image_${value_id}" class="h-auto aspect-1 bg-white" src="img" onerror="this.classList.add('d-none')">
                                </div>
                                <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('public/assets/back-end/img/icons/product-upload-icon.svg')}}" class="w-50">
                                        <h3 class="text-muted">{{ __('Upload_Image') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                $('#color_wise_image').append(html);

                $('.delete_file_input').click(function () {
                    let $parentDiv = $(this).parent().parent();
                    $parentDiv.find('input[type="file"]').val('');
                    $parentDiv.find('.img_area_with_preview img').attr("src", " ");
                    $(this).hide();
                });

                $('.custom-upload-input-file').on('change', function(){
                    if (parseFloat($(this).prop('files').length) != 0) {
                        let $parentDiv = $(this).closest('div');
                        $parentDiv.find('.delete_file_input').fadeIn();
                    }
                });

                uploadColorImage();
            });
        }

        function uploadColorImage(thisData = null){
            if(thisData){
                document.getElementById(thisData.dataset.imgpreview).setAttribute("src", window.URL.createObjectURL(thisData.files[0]));
                document.getElementById(thisData.dataset.imgpreview).classList.remove('d-none');
            }
        }




        $(document).ready(function() {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>

    <script>
        function check() {
            Swal.fire({
                title: '{{ __("are_you_sure") }}?',
                text: '{{ __("want_to_add_this_product") }}!',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: '{{ __("no") }}',
                confirmButtonText: '{{ __("yes") }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    let discount_value = parseFloat($('#discount').val());
                    let submit_status = 1;
                    $(".variation-price-input").each(function() {
                        let variation_price = parseFloat($(this).val());

                        if (variation_price < discount_value) {
                            toastr.error("the_discount_price_will_not_larger_then_Variant_Price");
                            submit_status = 0;
                            return false;
                        }
                    });

                    if(submit_status == 1)
                    {

                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();
                        }
                        var formData = new FormData(document.getElementById('product_form'));
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post({
                            url: '#',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                if (data.errors) {
                                    for (var i = 0; i < data.errors.length; i++) {
                                        toastr.error(data.errors[i].message, {
                                            CloseButton: true,
                                            ProgressBar: true
                                        });
                                    }
                                } else {
                                    toastr.success(
                                        '{{ __("product_added_successfully") }}!', {
                                            CloseButton: true,
                                            ProgressBar: true
                                        });
                                    $('#product_form').submit();
                                }
                            }
                        });
                    }

                }
            })
        };
    </script>



    {{-- ck editor --}}
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('.textarea').ckeditor({
            contentsLangDirection: '{{ Session::get('direction') }}',
        });
    </script>

    {{-- ck editor --}}

    <script>
        $('.delete_file_input').click(function () {
            let $parentDiv = $(this).closest('div');
            $parentDiv.find('input[type="file"]').val('');
            $parentDiv.find('.img_area_with_preview img').attr("src", " ");
            $(this).hide();
        });

        $('.custom-upload-input-file').on('change', function(){
            if (parseFloat($(this).prop('files').length) != 0) {
                let $parentDiv = $(this).closest('div');
                $parentDiv.find('.delete_file_input').fadeIn();
            }
        })
    </script>

    <script>
        function addMoreImage(thisData, targetSection){

            let $fileInputs = $(targetSection +" input[type='file']");
            let nonEmptyCount = 0;

            $fileInputs.each(function() {
                if (parseFloat($(this).prop('files').length) == 0) {
                    nonEmptyCount++;
                }
            });

            // let input_id = thisData.id;
            document.getElementById(thisData.dataset.imgpreview).setAttribute("src", window.URL.createObjectURL(thisData.files[0]));
            document.getElementById(thisData.dataset.imgpreview).classList.remove('d-none');

            if (nonEmptyCount == 0) {

                let dataset_index = thisData.dataset.index + 1;

                let newHtmlData = `<div class="col-sm-12 col-md-4">
                        <div class="custom_upload_input position-relative border-dashed-2">
                            <input type="file" name="${thisData.name}" class="custom-upload-input-file" data-index="${dataset_index}" data-imgpreview="additional_Image_${dataset_index}"
                                accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" onchange="addMoreImage(this, '${targetSection}')">

                            <span class="delete_file_input delete_file_input_section btn btn-outline-danger btn-sm square-btn" style="display: none">
                                <i class="tio-delete"></i>
                            </span>

                            <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                <img id="additional_Image_${dataset_index}" class="h-auto aspect-1 bg-white" src="img" onerror="this.classList.add('d-none')">
                            </div>
                            <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <img src="{{asset('public/assets/back-end/img/icons/product-upload-icon.svg')}}" class="w-50">
                                    <h3 class="text-muted">{{ __('Upload_Image') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>`;

                    $(targetSection).append(newHtmlData);
            }


            $('.custom-upload-input-file').on('change', function(){
                if (parseFloat($(this).prop('files').length) != 0) {
                    let $parentDiv = $(this).closest('div');
                    $parentDiv.find('.delete_file_input').fadeIn();
                }
            })

            $('.delete_file_input_section').click(function () {
                let $parentDiv = $(this).closest('div').parent().remove();
                // var filledInputs = $(targetSection +' input[type="file"]').length;
            });

            if ($('#color_switcher').prop('checked')) {
                $('#additional_Image_Section .col-md-4').addClass('col-lg-2');
            } else {
                $('#additional_Image_Section .col-md-4').removeClass('col-lg-2');
            }
        }

    </script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
        <script>
            document.getElementById('add-signature-pad').addEventListener('click', () => {
                createSignaturePad();
            });
    
            function createSignaturePad() {
             
                const padContainer = document.createElement('div');
                padContainer.classList.add('signature-pad-container');
    
                 const canvas = document.createElement('canvas');
                canvas.width = 400;
                canvas.height = 200;
                canvas.style.border = '1px solid #000';
    
                const clearButton = document.createElement('a');
                clearButton.textContent = "{{ __('general.clear') }}";
                clearButton.classList.add('btn', 'btn-danger', 'm-1');
                clearButton.addEventListener('click', () => {
                    signaturePad.clear();
                    inputElement.value = '';
                });
    
                const deleteButton = document.createElement('a');
                deleteButton.textContent = "{{ __('general.delete') }}";
                deleteButton.classList.add('btn', 'btn-warning');
                deleteButton.addEventListener('click', () => {
                    padContainer.remove();
                });
    
                padContainer.appendChild(canvas);
                padContainer.appendChild(clearButton);
                padContainer.appendChild(deleteButton);
                document.getElementById('signature-pads-container').appendChild(padContainer);
    
                const signaturePad = new SignaturePad(canvas);
    
                const inputElement = document.createElement('input');
                inputElement.type = 'hidden';
                inputElement.name = 'signatures[]';
    
                document.getElementById('signature-form').appendChild(inputElement);
    
                signaturePad.onEnd = () => {
                    inputElement.value = signaturePad.toDataURL('image/png');
                };
            }
        </script>
@endpush
