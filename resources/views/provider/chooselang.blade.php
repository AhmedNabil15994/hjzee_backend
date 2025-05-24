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
    <title>{{__('hospital.Choose the language')}}</title>
</head>
<body>
<div class="loader">
    <img src="{{ (isset($setting['logo'])) ? asset('assets/uploads/settings/' . $setting['logo']) : asset('Admin/app-assets/images/ico/logo.svg') }}">
    <img src="{{asset('hospital/images/analog-signal.png')}}">
</div>
<div class="top-logo">
    <img src="{{ (isset($setting['logo'])) ? asset('assets/uploads/settings/' . $setting['logo']) : asset('Admin/app-assets/images/ico/logo.svg') }}" alt="">
</div>
<section class="logo-content pt-5 fadedown2">
    <div class="container">
        <div class="login-title">
            <h6>{{__('hospital.Choose your preferred language')}}</h6>
            <p>Choose your preferred language</p>
        </div>
        <form class="log-form" action="{{route('hospital.updateLang')}}" method="POST">
            @csrf
            <label class="lang-label">
                <div>
                    <img src="{{asset('hospital/images/arabic-flag.png')}}" alt="">
                    <span>{{__('hospital.Arabic')}}</span>
                </div>
                <input name="lang" type="radio" value="ar" checked>
            </label>
            <label class="lang-label">
                <div>
                    <img src="{{asset('hospital/images/english-flag.png')}}" alt="">
                    <span>{{__('hospital.English')}}</span>
                </div>
                <input name="lang" type="radio" value="en">
            </label>
            <button class="add-btn">{{__('hospital.Confirm')}}</button>
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
