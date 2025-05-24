<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('provider/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('provider/css/style.css')}}">
    @if(lang() == 'en')
        <link rel="stylesheet" href="{{asset('provider/css/styleEn.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <!-- <link rel="stylesheet" href="css/styleEn.css"> -->
    <script src="{{asset('provider/js/jquery-3.2.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('css')
    <title>{{__('provider.provider_panel')}}</title>
</head>
<body>
{{-- <div class="loader">
    <img src="{{ $settings['logo'] }}">
    <img src="{{asset('provider/images/analog-signal.png')}}">
</div> --}}

<!-- Modal -->
<div class="modal incoming-call fade" id="exampleModalLong" data-conversation="" data-sender="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('user.incoming_call')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
           <div class="img d-inline-block align-middle">
               <img id="calling_user_avatar" src="images/user.png" alt="">
           </div>
           <span>
               {{trans('user.incoming_call_from')}} <strong id="calling_user_name"></strong>
           </span>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="refuseCall();">{{trans('user.cancel')}} <i class="icofont-ui-close"></i></button>
        <button type="button" class="btn btn-primary" onclick="receiveCall();" >{{trans('user.reply')}} <i class="icofont-ui-call"></i></button>
        </div>
    </div>
    </div>
</div>
<!--=============================-->

    @include('provider.layout.sidebar')
        <section class="pagebody">
            <div class="top-nav">
                <div class="container pr-5 pl-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <a class="slidToggle">
                            <img style="width: 35px;" src="{{asset('provider/images/slidToggle.png')}}" alt="">
                        </a>
                        <a href="{{route('provider.notifications')}}">
                            <img style="width: 20px;" src="{{asset('provider/images/notification.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!--==page-content==-->
                @if (session('successmsg'))
                    <div class="alert alert-success" role="alert">
                    {{ session('successmsg') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    </div>
                @elseif(session('msg'))
                    <div class="alert alert-danger" role="alert">
                    {{ session('msg') }}
                    </div>
                @elseif(session('danger'))
                    <div class="alert alert-danger" role="alert">
                    {{ session('danger') }}
                    </div>
                @endif
               @yield('content')
            <!--end page content-->
        </section>

<script src="{{asset('provider/js/popper.min.js')}}"></script>
<script src="{{asset('provider/js/bootstrap.min.js')}}"></script>
<script src="{{asset('provider/js/wow.min.js')}}"></script>
<script src="{{asset('provider/js/main.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">  new WOW().init(); </script>

@yield('js')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $(".select2").select2();  
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
