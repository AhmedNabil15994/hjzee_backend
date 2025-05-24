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
    addbutton="{{ route('admin.providers.create') }}" 
    deletebutton="{{ route('admin.providers.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'phone' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.phone') , 
        ] ,
        'email' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.email') , 
        ] ,
        'job' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.job') , 
        ] ,
        {{-- 'expire_at' => [
            'input_type' => 'date' , 
            'input_name' => __('admin.expire_at') , 
        ] , --}}
        'type' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.service') , 
                'id' => 'service' , 
              ],
              '2' => [
                'name' => __('admin.place') , 
                'id' => 'place' , 
              ],
              '3' => [
                'name' => __('admin.service_place') , 
                'id' => '' , 
              ],
            ] , 
            'input_name' => __('admin.type')  , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
        <a class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light"  href="{{url(route('admin.master-export', 'Provider'))}}"><i  class="fa fa-file-excel-o"></i>
            {{ __('admin.export') }}</a>
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
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/show-providers/'.$id)])
@endsection
