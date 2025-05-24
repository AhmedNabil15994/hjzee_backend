@extends('provider.layout.master')
@section('content')
    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container">
            <div class="d-flex justify-content-end">
                <a href="{{route('provider.addService')}}" class="bluebtn btn mb-3 toggl-RC">{{__('provider.add_service')}}</a>
            </div>


            @foreach(auth('provider')->user()->services as $service)
                <div class="col-md-12 col-12 overflow-hidden"> 
                    <div class="d-flex align-items-center impoli-card" style="visibility: visible; animation-name: fadeInRight;"> 
                    <a href="{{route('provider.serviceDetails',[$service])}}" ><img class="img-trans" src="{{$service->images[0]->image??''}}"></a>
                    <div class="d-flex flex-column"> 
                        <h6 style="font-weight: 600 ;color: #5d5d5d" class="mb-0 mt-2"> {{$service->name}}</h6>
                        <p class="mb-0 mt-2" style="color: #698491 ;font-weight: 600">{{$service->address}}</p>
                        <p class="impoli-txt mb-0">{{$service->description}}</p>
                    </div> 
                    {{-- <a class="edit-profil" href="{{ route('provider.editService',[$service->id]) }}"> 
                        <img src="{{asset('provider/images/pencil.png')}}">
                    </a> --}}
                    </div> 
                </div>
            @endforeach

        </div>
    </div>
@endsection
