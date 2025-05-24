@extends('provider.layout.master')
@section('content')
<div class="page-contant mt-4 mb-5">
    <div class="container">
        <div class="login-title">
            <h6>{{__('provider.Edit password')}}</h6>
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
            <form class="log-form row" action="{{route('provider.updatePassword')}}" method="POST" id="form">
            @csrf
                <div class="form_label col-12">
                    <input type = "password" name="old_password" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.Old Password')}}</label>
                </div>
                <div class="form_label col-12">
                    <input type="password" name="password" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.New Password')}}</label>
                </div>
                <div class="form_label col-12">
                    <input type="password" name="password_confirmation" class="input_focus addofferinput" required/>
                    <label class="float_label">{{__('provider.Confirm the new password')}}</label>
                </div>
                <button class="add-btn">{{__('provider.edit')}}</button>
            </form>
    </div>
 </div>

@endsection
