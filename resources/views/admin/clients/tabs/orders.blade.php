<div class="tab-pane fade" id="orders">

    @if($row->orders->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{  __('admin.orders') }}</h5>
                    </div>
                    <div class="d-flex justify-content-center btns">

                    </div>
                    <div class="card-body">
                        <div class="contain-table">
                            <table class="table datatable-button-init-basic ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{__('admin.order_num')}}</th>
                                    <th>{{__('admin.type')}}</th>
                                    <th>{{__('admin.client')}}</th>
                                    <th>{{__('admin.provider')}}</th>
                                    <th>{{__('admin.service')}}</th>
                                    <th>{{__('admin.place')}}</th>
                                    <th>{{__('admin.meetingroom')}}</th>
                                    <th>{{ __('admin.price') }}</th>
                                    <th>{{ __('admin.final_total') }}</th>
                                    <th>{{ __('admin.is_confirmed') }}</th>
                                    <th>{{__('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($row->orders as $key => $order)
                                    <tr class="delete_row">
                                        <td class="text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td>{{ $order->order_num }}</td>
                                        <td>{{ $order->type_text }}</td>
                                        <td>
                                            @if($order->user)
                                            <a href="{{ route('admin.clients.show',[$order->user_id]) }}">{{ $order->user->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->provider)
                                            <a href="{{ route('admin.providers.show',[$order->provider_id]) }}">{{ $order->provider->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->service)
                                            <a href="{{ route('admin.services.show',[$order->service_id]) }}">{{ $order->service->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->place)
                                            <a href="{{ route('admin.places.show',[$order->place_id]) }}">{{ $order->place->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->meetingRoom)
                                            <a href="{{ route('admin.meetingrooms.show',[$order->meeting_room_id]) }}">{{ $order->meetingRoom->name }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $order->price }} {{ $settings['default_currency'] }}</td>
                                        <td>{{ $order->final_total }} {{ $settings['default_currency'] }}</td>
                                        <td>{{ ( $order->is_confirmed )? __('admin.confirmed') : __('admin.not_confirmed')  }}</td>
                                        {{-- <td>{{ $order->status_text }}</td> --}}
                                        <td class="product-action">
                                            <span class="text-primary"><a href="{{ route('admin.orders.show',[$order->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>

                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif

</div>
