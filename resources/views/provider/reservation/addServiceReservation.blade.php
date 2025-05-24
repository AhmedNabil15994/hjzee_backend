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
            <form class="row" action="{{route('provider.createServiceReservation')}}" method="POST"  enctype="multipart/form-data" id="form">
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
                                        <label for="first-name-column">{{__('admin.service')}}</label>
                                        <div class="controls">
                                            <select name="service_id" class="select2 form-control" >
                                                <option value>{{__('admin.service')}}</option>
                                                @foreach ($services as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{__('admin.quantity')}}</label>
                                        <div class="controls">
                                            <input type="number" name="quantity" step="1" min="0" class="form-control" placeholder="{{__('admin.quantity')}}" >
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
                                            <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i>X </span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary text-white waves-effect waves-light m-auto add_name user_names">{{__('admin.add_name')}}</button>

                    </div>
                </div>
                <div class="col-12">
                    <button class="add-btn"  style="margin-top: 15px;">{{__('provider.save')}}</button>
                </div>
            </form>
        </div>
    </div>
    
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
                <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i>X</span>
            </div>
        </div>
    </div>
@endsection
@section('js')
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

</script>
@endsection