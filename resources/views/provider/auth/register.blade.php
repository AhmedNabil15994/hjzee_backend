<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('provider/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <!-- <link rel="stylesheet" href="css/styleEn.css"> -->
    <script src="{{asset('provider/js/jquery-3.2.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{__('auth.register')}}</title>
</head>
<body>
<div class="loader">
    <img
        src="{{$settings['logo']}}">
    <img src="{{asset('provider/images/analog-signal.png')}}">
</div>
<div class="top-logo">
    <img src="{{$settings['logo']}}"  alt="">
</div>

<section class="logo-content pt-5 mb-5 fadedown2">
    <div class="container">
        <div class="login-title">
            <h6>{{__('auth.new_registration')}}</h6>
            {{-- <p>{{__('auth.Register with us')}}</p> --}}
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
        <form class="log-form row" action="{{route('provider.providerRegister')}}" method="POST" id="form">
            @csrf
            <div class="form_label col-12">
                <input type="text" name="name" value="{{old('name')}}" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('site.name')}}</label>
            </div>
            <div class="form_label col-12">
                <input min="0" type="text" name="phone" value="{{old('phone')}}" class="input_focus addofferinput"
                       required/>
                <label class="float_label">{{__('auth.phone')}}</label>
            </div>
            <div class="form_label col-12">
                <input min="0" max="11" type="email" name="email" value="{{old('email')}}"
                       class="input_focus addofferinput" required/>
                <label class="float_label">{{__('auth.email')}}</label>
            </div>

            <div class="form_label col-12">
                <input type="password" name="password" class="input_focus addofferinput" required/>
                <label class="float_label">{{__('auth.password')}}</label>
            </div>
            <div class="form_label col-12">
                <select name="gender" style="appearance: none;padding: 18px 14px 0 9px;" class="input_focus addofferinput" required>
                    <option disabled value="">{{__('admin.choose')}}</option>
                    <option value="male">{{ __('admin.male') }}</option>
                    <option value="female">{{ __('admin.female') }}</option>
                </select>
                <div class="arrow arrsel topedet"><img src="{{asset('provider/images/arrrow-down.png')}}"></div>
                <label class="float_label">{{__('admin.gender')}}</label>
            </div>
            <div class="form_label col-12">
                <select name="type" style="appearance: none;padding: 18px 14px 0 9px;" class="input_focus addofferinput" required>
                    <option disabled value="">{{__('admin.choose')}}</option>
                    <option value="service">{{ __('admin.service') }}</option>
                    <option value="place">{{ __('admin.place') }}</option>
                </select>
                <div class="arrow arrsel topedet"><img src="{{asset('provider/images/arrrow-down.png')}}"></div>
                <label class="float_label">{{__('admin.type')}}</label>
            </div>

            <button class="add-btn">{{__('auth.register')}}</button>
            <div class="links-div justify-content-center mt-4">
                <p>{{__('auth.have_new_account')}} <a class="login-links"  href="{{route('provider.loginForm')}}">{{__('auth.login')}}</a>
                </p>
            </div>
        </form>
    </div>
</section>

<div class="RC-layer"></div>
{{-- <div class="RC-modal">
    <div class="RC-contant">
        <h6 style="color: #0b3251; text-align: center;">{{__('auth.Terms and Conditions')}}</h6>
        <p>
            {{$terms}}
        </p>
        <button class="sned-RC">{{__('auth.OK')}}</button>
    </div>
</div> --}}

<script src="{{asset('provider/js/popper.min.js')}}"></script>
<script src="{{asset('provider/js/bootstrap.min.js')}}"></script>
<script src="{{asset('provider/js/wow.min.js')}}"></script>
<script src="{{asset('provider/js/main.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@if(session()->has('danger'))
<script>
    toastr.error("{!! session()->get('danger') !!}")
</script>
@elseif(session()->has('success'))
    <script>
        toastr.success("{!! session()->get('success') !!}")
    </script>
@endif
<script type="text/javascript">  new WOW().init(); </script>
<script>
    //  form submit script
    $(document).on('submit', '#form', function(e) {
        e.preventDefault()
        var url = $(this).attr('action')
        $.ajax({
            url: url,
            method: 'post',
            data: new FormData($("#form")[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.key == 'fail') {
                    toastr.error(response.msg)
                    if (response.data.url) {
                        setTimeout(function() {
                            window.location.replace(response.data.url)
                        }, 1000);
                    }
                } else {
                    toastr.success(response.msg)
                    document.getElementById("form").reset();
                    if (response.data.url) {
                        setTimeout(function() {
                            window.location.replace(response.data.url)
                        }, 1000);
                    }
                }
            },
            error: function(xhr) {
                if(xhr.responseJSON.msg){
                    toastr.error(xhr.responseJSON.msg)
                }
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.error(value)
                });
            },
        });
    })
</script>
</body>
</html>
