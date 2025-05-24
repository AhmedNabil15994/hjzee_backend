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
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.provider')}}</th>
                <th>{{__('admin.section')}}</th>
                {{-- <th>{{__('admin.course_place')}}</th> --}}
                <th>{{__('admin.is_free')}}</th>
                <th>{{__('admin.price')}}</th>
                <th>{{__('admin.offer_price')}}</th>
                <th>{{__('admin.start_date')}}</th>
                <th>{{__('admin.sort')}}</th>
                <th>{{__('admin.pin')}}</th>
                <th>{{__('admin.status')}}</th>
                <th>{{__('admin.expire_at')}}</th>
                <th>{{__('admin.rate')}}</th>
                <th>{{__('admin.num_seats')}}</th>
                <th>{{__('admin.num_reserved_seets')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $service->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{ $service->name }}</td>
                    <td>@if($service->provider)
                        <a href="{{ route('admin.providers.show',[$service->provider_id]) }}">{{ $service->provider->name }}</a>
                        @endif
                    </td>
                    <td>@if($service->category)
                        <a href="{{ route('admin.services-categories.show',[$service->category_id]) }}">{{ $service->category->name }}</a>
                        @endif
                    </td>
                    {{-- <td>@if($service->place)
                        <a href="{{ route('admin.places.show',[$service->place_id]) }}">{{ $service->place->name }}</a>
                        @endif
                    </td> --}}
                    <td>{{ $service->is_free == 1 ? __('admin.free') : __('admin.not_free') }}</td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->offer_price }}</td>
                    <td>{{ date('Y-m-d h:i a',strtotime($service->start_date)) }}</td>
                    <td>{{ $service->sort }}</td>
                    <td>
                        {!! toggleBooleanView($service , route('admin.model.active' , ['model' =>'Service' , 'id' => $service->id , 'action' => 'pin'])) !!}
                    </td>
                    <td>
                        {!! toggleBooleanView($service , route('admin.model.active' , ['model' =>'Service' , 'id' => $service->id , 'action' => 'is_active'])) !!}
                    </td>
                    <td>{{ $service->expire_at }}</td>
                    <td>{{ $service->rate }}</td>
                    <td>{{ $service->num_seats }}</td>
                    <td>{{ $service->num_reservations }}</td>

                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.services.show', ['id' => $service->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.services.edit', ['id' => $service->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/services/' . $service->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($services->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($services->count() > 0 && $services instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$services->links()}}
    </div>
@endif
{{-- pagination  links div --}}

