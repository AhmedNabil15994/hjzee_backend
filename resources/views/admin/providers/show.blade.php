@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.provider')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
                            @csrf
                            @method('PUT')
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
                                                            <div class="uploadedBlock">
                                                                <img src="{{$provider->image}}">
                                                                <button class="close"><i class="feather icon-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.name') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{ $provider->name }}" class="form-control"
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
                                                        @foreach ($providers as $prvdr)
                                                            <option value="{{$prvdr->id}}" {{ $prvdr->id == $provider->parent_id ?'selected' :'' }}>{{$prvdr->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.type')}}</label>
                                                <div class="controls">
                                                    <select name="type" class="select2 form-control" id="type"  >
                                                        <option value>{{__('admin.type')}}</option>
                                                        <option value="service" {{ $provider->type == 'service' ?'selected' :'' }}>{{__('admin.service')}}</option>
                                                        <option value="place" {{ $provider->type == 'place' ?'selected' :'' }}>{{__('admin.place')}}</option>
                                                        <option value="" {{ $provider->type == '' ?'selected' :'' }} >{{__('admin.service_place')}}</option>
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
                                                        <option value="male" {{$provider->gender == 'male' ? 'selected':''}}>{{__('admin.male')}}</option>
                                                        <option value="female" {{$provider->gender == 'female' ? 'selected':''}}>{{__('admin.female')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-12">
                                                        <select name="country_code" class="form-control select2" >
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->key }}"
                                                                    @if ($provider->country_code == $country->key)
                                                                        selected
                                                                    @endif >
                                                                {{ '+'.$country->key }}{{ $country->flag}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8 col-12">
                                                        <div class="controls">
                                                            <input type="number" name="phone" value="{{$provider->phone}}"  class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.email')}}</label>
                                                <div class="controls">
                                                    <input type="email" name="email" value="{{$provider->email}}" class="form-control" placeholder="{{__('admin.enter_the_email')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}" >
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
                                                                    <input type="text" name="job[{{$lang}}]" value="{{$provider->getTranslations('job')[$lang]??''}}" class="form-control" placeholder="{{__('admin.write') . __('admin.job')}} {{ $lang }}"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="info">{{ __('admin.info') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="info[{{$lang}}]" id="info" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.info')}} {{ $lang }}" >{{$provider->getTranslations('info')[$lang]??''}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="education_info">{{ __('admin.education_info') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="education_info[{{$lang}}]" id="education_info" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.education_info')}} {{ $lang }}" >{{$provider->getTranslations('education_info')[$lang]??''}}</textarea>
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
                                                        <input type="number" name="num_courses" value="{{ $provider->num_courses }}" class="form-control" min="0" step="1"
                                                            placeholder="{{ __('admin.num_courses') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.num_lessons') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="num_lessons" value="{{ $provider->num_lessons }}" class="form-control" min="0" step="1"
                                                            placeholder="{{ __('admin.num_lessons') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="notes">{{ __('admin.notes') }}</label>
                                                        <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"
                                                            placeholder="{{__('admin.write') . __('admin.notes')}}" >{{ $provider->notes }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.expire_at') }}</label>
                                                    <div class="controls">
                                                        <input type="date" name="expire_at" value="{{ $provider->expire_at }}" class="form-control" placeholder="{{ __('admin.expire_at') }}">
                                                    </div>
                                                </div>
                                            </div> --}}
                                    {{--  to create languages tabs uncomment that --}}
                                    </div>
                                    <div class="col-6">
                                        <h5>{{__('provider.Employee\'s permissions')}}</h5>
                                        <div class="place">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.addPlaceReservation" {{in_array('provider.addPlaceReservation',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.add_place_reservation')}}
                                        </div>
                                        {{-- @if(auth('provider')->user()->type == 'place') --}}
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.places" {{in_array('provider.places',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('admin.places')}}
                                            </div>
                    
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.new"{{in_array('provider.new',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('provider.new_place_reservations')}}
                                            </div>
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.finished" {{in_array('provider.finished',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('provider.finished_place_reservations')}}
                                            </div>
                    
                                            {{-- <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.editPlaceReservation" {{in_array('provider.editPlaceReservation',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('provider.edit_place_reservation')}}
                                            </div> --}}
                                            <div class="place">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.reservationPlaceDetails" {{in_array('provider.reservationPlaceDetails',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('provider.reservation_place_details')}}
                                            </div>
                                        {{-- @else --}}
                                        <div class="service">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.addServiceReservation" {{in_array('provider.addServiceReservation',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.add_service_reservation')}}
                                        </div>
                                            <div class="service">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.services" {{in_array('provider.services',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('admin.services')}}
                                            </div>
                                            <div class="service">
                                                <input type="checkbox" name="employee_permissions[]" value="provider.reservations" {{in_array('provider.reservations',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                                {{__('provider.service_reservations')}}
                                            </div>
                                        {{-- @endif --}}
                    
                                        {{-- <div class="service">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.editServiceReservation" {{in_array('provider.editServiceReservation',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.edit_service_reservation')}}
                                        </div> --}}
                                        <div class="service">
                                            <input type="checkbox" name="employee_permissions[]" value="provider.reservationServiceDetails" {{in_array('provider.reservationServiceDetails',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.reservation_service_details')}}
                                        </div>
                    
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.deleteReservation" {{in_array('provider.deleteReservation',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.delete_reservation')}}
                                        </div>
                    
                                    </div>
                    
                                    <div class="col-6">
                                        <h5></h5>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.employees" {{in_array('provider.employees',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.Employees')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.addEmployee" {{in_array('provider.addEmployee',$provider->employee_permissions??[]) ? 'checked' : ''}} >
                                            {{__('provider.add_employee')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.editEmployee" {{in_array('provider.editEmployee',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.edit_employee')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.employeeDetails" {{in_array('provider.employeeDetails',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.employee_details')}}
                                        </div>
                                        <div>
                                            <input type="checkbox" name="employee_permissions[]" value="provider.deleteEmployee" {{in_array('provider.deleteEmployee',$provider->employee_permissions??[]) ? 'checked' : ''}}>
                                            {{__('provider.delete_employee')}}
                                        </div>
                    
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
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
    <script>
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
        <script>

            $(window).on('load', function(e) { 
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