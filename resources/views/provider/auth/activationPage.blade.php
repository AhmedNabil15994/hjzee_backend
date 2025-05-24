<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('hospital/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('hospital/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('hospital/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('hospital/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/styleEn.css"> -->
    <title>{{__('auth.activate the account')}}</title>
</head>
<body>
<div class="loader">
    <img src="{{ (isset($setting['logo'])) ? asset('assets/uploads/settings/' . $setting['logo']) : asset('Admin/app-assets/images/ico/logo.svg') }}">
    <img src="{{asset('hospital/images/analog-signal.png')}}">
</div>
<div class="top-logo">
    <img src="{{ (isset($setting['logo'])) ? asset('assets/uploads/settings/' . $setting['logo']) : asset('Admin/app-assets/images/ico/logo.svg') }}" alt="">
</div>
<section class="logo-content pt-5 mb-5 fadedown2">
    <div class="container">
        <div class="login-title">
            <h6>{{__('auth.activate the account')}}</h6>
            <p>{{__('auth.Enter the code sent to your mobile phone')}}</p>
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
        <form class="log-form row" action="{{route('hospital.activateAccount')}}" method="POST">
            @csrf
            <div class="form_label col-12">
                <input type="number" name="code" value="{{old('code')}}" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('auth.activation code')}}</label>
            </div>
            <!-- <div class="links-div justify-content-center">
                <a class="login-links" href="">لم يصلك الكود؟</a>
            </div> -->
            <button class="add-btn">{{__('auth.without confirmation?')}}</button>
        </form>
    </div>
</section>

<script src="{{asset('hospital/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('hospital/js/popper.min.js')}}"></script>
<script src="{{asset('hospital/js/bootstrap.min.js')}}"></script>
<script src="{{asset('hospital/js/wow.min.js')}}"></script>
<script src="{{asset('hospital/js/main.js')}}"></script>
<script type="text/javascript">  new WOW().init(); </script>
</body>
</html>
