@extends('provider.layout.master')
@section('content')
<div class="page-contant mt-4 mb-5">
    <div class="container">
        <div class="login-title">
            <h6>{{__('provider.Edit profile')}}</h6>
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
        @if(session('error'))
            <div class="alert alert-danger">
                <ul>
                        <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif
        <form class="log-form row" action="{{route('provider.updateProfile')}}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('PUT')
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
                                    <img src="{{auth('provider')->user()->image}}">
                                    <button class="close"><i class="la la-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form_label col-12">
                <input type="text" name="name" value="{{auth('provider')->user()->name}}" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('provider.name')}}</label>
            </div>
            <div class="form_label col-12">
                <input type="number" name="phone" value="{{auth('provider')->user()->phone}}" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('auth.phone')}}</label>
            </div>
            <div class="form_label col-12">
                <input type="email" name="email" value="{{auth('provider')->user()->email}}" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('auth.email')}}</label>
            </div>
            <div class="form_label col-12">
                <select name="gender" style="appearance: none;padding: 18px 14px 0 9px;" class="input_focus addofferinput" >
                    <option disabled value="">{{__('admin.choose')}}</option>
                    <option value="male" {{ auth('provider')->user()->gender == 'male' ? 'selected' : ''}}>{{ __('admin.male') }}</option>
                    <option value="female" {{ auth('provider')->user()->gender == 'female' ? 'selected' : ''}}>{{ __('admin.female') }}</option>
                </select>
                <div class="arrow arrsel topedet"><img src="{{asset('provider/images/arrrow-down.png')}}"></div>
                <label class="float_label">{{__('admin.gender')}}</label>
            </div>
            <div class="form_label col-12">
                <input type="text" name="job" value="{{auth('provider')->user()->job}}" class="input_focus addofferinput"/>
                <label class="float_label">{{__('admin.job')}}</label>
            </div>
            <div class="form_label col-12">
                <textarea name="info" class="input_focus addofferinput" >{{auth('provider')->user()->info}}</textarea>
                <label class="float_label">{{__('admin.info')}}</label>
            </div>
            <div class="form_label col-12">
                <textarea name="education_info" class="input_focus addofferinput" >{{auth('provider')->user()->education_info}}</textarea>
                <label class="float_label">{{__('admin.education_info')}}</label>
            </div>

            <button class="add-btn">{{__('provider.save')}}</button>
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
