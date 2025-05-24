@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.edit_employee')}}</h5>
            </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form class="row" action="{{route('provider.updateEmployee',[$employee])}}" method="POST"  enctype="multipart/form-data" id="form">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $employee->id }}" name="id">
                <div class="form_label col-12 position-relative">
                    <div class="imgMontg col-12 text-center">
                        <div class="dropBox">
                            <div class="textCenter">
                                <div class="imagesUploadBlock">
                                    <label class="uploadImg">
                                        <span>{{ __('admin.image') }}</span>
                                        <span><i class="feather icon-image"></i></span>
                                        <input type="file" accept="image/*" name="image" class="imageUploader">
                                    </label>
                                    <div class="uploadedBlock">
                                        <img src="{{$employee->image}}">
                                        <button class="close"><i class="la la-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                
                <div class="form_label col-12">
                    <input type="text" name="name" value="{{$employee->name}}" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.Employee Name')}}</label>
                </div>

                <div class="form_label col-12">
                    <input type="text" name="phone" value="{{$employee->phone}}" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.Employee\'s phone')}}</label>
                </div>
                <div class="form_label col-12">
                    <input type="email" name="email" value="{{$employee->email}}" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.Employee\'s email')}}</label>
                </div>
                <div class="form_label col-12">
                    <input type="password" name="password" class="input_focus addofferinput" />
                    <label class="float_label">{{__('provider.password')}}</label>
                </div>

                

                {{-- <div class="col-6">
                    <h5>{{__('provider.Employee\'s permissions')}}</h5>
                    <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.addPlaceReservation" {{in_array('provider.addPlaceReservation',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.add_place_reservation')}}</p>
                    </div> --}}
                    {{-- @if(auth('provider')->user()->type == 'place') --}}
                        {{-- <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.places" {{in_array('provider.places',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('admin.places')}}</p>
                        </div>

                        <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.new"{{in_array('provider.new',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('provider.new_place_reservations')}}</p>
                        </div>
                        <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.finished" {{in_array('provider.finished',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('provider.finished_place_reservations')}}</p>
                        </div> --}}

                        {{-- <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.editPlaceReservation" {{in_array('provider.editPlaceReservation',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('provider.edit_place_reservation')}}</p>
                        </div> --}}
                        {{-- <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.reservationPlaceDetails" {{in_array('provider.reservationPlaceDetails',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('provider.reservation_place_details')}}</p>
                        </div> --}}
                    {{-- @else --}}
                    {{-- <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.addServiceReservation" {{in_array('provider.addServiceReservation',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.add_service_reservation')}}</p>
                    </div>
                        <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.services" {{in_array('provider.services',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('admin.services')}}</p>
                        </div>
                        <div class="privilege">
                            <input type="checkbox" name="employee_permissions[]" value="provider.reservations" {{in_array('provider.reservations',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                            <span><i class="fas fa-check"></i></span>
                            <p> {{__('provider.service_reservations')}}</p>
                        </div> --}}
                    {{-- @endif --}}

                    {{-- <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.editServiceReservation" {{in_array('provider.editServiceReservation',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.edit_service_reservation')}}</p>
                    </div> --}}
                    {{-- <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.reservationServiceDetails" {{in_array('provider.reservationServiceDetails',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.reservation_service_details')}}</p>
                    </div>

                    <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.deleteReservation" {{in_array('provider.deleteReservation',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.delete_reservation')}}</p>
                    </div>

                </div> --}}
{{-- 
                <div class="col-6">
                    <h5></h5>
                    <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.employees" {{in_array('provider.employees',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p>{{__('provider.Employees')}} </p>
                    </div> --}}
                    {{-- <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.addEmployee" {{in_array('provider.addEmployee',$employee->employee_permissions??[]) ? 'checked' : ''}} >
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.add_employee')}}</p>
                    </div> --}}
                    {{-- <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.editEmployee" {{in_array('provider.editEmployee',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.edit_employee')}}</p>
                    </div>
                    <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.employeeDetails" {{in_array('provider.employeeDetails',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.employee_details')}}</p>
                    </div>
                    <div class="privilege">
                        <input type="checkbox" name="employee_permissions[]" value="provider.deleteEmployee" {{in_array('provider.deleteEmployee',$employee->employee_permissions??[]) ? 'checked' : ''}}>
                        <span><i class="fas fa-check"></i></span>
                        <p> {{__('provider.delete_employee')}}</p>
                    </div>

                </div> --}}

                <div class="col-12">
                    <button class="add-btn">{{__('provider.save')}}</button>
                </div>
            </form>
        </div>
    </div>

@section('js')
<script>
    $(".image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
                $('.image-preview').addClass("up");
                $(".fancyLink").attr("href" , e.target.result)
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
@endsection
