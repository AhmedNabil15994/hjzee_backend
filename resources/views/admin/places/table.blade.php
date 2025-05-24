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
                <th>{{__('admin.place_provider')}}</th>
                <th>{{__('admin.section')}}</th>
                <th>{{__('admin.address')}}</th>
                <th>{{__('admin.city')}}</th>
                <th>{{__('admin.sort')}}</th>
                <th>{{__('admin.pin')}}</th>
                <th>{{__('admin.status')}}</th>
                <th>{{__('admin.num_meeting_rooms')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($places as $place)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $place->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{ $place->name }}</td>
                    <td>@if($place->provider)
                        <a href="{{ route('admin.providers.show',[$place->provider_id]) }}">{{ $place->provider->name }}</a>
                        @endif
                    </td>
                    <td>@if($place->category)
                        <a href="{{ route('admin.services-categories.show',[$place->category_id]) }}">{{ $place->category->name }}</a>
                        @endif
                    </td>
                    <td>{{ $place->address }}</td>
                    <td>{{ $place->city->name??'' }}</td>
                    <td>{{ $place->sort }}</td>
                    <td>
                        {!! toggleBooleanView($place , route('admin.model.active' , ['model' =>'Place' , 'id' => $place->id , 'action' => 'pin'])) !!}
                    </td>
                    <td>
                        {!! toggleBooleanView($place , route('admin.model.active' , ['model' =>'Place' , 'id' => $place->id , 'action' => 'is_active'])) !!}
                    </td>
                    <td>{{ $place->num_meeting_rooms }}</td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.places.show', ['id' => $place->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.places.edit', ['id' => $place->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/places/' . $place->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($places->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($places->count() > 0 && $places instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$places->links()}}
    </div>
@endif
{{-- pagination  links div --}}

