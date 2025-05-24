@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-4">
        <div class="container">
            <div class="overflow-hidden">
                <div class="contactInfo pr-5 pl-5 pt-2 wow fadeInRight">
                    <div class="email-contact">
                        <h6 class="contac-icon">
                            <img src="{{asset('provider/images/mail.png')}}">
                        </h6>
                        <div class="m-2">
                            <p style="font-weight: 600;" class="mb-1">{{__('provider.Contact via email')}}</p>
                            <p class="contact-ex">{{($settings['email'])??''}} </p>
                        </div>
                    </div>
                    <div class="email-contact">
                        <h6 class="contac-icon">
                            <img src="{{asset('provider/images/callus.png')}}">
                        </h6>
                        <div class="m-2">
                            <p style="font-weight: 600;" class="mb-1">{{__('provider.Telephone contact')}}</p>
                            <p class="contact-ex">{{($settings['phone'])??''}}</p>
                        </div>
                    </div>
                    <div class="email-contact">
                        <h6 class="contac-icon">
                            <img src="{{asset('provider/images/whats.png')}}">
                        </h6>
                        <div class="m-2">
                            <p style="font-weight: 600;" class="mb-1">{{__('provider.Contact via WhatsApp')}}</p>
                            <p class="contact-ex">{{($settings['whatsapp'])??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="social-img">
                    @foreach($socials as $social)
                        <a href="{{$social->link}}" target="blank"><img src="{{$social->icon}}"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
