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
                <th>{{__('admin.place')}}</th>
                <th>{{__('admin.section')}}</th>
                <th>{{__('admin.num_reservations')}}</th>
                <th>{{__('admin.sort')}}</th>
                <th>{{__('admin.pin')}}</th>
                <th>{{__('admin.status')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetingrooms as $meetingroom)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $meetingroom->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{ $meetingroom->name }}</td>
                    <td>@if($meetingroom->place)
                        <a href="{{ route('admin.places.show',[$meetingroom->place_id]) }}">{{ $meetingroom->place->name }}</a>
                        @endif
                    </td>
                    <td>@if($meetingroom->category)
                        <a href="{{ route('admin.services-categories.show',[$meetingroom->category_id]) }}">{{ $meetingroom->category->name }}</a>
                        @endif
                    </td>
                    <td>
                        <span class="btn btn-sm round btn-outline-success">
                            {{$meetingroom->num_reservations }} <i class="la la-check font-medium-2"></i>
                        </span>
                    </td>
                    <td>{{ $meetingroom->sort }}</td>
                    <td>
                        {!! toggleBooleanView($meetingroom , route('admin.model.active' , ['model' =>'MeetingRoom' , 'id' => $meetingroom->id , 'action' => 'pin'])) !!}
                    </td>
                    <td>
                        {!! toggleBooleanView($meetingroom , route('admin.model.active' , ['model' =>'MeetingRoom' , 'id' => $meetingroom->id , 'action' => 'is_active'])) !!}
                    </td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.meetingrooms.show', ['id' => $meetingroom->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.meetingrooms.edit', ['id' => $meetingroom->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/meetingrooms/' . $meetingroom->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($meetingrooms->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($meetingrooms->count() > 0 && $meetingrooms instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$meetingrooms->links()}}
    </div>
@endif
{{-- pagination  links div --}}

