@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.reservation_details')}}</h5>
            </div>

            <form class="row" action="{{route('provider.deleteReservation',[$order])}}" method="POST"  enctype="multipart/form-data" id="form">
                @csrf
                @method('Delete')
                <div class="form-body">
                    <div class="row">

                        {{-- <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.client')}}</label>
                                <div class="controls">
                                    <select name="user_id" id="first-user" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
                                        <option value>{{__('admin.client')}}</option>
                                        @foreach ($users as $usr)
                                            <option value="{{$usr->id}}" {{ $order->user_id == $usr->id ?'selected' :''  }}>{{$usr->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.name')}}</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{{ $order->user->name??'' }}" class="form-control" placeholder="{{ __('admin.name') }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                <div class="row">
                                    <div class="col-md-8 col-12">
                                        <div class="controls">
                                            <input type="number" name="phone" value="{{ $order->user->phone??'' }}"  class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <select name="country_code" class="form-control select2" disabled>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->key }}"
                                                    @if ($order->user->country_code == $country->key)
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
                                    <input type="email" name="email" value="{{ $order->user->email??'' }}" id="email" class="form-control" placeholder="{{ __('admin.email') }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.place')}}</label>
                                <div class="controls">
                                    <select name="place_id" class="select2 form-control" disabled >
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
                                    <select name="meeting_room_id" id="meeting_room_id"  class="select2 form-control" disabled>
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
                                    <input type="date" name="date" id="date" value="{{ $order->date }}" class="form-control" placeholder="{{ __('admin.date') }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.time')}}</label>
                                <div class="controls">
                                    <select name="time" id="time" class="select2 form-control" disabled>
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
                                    <input type="number" name="final_total" value="{{ $order->final_total }}" step="0.01" min="0" class="form-control" placeholder="{{__('admin.final_total')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.pay_type')}}</label>
                                <div class="controls">
                                    <select name="pay_type" class="select2 form-control" disabled>
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
                                    <select name="pay_status" class="select2 form-control" disabled>
                                        <option value>{{__('admin.pay_status')}}</option>
                                        <option value="0" {{ $order->pay_status == '0' ?'selected' :''  }}>{{__('admin.pay_status_pending')}}</option>
                                        <option value="2" {{ $order->pay_status == '2' ?'selected' :''  }} >{{__('admin.pay_status_done')}}</option>
                                        <option value="3" {{ $order->pay_status == '3' ?'selected' :''  }} >{{__('admin.pay_status_returned')}}</option>
                                    </select>
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

                </div>
                    
                            <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" onclick="return confirm('Are you Sure?');return false;" class="btn btn-danger mr-1 mb-1 submit_button">{{ __('provider.delete') }}</button>
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@section('js')

@endsection
@endsection
