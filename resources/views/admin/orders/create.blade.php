@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.add_reservation')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.orders.store')}}" class="store form-horizontal" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.type')}}</label>
                                            <div class="controls">
                                                <select name="type" id="type" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                    <option>{{__('admin.type')}}</option>
                                                    <option value="0">{{__('admin.service')}}</option>
                                                    <option value="1">{{__('admin.place')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.client')}}</label>
                                            <div class="controls">
                                                <select name="user_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                    <option value>{{__('admin.client')}}</option>
                                                    @foreach ($users as $usr)
                                                        <option value="{{$usr->id}}">{{$usr->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.provider')}}</label>
                                            <div class="controls">
                                                <select name="provider_id" id="provider_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                    <option value>{{__('admin.provider')}}</option>
                                                    @foreach ($providers as $provider)
                                                        <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12" id="service_section">
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

                                    <div class="col-md-6 col-12" id="place_section">
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

                                    <div class="col-md-6 col-12" id="meeting_room_section">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.meetingroom')}}</label>
                                            <div class="controls">
                                                <select name="meeting_room_id" id="meeting_room_id"  class="select2 form-control" >
                                                    <option value>{{__('admin.meetingroom')}}</option>
                                                    @foreach ($rooms as $room)
                                                        <option value="{{$room->id}}">{{$room->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12" id="date_section">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.date')}}</label>
                                            <div class="controls">
                                                <input type="date" name="date" id="date" class="form-control" placeholder="{{ __('admin.date') }}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12" id="time_section">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.time')}}</label>
                                            <div class="controls">
                                                <select name="time" id="time" class="select2 form-control" >
                                                    <option value>{{__('admin.time')}}</option>
                                                    <option value="00:00:00">12:00 AM</option><option value="01:00:00">1:00 AM</option><option value="02:00:00">2:00 AM</option><option value="03:00:00">3:00 AM</option><option value="04:00:00">4:00 AM</option><option value="05:00:00">5:00 AM</option><option value="06:00:00">6:00 AM</option><option value="07:00:00">7:00 AM</option><option value="08:00:00">8:00 AM</option><option value="09:00:00">9:00 AM</option><option value="10:00:00">10:00 AM</option><option value="11:00:00">11:00 AM</option><option value="12:00:00">12:00 PM</option><option value="13:00:00">1:00 PM</option><option value="14:00:00">2:00 PM</option><option value="15:00:00">3:00 PM</option><option value="16:00:00">4:00 PM</option><option value="17:00:00">5:00 PM</option><option value="18:00:00">6:00 PM</option><option value="19:00:00">7:00 PM</option><option value="20:00:00">8:00 PM</option><option value="21:00:00">9:00 PM</option><option value="22:00:00">10:00 PM</option><option value="23:00:00">11:00 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.price')}}</label>
                                            <div class="controls">
                                                <input type="number" name="price" step="0.01" min="0" class="form-control" placeholder="{{__('admin.price')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.coupon_amount')}}</label>
                                            <div class="controls">
                                                <input type="number" name="coupon_amount" step="0.01" min="0" class="form-control" placeholder="{{__('admin.plan_discount')}}" >
                                            </div>
                                        </div>
                                    </div>  --}}

                                    <div class="col-md-6 col-12" id="quantity_section">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.quantity')}}</label>
                                            <div class="controls">
                                                <input type="number" name="quantity" id="quantity" step="1" min="0" class="form-control" placeholder="{{__('admin.quantity')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.final_total')}}</label>
                                            <div class="controls">
                                                <input type="number" name="final_total" step="0.01" min="0" class="form-control" placeholder="{{__('admin.final_total')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.pay_type')}}</label>
                                            <div class="controls">
                                                <select name="pay_type" class="select2 form-control"  >
                                                    <option value="0">{{__('admin.pay_type_undefined')}}</option>
                                                    <option value="1">{{__('admin.pay_type_cash')}}</option>
                                                    {{-- <option value="2">{{__('admin.pay_type_wallet')}}</option> --}}
                                                    <option value="3">{{__('admin.pay_type_bank')}}</option>
                                                    <option value="4">{{__('admin.pay_type_online')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.pay_status')}}</label>
                                            <div class="controls">
                                                <select name="pay_status" class="select2 form-control">
                                                    <option value="0">{{__('admin.pay_type_undefined')}}</option>
                                                    {{-- <option value="1">{{__('admin.pay_status_downpayment')}}</option> --}}
                                                    <option value="2">{{__('admin.pay_status_done')}}</option>
                                                    <option value="3">{{__('admin.pay_status_returned')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.is_confirmed')}} :</label>
                                            {{-- <div class="controls"> --}}
                                                <label class="switch">
                                                    <input name="is_confirmed" type="checkbox" value="1"/>
                                                    <span class="slider round"></span>
                                                </label>
                                            {{-- </div> --}}
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
                                    <span class="mt-3 mb-2 col-12 w-100 text-center user_names">{{__('admin.attendees_names')}}</span>
                                    <div class="col-12 append_here user_names">
                                        <div class="col-12 row">
                                            <div class="col-md-8 col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.name')}}</label>
                                                    <div class="controls">
                                                        <input type="text"  name="users_names[]" class="form-control" placeholder="{{__('admin.name')}}"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trash ">
                                                <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_name user_names">{{__('admin.add_name')}}</button>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.add') }}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{ __('admin.back') }}</a>
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

<div class="d-none">
    <div class="col-12 row delete_here" id="clone_div">
        <div class="col-md-8 col-6">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.name')}}</label>
                <div class="controls">
                    <input type="text"  name="users_names[]" class="form-control" placeholder="{{__('admin.name')}}"  >
                </div>
            </div>
        </div>
        
        <div class="trash ">
            <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
        </div>
    </div>
</div>

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
<script>
        $(document).on('click' , '.add_name', function (e) {
            e.preventDefault();
            var copy = $('#clone_div').clone()
            copy.find('.d-none').removeClass('d-none')
            copy.find('#clone_div').removeAttr('id')
            copy.find('.form-control').val(null)
            $('.append_here').append(copy)
        });
        $(document).on('click' , '.removeeventmore', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove()
        });

    $('#type').on('change', function(e) { 
        e.preventDefault();
        var type = $('#type').val();
        if(type == 1){
            $('#place_section').show();
            $('#meeting_room_section').show();
            $('#date_section').show();
            $('#time_section').show();
            $('#service_section').hide();
            $('#quantity_section').hide();
            $('.user_names').hide();
        }else{
            $('#place_section').hide();
            $('#meeting_room_section').hide();
            $('#date_section').hide();
            $('#time_section').hide();
            $('#service_section').show();
            $('#quantity_section').show();
            $('.user_names').show();
        }
    });
    
    $('#provider_id').on('change', function(e) { //any select change on the dropdown with id country trigger this code
        e.preventDefault();
        var provider_id = $('#provider_id').val();
        var type = $('#type').val();
        if(type == 1){
            $.get("<?= route('admin.orders.get-provider-places') ?>", {
                provider_id: provider_id,
            }, function(data) {
                console.log(data);
                var html = '<option>{{__('admin.place')}}</option>';
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    html += '<option value="' + data[i].id + '" >' +data[i].name.{{ lang() }}+'</option>';
                }
                $('#place_id').html("");
                $('#place_id').append(html);
            });
        }else{
            $.get("<?= route('admin.orders.get-provider-services') ?>", {
                provider_id: provider_id,
            }, function(data) {
                console.log(data);
                var html = '<option>{{__('admin.service')}}</option>';
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    html += '<option value="' + data[i].id + '" >' +data[i].name.{{ lang() }}+'</option>';
                }
                $('#service_id').html("");
                $('#service_id').append(html);
            });
    
        }
    });

    $('#place_id').on('change', function(e) { //any select change on the dropdown with id country trigger this code
        e.preventDefault();
        var place_id = $('#place_id').val();
        $.get("<?= route('admin.orders.get-place-meeting-rooms') ?>", {
            place_id: place_id,
        }, function(data) {
            console.log(data);
            var html = '<option>{{__('admin.meetingroom')}}</option>';
            var len = data.length;
            for (var i = 0; i < len; i++) {
                html += '<option value="' + data[i].id + '" >' +data[i].name.{{ lang() }}+'</option>';
            }
            $('#meeting_room_id').html("");
            $('#meeting_room_id').append(html);
        });
    });

    $('#date , #meeting_room_id').on('change', function(e) { //any select change on the dropdown with id country trigger this code
        e.preventDefault();
        var date = $('#date').val();
        var meeting_room_id = $('#meeting_room_id').val();
        if(date != '' && meeting_room_id != ''){
            $.get("<?= route('admin.orders.get-room-available-times') ?>", {
                day: date,
                meeting_room_id: meeting_room_id,
            }, function(data) {
                console.log(data);
                var html = '';
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    html += '<option value="' + data[i].time + '" >' +data[i].time_formated+'</option>';
                }
                $('#time').html("");
                $('#time').append(html);
            });
        }
    });
</script>
@endsection