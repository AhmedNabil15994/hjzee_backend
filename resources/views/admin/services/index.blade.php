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
    addbutton="{{ route('admin.services.create') }}" 
    deletebutton="{{ route('admin.services.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] 
        ,'provider_id' => [
            'input_type' => 'select' , 
            'rows'       => $providers , 
            'input_name' => __('admin.provider') , 
        ] ,
        {{-- 'place_id' => [
            'input_type' => 'select' , 
            'rows'       => $places , 
            'input_name' => __('admin.course_place') , 
        ] , --}}
        'category_id' => [
            'input_type' => 'select' , 
            'rows'       => $categories , 
            'input_name' => __('admin.section') , 
        ] ,
        'is_free' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.free') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.not_free') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.is_free') , 
        ] ,
        'expire_at' => [
            'input_type' => 'date' , 
            'input_name' => __('admin.expire_at') , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
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
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/services')])
@endsection
