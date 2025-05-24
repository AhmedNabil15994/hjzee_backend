@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.orders.create') }}" 
    deletebutton="{{ route('admin.orders.deleteAll') }}" 
    :searchArray="[
        'order_num' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.order_num') , 
        ] , 
        'type' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.service') , 
                'id' => '0' , 
              ],
              '2' => [
                'name' => __('admin.place') , 
                'id' => '1' , 
              ],
            ] , 
            'input_name' => __('admin.type')  , 
        ] ,
        'user_id' => [
          'input_type' => 'select' , 
          'rows'       => $users, 
          'input_name' => __('admin.client') , 
        ] ,
        'provider_id' => [
            'input_type' => 'select' , 
            'rows'       => $providers, 
            'input_name' => __('admin.provider') , 
        ] ,
        'service_id' => [
            'input_type' => 'select' , 
            'rows'       => $services, 
            'input_name' => __('admin.service') , 
        ] ,
        'place_id' => [
            'input_type' => 'select' , 
            'rows'       => $places, 
            'input_name' => __('admin.place') , 
        ] ,
        'meeting_room_id' => [
          'input_type' => 'select' , 
          'rows'       => $rooms, 
          'input_name' => __('admin.meetingrooms') , 
        ] , 
        'is_confirmed' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.not_confirmed') , 
                'id' => '0' , 
              ],
              '2' => [
                'name' => __('admin.confirmed') , 
                'id' => '1' , 
              ],
            ] , 
            'input_name' => __('admin.is_confirmed')  , 
        ] ,
    
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ awtTrans('ارسال اشعار') }}</a> --}}
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>
</x-admin.table>


    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/orders')])
@endsection
