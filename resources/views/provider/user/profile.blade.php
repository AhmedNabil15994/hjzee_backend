@extends('provider.layout.master')
@section('content')

        <div class="page-contant mt-4 mb-5">
            <div class="container">
                <div class="row overflow-hidden">
                    <div class="col-12 wow fadeInRight">
                        <div class="profile-card">
                            <div class="flot-card">
                                <div class="d-flex align-items-center flex-column">
                                    <img class="profil-img" src="{{auth('provider')->user()->image}}">
                                    <h6 class="mt-4 mb-4">{{auth('provider')->user()->name}}</h6>

                                    <a class="edit-profil" href="{{route('provider.editProfile')}}">
                                        <img src="{{asset('provider/images/pencil.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-12 overflow-hidden">
                        <div class="contact-card wow fadeInRight">
                            <div class="d-flex flex-column">
                                <h6>
                                    <img src="{{asset('provider/images/telephone.png')}}">
                                    <span>{{$provider->phone}}</span>
                                </h6>
                                <h6>
                                    <img src="{{asset('provider/images/invelope.png')}}">
                                    <span>{{$provider->email}}</span>
                                </h6>
                            </div>
                            <a class="edit-profil" href="{{route('provider.editProfile')}}">
                                <img src="{{asset('provider/images/pencil.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 overflow-hidden">
                        <div style="padding: 17px 30px;" class="contact-card wow fadeInRight">
                            <div class="d-flex flex-column">
                                <h5 style="color: #2C52A2;">
                                    <img src="{{asset('provider/images/info.png')}}">
                                     {{__('provider.provider_info')}}:
                                </h5>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('provider.name')}}:</span>
                                    <span>{{ $provider->name }}</span>
                                </h6>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.type')}}:</span>
                                    <span>{{ __('admin.'.$provider->type) }}</span>
                                </h6>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.gender')}}:</span>
                                    <span>{{ __('admin.'.$provider->gender) }}</span>
                                </h6>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.job')}}:</span>
                                    <span>{{ $provider->job }}</span>
                                </h6>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.rate')}}:</span>
                                    <span>{{ $provider->rate.'('.$provider->num_rating.')' }}</span>
                                </h6>

                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.info')}}:</span>
                                    <span>{{ $provider->info }}</span>
                                </h6>
                                <h6>
                                    <span style="color: #2C52A2;">{{__('admin.education_info')}}:</span>
                                    <span>{{ $provider->education_info }}</span>
                                </h6>
                                <a class="edit-profil" href="{{route('provider.editProfile')}}">
                                    <img src="{{asset('provider/images/pencil.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">

                <div class="col-md-12 col-12 overflow-hidden">
                    <div class="contact-card wow fadeInRight">
                        <h6 style="color: #2C52A2;">{{__('auth.password')}}</h6>
                        <a href="{{route('provider.editPassword')}}">
                            <img style="width: 25px;" src="{{asset('provider/images/pencil.png')}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>


@endsection
