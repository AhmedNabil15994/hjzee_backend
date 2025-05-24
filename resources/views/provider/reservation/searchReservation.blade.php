@forelse($reservations as $reservation)
<div class="col-12 overflow-hidden">
    <div class="transaction-card mt-2 mb-2 wow fadeInDown">
        <div class="d-flex align-items-center">
            <a href="{{ route('provider.reservationServiceDetails',[$reservation]) }}"><img class="img-trans" src="{{ $reservation->user->image??asset('/storage/images/users/default.png')}}"></a>
            <div class="d-flex flex-column">
                <h6 class="name-trans">{{$reservation->user->name??''}}</h6>
                <h6 class="offer-trans"> {{__('provider.phone')}} :<span>{{$reservation->user->phone??''}}</span></h6>
                <h6 class="offer-trans">{{__('provider.order_num')}} :<span>{{  $reservation->order_num}}</span></h6>
                <h6 class="offer-trans">{{__('provider.final_price')}} :<span>{{  $reservation->final_total}}</span></h6>
            </div>
        </div>
        {{-- <div class="d-flex time-trans">
            <div class="d-flex align-items-center">
                <img src="{{asset('provider/images/Calendar2.png')}}">
                <span>{{date('Y-m-d',strtotime($reservation->date))}}</span>
            </div>
            <div class="d-flex align-items-center">
                <img src="{{asset('provider/images/Time Square.png')}}">
                <span>{{date('h:i a',strtotime($reservation->time))}}</span>
            </div>
        </div> --}}
        {{-- <a class="edit-profil" href="{{ route('provider.editServiceReservation',[$reservation]) }}"> 
            <img src="{{asset('provider/images/pencil.png')}}">
        </a> --}}
    </div>
</div>
@empty
<div class="col-12 overflow-hidden">
<div class="transaction-card mt-2 mb-2 wow fadeInDown">
{{__('provider.No reservations')}}
</div>
</div>
@endforelse
