<div class="tab-pane fade active show" id="data">
    <div class="row">
    <div class="col-12">
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
                            <img src="{{$row->image}}">
                            <button class="close"><i class="la la-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.name')}}</label>
            <div class="controls">
                <input type="text" name="name" value="{{$row->name}}" class="form-control" placeholder="{{__('admin.write_the_name')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.phone_number')}}</label>
            <div class="row">
                <div class="col-md-4 col-12">
                    <select name="country_code" class="form-control select2" disabled>
                        @foreach($countries as $country)
                            <option value="{{ $country->key }}"
                                @if ($row->country_code == $country->key)
                                    selected
                                @endif >
                            {{ '+'.$country->key }}{{ $country->flag}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 col-12">
                    <div class="controls">
                        <input type="number" name="phone" value="{{$row->phone}}"  class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.email')}}</label>
            <div class="controls">
                <input type="email" name="email" value="{{$row->email}}" class="form-control" placeholder="{{__('admin.enter_the_email')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}" disabled>
            </div>
        </div>
    </div>


 
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.birth_date')}}</label>
            <div class="controls">
                <input type="date" name="birth_date" value="{{$row->birth_date}}" class="form-control"  disabled >
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.gender')}}</label>
            <div class="controls">
                <select name="gender" class="select2 form-control" disabled >
                    <option value>{{__('admin.gender')}}</option>
                    <option value="male" {{$row->gender == 'male' ? 'selected':''}}>{{__('admin.male')}}</option>
                    <option value="female" {{$row->gender == 'female' ? 'selected':''}}>{{__('admin.female')}}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.phone_activation_status')}}</label>
            <div class="controls">
                <select name="active" class="select2 form-control" disabled >
                    <option value>{{__('admin.phone_activation_status')}}</option>
                    <option value="1" {{$row->active == 1 ? 'selected':''}}>{{__('admin.activate')}}</option>
                    <option value="0" {{$row->active == 0 ? 'selected':''}}>{{__('admin.dis_activate')}}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.Validity')}}</label>
            <div class="controls">
                <select name="is_blocked" class="select2 form-control" disabled>
                    <option value>{{__('admin.Select_the_blocking_status')}}</option>
                    <option {{$row->is_blocked == 1 ? 'selected' : ''}} value="1">{{__('admin.Prohibited')}}</option>
                    <option {{$row->is_blocked == 0 ? 'selected' : ''}} value="0">{{__('admin.Unspoken')}}</option>
                </select>
            </div>
        </div>
    </div>

   
    <div class="col-12 d-flex justify-content-center mt-3">
        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
    </div>
</div>
</div>
