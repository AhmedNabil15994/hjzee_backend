@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.add_reservation')}}</h5>
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
            <form class="row" action="{{route('provider.createReservation')}}" method="POST"  enctype="multipart/form-data" id="form">
                @csrf
                <div class="form-body">
                    <div class="row">


                                {{-- <div class="col-md-6 col-12">
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
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{__('admin.name')}}</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('admin.name') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="controls">
                                                    <input type="number" name="phone" class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  >
                                                </div>
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{__('admin.email')}}</label>
                                        <div class="controls">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('admin.email') }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
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

                                <div class="col-md-6 col-12">
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


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{__('admin.date')}}</label>
                                        <div class="controls">
                                            <input type="date" name="date" id="date" class="form-control" placeholder="{{ __('admin.date') }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
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
                                        <label for="first-name-column">{{__('admin.final_total')}}</label>
                                        <div class="controls">
                                            <input type="number" name="final_total" step="0.01" min="0" class="form-control" placeholder="{{__('admin.final_total')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                        </div>
                                    </div>
                                </div> --}}

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
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="notes">{{ __('admin.notes') }}</label>
                                            <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"
                                                placeholder="{{__('admin.write') . __('admin.notes')}}" ></textarea>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="add-btn">{{__('provider.save')}}</button>
                </div>
            </form>
        </div>
    </div>

@section('js')
<script>
    $('#place_id').on('change', function(e) { //any select change on the dropdown with id country trigger this code
        e.preventDefault();
        var place_id = $('#place_id').val();
        $.get("<?= route('provider.get-place-meeting-rooms') ?>", {
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
            $.get("<?= route('provider.get-provider-available-times') ?>", {
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
@endsection
