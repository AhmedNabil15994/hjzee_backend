@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.provider')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.providers.store')}}" class="store form-horizontal" novalidate>
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

                                        <div class="col-12">
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

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.name') }}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="{{ __('admin.name') }}" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.main_provider')}}</label>
                                                    <div class="controls">
                                                        <select name="parent_id" class="select2 form-control" >
                                                            <option value>{{__('admin.main_provider')}}</option>
                                                            @foreach ($providers as $provider)
                                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.type')}}</label>
                                                    <div class="controls">
                                                        <select name="type" class="select2 form-control" id="type" >
                                                            <option value>{{__('admin.type')}}</option>
                                                            <option value="service">{{__('admin.service')}}</option>
                                                            <option value="place">{{__('admin.place')}}</option>
                                                            <option value="">{{__('admin.service_place')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.gender')}}</label>
                                                    <div class="controls">
                                                        <select name="gender" class="select2 form-control"  >
                                                            <option value>{{__('admin.gender')}}</option>
                                                            <option value="male">{{__('admin.male')}}</option>
                                                            <option value="female">{{__('admin.female')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-4 col-12">
                                                            <select name="country_code" class="form-control select2">
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->key }}"
                                                                        @if ($settings['default_country'] == $country->id)
                                                                            selected
                                                                        @endif >
                                                                    {{ '+'.$country->key }}{{ $country->flag}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8 col-12">
                                                            <div class="controls">
                                                                <input type="number" name="phone" class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.email')}}</label>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" placeholder="{{__('admin.enter_the_email')}}" data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.password')}}</label>
                                                    <div class="controls">
                                                        <input type="password" name="password" class="form-control"  required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                    </div>
                                                </div>
                                            </div>
                                    {{-- to create languages tabs uncomment that --}}
                                       <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.job')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" name="job[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.job')}} {{ $lang }}"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="info">{{ __('admin.info') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="info[{{$lang}}]" id="info" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.info')}} {{ $lang }}" ></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="education_info">{{ __('admin.education_info') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="education_info[{{$lang}}]" id="education_info" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.education_info')}} {{ $lang }}" ></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.num_courses') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="num_courses" class="form-control" min="0" step="1"
                                                            placeholder="{{ __('admin.num_courses') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.num_lessons') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="num_lessons" class="form-control" min="0" step="1"
                                                            placeholder="{{ __('admin.num_lessons') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="notes">{{ __('admin.notes') }}</label>
                                                        <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"
                                                            placeholder="{{__('admin.write') . __('admin.notes')}}" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.expire_at') }}</label>
                                                    <div class="controls">
                                                        <input type="date" name="expire_at" class="form-control" placeholder="{{ __('admin.expire_at') }}">
                                                    </div>
                                                </div>
                                            </div> --}}
                                    {{--  to create languages tabs uncomment that --}}
                                    </div>

                                    <div class="col-6">
                                        <h5>{{__('provider.Employee\'s permissions')}}</h5>
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.addPlaceReservation" >
                                                {{__('provider.add_place_reservation')}}
                                            </div>
                                           
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.places" >
                                                {{__('admin.places')}}
                                            </div>
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.new">
                                                {{__('provider.new_place_reservations')}}
                                            </div>
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.finished">
                                                {{__('provider.finished_place_reservations')}}
                                            </div>
                                            {{-- <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.editPlaceReservation">
                                                {{__('provider.edit_place_reservation')}}
                                            </div> --}}
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.reservationPlaceDetails">
                                                {{__('provider.reservation_place_details')}}
                                            </div>
                                        {{-- @else --}}
                                            <div class="service">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.addServiceReservation">
                                                {{__('provider.add_service_reservation')}}
                                            </div>
                                            <div class="service">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.services">
                                                {{__('admin.services')}}
                                            </div>
                                            <div class="service">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.reservations">
                                                {{__('provider.service_reservations')}}
                                            </div>
                                        {{-- @endif --}}
                    
                    
                                        {{-- <div class="service">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.editServiceReservation">
                                            <span><i class="fas fa-check"></i></span>
                                            <p> {{__('provider.edit_service_reservation')}}</p>
                                        </div> --}}
                                        <div class="service">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.reservationServiceDetails">
                                            {{__('provider.reservation_service_details')}}
                                        </div>
                                        <div >
                                            <input type="checkbox" name="employee_permissions[]" value="provider.deleteReservation">
                                            {{__('provider.delete_reservation')}}
                                        </div>
                    
                                    </div>
                    
                                    <div class="col-6">
                                        <h5></h5>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.employees">
                                            {{__('provider.Employees')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.addEmployee">
                                            {{__('provider.add_employee')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.editEmployee">
                                            {{__('provider.edit_employee')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.employeeDetails">
                                            {{__('provider.employee_details')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.deleteEmployee">
                                            {{__('provider.delete_employee')}}
                                        </div>
                    
                    
                                    </div>

                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.add') }}</button>
                                            <a href="{{ url()->previous() }}" type="reset"
                                                class="btn btn-outline-warning mr-1 mb-1">{{ __('admin.back') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
    <script>
    $('#type').on('change', function(e) { 
        e.preventDefault();
        var type = $('#type').val();
        if(type == 'place'){
            $('.place').show();
            $('.service').hide();
        }else if(type == 'service'){
            $('.place').hide();
            $('.service').show();
        }else{
            $('.place').show();
            $('.service').show();
        }
    });
    </script>

@endsection
