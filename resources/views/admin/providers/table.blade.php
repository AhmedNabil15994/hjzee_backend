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
                <th>{{__('admin.image')}}</th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.type')}}</th>
                <th>{{ __('admin.email') }}</th>
                <th>{{ __('admin.phone') }}</th>
                @if($id == null)
                <th>{{__('admin.employees')}}</th>
                @endif
                <th>{{__('admin.job')}}</th>
                <th>{{__('admin.rate')}}</th>
                {{-- <th>{{__('admin.expire_at')}}</th> --}}
                <th>{{__('admin.status')}}</th>
                <th>{{__('admin.num_courses')}}</th>
                <th>{{__('admin.num_lessons')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($providers as $provider)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $provider->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$provider->image}}" width="30px" height="30px" alt=""></td>
                    <td>{{ $provider->name }}</td>
                    <td>{{ ($provider->type)? __('admin.'.$provider->type) : __('admin.service_place') }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ $provider->phone }}</td>
                    @if($id == null)
                    <td><a href="{{ route('admin.providers.index',[$provider->id]) }}">{{__('admin.view')}}</a></td>
                    @endif
                    <td>{{ $provider->job }}</td>
                    <td>{{ $provider->rate }}</td>
                    {{-- <td>{{ $provider->expire_at }}</td> --}}
                    <td>
                        {!! toggleBooleanView($provider , route('admin.model.active' , ['model' =>'Provider' , 'id' => $provider->id , 'action' => 'is_active'])) !!}
                    </td>
                    <td>{{ $provider->num_courses }}</td>
                    <td>{{ $provider->num_lessons }}</td>
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.providers.show', ['id' => $provider->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.providers.edit', ['id' => $provider->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/providers/' . $provider->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($providers->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($providers->count() > 0 && $providers instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$providers->links()}}
    </div>
@endif
{{-- pagination  links div --}}

