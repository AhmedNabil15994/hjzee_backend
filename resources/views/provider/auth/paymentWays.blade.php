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
    <title>{{__('auth.Completing data')}}</title>
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

        <form class="log-form">

            <a class="pay-link" href="payment.html"><label class="lang-label">
                <div>
                    <img src="{{asset('hospital/images/credit-card%20(1).png')}}" alt="">
                    <span>{{__('auth.credit card')}}</span>
                </div>
                <img class="moving-arrow" src="{{asset('hospital/images/arrow-left.png')}}" alt="">
            </label></a>


            <a class="pay-link" href="payment.html"><label class="lang-label">
                <div>
                    <img style="width: 30px;" src="{{asset('hospital/images/bank.png')}}" alt="">
                    <span>{{__('auth.Bank transfer')}}</span>
                </div>
                <img class="moving-arrow" src="{{asset('hospital/images/arrow-left.png')}}" alt="">
            </label></a>
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
