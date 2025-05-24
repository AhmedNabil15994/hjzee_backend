@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.edit_reservation')}}</h5>
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
            <form class="row" action="{{route('provider.updateReservation',[$order])}}" method="POST"  enctype="multipart/form-data" id="form">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.client')}}</label>
                                <div class="controls">
                                    <select name="user_id" id="first-user" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                        <option value>{{__('admin.client')}}</option>
                                        @foreach ($users as $usr)
                                            <option value="{{$usr->id}}" {{ $order->user_id == $usr->id ?'selected' :''  }}>{{$usr->name}}</option>
                                        @endforeach
                                    </select>
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
                                            <option value="{{$place->id}}" {{ $order->place_id == $place->id ?'selected' :''  }}>{{$place->name}}</option>
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
                                            <option value="{{$room->id}}" {{ $order->meeting_room_id == $room->id ?'selected' :''  }}>{{$room->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.date')}}</label>
                                <div class="controls">
                                    <input type="date" name="date" id="date" value="{{ $order->date }}" class="form-control" placeholder="{{ __('admin.date') }}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.time')}}</label>
                                <div class="controls">
                                    <select name="time" id="time" class="select2 form-control" >
                                        @if($order->time)
                                        <option value="{{ $order->time }}" selected>{{ date('h:i a',strtotime($order->time)) }}</option>
                                        @endif
                                        @foreach($times as $time)
                                         <option value="{{ $time->time }}">{{ date('h:i a',strtotime($time->time)) }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.final_total')}}</label>
                                <div class="controls">
                                    <input type="number" name="final_total" value="{{ $order->final_total }}" step="0.01" min="0" class="form-control" placeholder="{{__('admin.final_total')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.pay_type')}}</label>
                                <div class="controls">
                                    <select name="pay_type" class="select2 form-control">
                                        <option value>{{__('admin.pay_type')}}</option>
                                        <option value="0" {{ $order->pay_type == '0' ?'selected' :''  }}>{{__('admin.pay_type_undefined')}}</option>
                                        <option value="1" {{ $order->pay_type == '1' ?'selected' :''  }}>{{__('admin.pay_type_cash')}}</option>
                                        <option value="3" {{ $order->pay_type == '3' ?'selected' :''  }}>{{__('admin.pay_type_bank')}}</option>
                                        <option value="4" {{ $order->pay_type == '4' ?'selected' :''  }}>{{__('admin.pay_type_online')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.pay_status')}}</label>
                                <div class="controls">
                                    <select name="pay_status" class="select2 form-control">
                                        <option value>{{__('admin.pay_status')}}</option>
                                        <option value="0" {{ $order->pay_status == '0' ?'selected' :''  }}>{{__('admin.pay_status_pending')}}</option>
                                        <option value="2" {{ $order->pay_status == '2' ?'selected' :''  }} >{{__('admin.pay_status_done')}}</option>
                                        <option value="3" {{ $order->pay_status == '3' ?'selected' :''  }} >{{__('admin.pay_status_returned')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="controls">
                                <label for="notes">{{ __('admin.notes') }}</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"
                                    placeholder="{{__('admin.write') . __('admin.notes')}}" >{{ $order->notes }}</textarea>
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
