<div class="position-relative">
    {{-- table loader  --}}
    {{-- <div class="table_loader" >
        {{__('admin.loading')}}
    </div> --}}
    {{-- table loader  --}}
    
    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
            <tr>
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
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
                {{-- <th>{{ __('admin.status') }}</th> --}}
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $order->id }}">
                        <span class="checkmark"></span>
                        </label>
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
                        <span class="text-primary"><a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/orders/' . $order->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($orders->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($orders->count() > 0 && $orders instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$orders->links()}}
    </div>
@endif
{{-- pagination  links div --}}

