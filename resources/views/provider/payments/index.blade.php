@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container">
            @foreach($payments as $payment)
                @if($loop->index % 2 == 0)
                    <div class="row">
                @endif

                <div class="col-md-6 col-12 mt-4 overflow-hidden">
                    <div style="padding: 17px 30px;" class="contact-card wow fadeInRight">
                        <div class="d-flex flex-column oprat-info">
                            <h6>
                                <span>{{__('hospital.customer name')}}</span>
                                <span style="color: #2C52A2;">{{($payment->user->name)??''}}</span>
                            </h6>
                            <h6>
                                <span>{{__('hospital.Reservation date')}}:</span>
                                <span style="color: #2C52A2;">{{($payment->reservation->date)??''}}</span>
                            </h6>
                            <h6>
                                <span>{{__('hospital.Payment value')}}</span>
                                <span style="color: #2C52A2;"><span class="mr-1 ml-1">{{($payment->reservation->price)??''}}</span> {{$currency}}</span>
                            </h6>
                        </div>
                    </div>
                </div>

                @if($loop->index % 2 != 0)
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection
