@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
 @endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<form  method="POST" action="{{route('admin.places-categories.store')}}" class="store form-horizontal" novalidate>
<section id="multiple-column-form">
            <div class="row">
            <div class="col-md-3">
            <div class="col-12 card card-body">
                <div class="imgMontg col-12 text-center">
                    <div class="dropBox">
                        <div class="textCenter">
                            <div class="imagesUploadBlock">
                                <label class="uploadImg">
                                    <span><i class="feather icon-image"></i></span>
                                    <input type="file" accept="image/*" name="image" class="imageUploader">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.add')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-12">
                                            <div class="col-12">
                                                <ul class="nav nav-tabs  mb-3">
                                                    @foreach (languages() as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div> 

                                            <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <input type="hidden" name="type" value="place">
                                           
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.select_main_section')}}</label>
                                                    <input type="hidden" name="parent_id" id="root_category" value="">
                                                    <div class="col-md-12 col-12" id="category_level">
                                                        <div id="jstree">
                                                            @include('admin.categories_services.view_tree',['mainCategories' => $categories])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.sort')}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="sort"  class="form-control" placeholder="{{__('admin.sort')}}" min="0" >
                                                    </div>
                                                </div>
                                            </div>
                                    </div> 
                                    



                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.add')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form>

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
        @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript">
    $(function () {

        $('#jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('#jstree').on("changed.jstree", function (e, data) {
            $('#root_category').val(data.selected);
        });

    });
</script>
@endsection