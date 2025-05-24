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
                <th>{{__('admin.client')}}</th>
                <th>{{__('admin.provider')}}</th>
                <th>{{__('admin.rate')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ratings as $rating)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $rating->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="{{ route('admin.clients.show',[$rating->user_id]) }}">{{ $rating->user->name }}</a></td>
                    <td>@if($rating->provider)
                        <a href="{{ route('admin.providers.show',[$rating->provider_id]) }}">{{ $rating->provider->name }}</a>
                        @endif
                    </td>
                    <td>{{ $rating->rate }}</td>
                    
                    <td class="product-action"> 
                        {{-- <span class="text-primary"><a href="{{ route('admin.provider-ratings.show', ['id' => $rating->id]) }}" class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span> --}}
                        {{-- <span class="action-edit text-primary"><a href="{{ route('admin.provider-ratings.edit', ['id' => $rating->id]) }}" class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span> --}}
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ url('admin/provider-ratings/' . $rating->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($ratings->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($ratings->count() > 0 && $ratings instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$ratings->links()}}
    </div>
@endif
{{-- pagination  links div --}}

