@extends('provider.layout.master')
@section('content')

        <div class="page-contant mt-4">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center overflow-hidden mb-4 mt-5">
                    <form class="search wow fadeInDown" id="srchForm">
                        <label class="w-100 m-0">
                            <input type="text" id="srch"  placeholder="{{__('provider.Enter the customer\'s mobile number')}}">
                                <img  src="{{asset('provider/images/serch.png')}}" alt="" onclick="$('#srchForm').submit();" style="cursor: pointer;">
                        </label>
                    </form>
                </div>
                <div class="row" id="reservations_list">

                    @forelse($reservations as $reservation)
                            <div class="col-12 overflow-hidden">
                                <div class="transaction-card mt-2 mb-2 wow fadeInDown">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('provider.reservationPlaceDetails',[$reservation]) }}"><img class="img-trans" src="{{ $reservation->user->image??asset('/storage/images/users/default.png')}}"></a>
                                        <div class="d-flex flex-column">
                                            <h6 class="name-trans">{{$reservation->user->name??''}}</h6>
                                            <h6 class="offer-trans"> {{__('provider.phone')}} :<span>{{$reservation->user->phone??''}}</span></h6>
                                            <h6 class="offer-trans">{{__('provider.order_num')}} :<span>{{  $reservation->order_num}}</span></h6>
                                            <h6 class="offer-trans">{{__('provider.final_price')}} :<span>{{  $reservation->final_total}}</span></h6>
                                        </div>
                                    </div>
                                    <div class="d-flex time-trans">
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('provider/images/Calendar2.png')}}">
                                            <span>{{date('Y-m-d',strtotime($reservation->date))}}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('provider/images/Time Square.png')}}">
                                            <span>{{date('h:i a',strtotime($reservation->time))}}</span>
                                        </div>
                                    </div>
                                    {{-- <a class="edit-profil" href="{{ route('provider.editPlaceReservation',[$reservation]) }}"> 
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
                {{ $reservations->links() }}
                </div>
            </div>
        </div>

 @section('js')
        <script type="text/javascript">
                var reservations_list = $("#reservations_list").html();
                $(document).on('keyup', '#srch', function(e){
                    e.preventDefault();
                    $("#reservations_list").html('');
                    // $('#reservations_list').addClass("rebtn");
                    var search = $.trim( $(this).val() );
                    if (search == "") {
                        $('#reservations_list').html(reservations_list);
                        // $('#reservations_list').removeClass("rebtn");
                    }else{
                        $.post("<?=route('provider.searchFinishedReservation');?>",{phone:search,"_token": "{{ csrf_token() }}"},function(data){
                            $('#reservations_list').html(data);
                            // $('#reservations_list').removeClass("rebtn");
                        });
                        return false;
                    }
                });
        </script>
@endsection
@endsection
