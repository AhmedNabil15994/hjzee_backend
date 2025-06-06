@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
<form  method="POST" action="{{route('admin.images.store')}}" class="store form-horizontal" novalidate>

<!-- // Basic multiple Column Form section start -->
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
                                    {{-- to create languages tabs uncomment that --}}
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

                                    {{-- to create languages tabs uncomment that --}}
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
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.from_date')}}</label>
                                            <div class="controls">
                                                <input type="date" name="start_date"  class="form-control" placeholder="{{__('admin.from_date')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.to_date')}}</label>
                                            <div class="controls">
                                                <input type="date" name="end_date" class="form-control" placeholder="{{__('admin.to_date')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.type')}}</label>
                                            <div class="controls">
                                                <select name="type" id="type" class="select2 form-control" >
                                                    <option >{{__('admin.type')}}</option>
                                                    <option value="link">{{__('admin.link')}}</option>
                                                    <option value="service">{{__('admin.service')}}</option>
                                                    <option value="place">{{__('admin.place')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12" id="link_section" style="display:none;">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.link')}}</label>
                                            <div class="controls">
                                                <input type="text" name="link"  class="form-control" placeholder="{{__('admin.link')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12" id="service_section" style="display:none;">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.service')}}</label>
                                            <div class="controls">
                                                <select name="service_id" id="service_id" class="select2 form-control" >
                                                    <option value>{{__('admin.service')}}</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12" id="place_section" style="display:none;">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.place')}}</label>
                                            <div class="controls">
                                                <select name="place_id" id="place_id" class="select2 form-control" >
                                                    <option value>{{__('admin.place')}}</option>
                                                    @foreach ($places as $place)
                                                        <option value="{{$place->id}}">{{$place->name}}</option>
                                                    @endforeach
                                                </select>
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
    <script>
        $('#type').on('change', function(e) { 
            e.preventDefault();
            var type = $('#type').val();
            if(type == 'service'){
                $('#place_section').hide();
                $('#link_section').hide();
                $('#service_section').show();
            }else if(type == 'place'){
                $('#place_section').show();
                $('#service_section').hide();
                $('#link_section').hide();
            }else if(type == 'link'){
                $('#place_section').hide();
                $('#service_section').hide();
                $('#link_section').show();
            }
        });
    </script>
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
        @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
    
@endsection