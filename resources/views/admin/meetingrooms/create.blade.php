@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
<style>
    .clickAdd {
        display: inline-block;
        width: 140px;
        height: 140px;
        line-height: 110px;
        text-align: center;
        position: relative;
        border-radius: 15px;
        margin: 5px;
        border: 3px dotted #e4e4e4;
        width: 140px;
        height: 140px;
        margin: 20px;
        border-radius: 28px;
    }
</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection
{{-- extra css files --}}
@section('content')

<div class="content-body">
<form action="{{route('admin.meetingrooms.store')}}" method="post" enctype="multipart/form-data" class="store form-horizontal" novalidate>
@csrf

  <!-- account setting page start -->
    <section id="page-account-settings">
      <div class="row">
          <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1 card card-body">

                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-main" data-toggle="pill" href="#account-vertical-main" aria-expanded="true">
                            <i class="feather icon-settings mr-50 font-medium-3"></i>
                            {{__('admin.main_data')}}
                        </a>
                    </li>
                    <li class="nav-item" style="margin-top: 3px" > 
                        <a class="nav-link d-flex py-75" id="account-pill-times" data-toggle="pill" href="#account-vertical-times" aria-expanded="false">
                            <i class="feather icon-calendar mr-50 font-medium-3"></i>
                            {{__('admin.room_times')}}
                        </a>
                    </li>

                </ul>
            </div>
          <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="account-vertical-main" aria-labelledby="account-pill-main" aria-expanded="true">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12">
                                                    <ul class="nav nav-tabs  mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="imgMontg col-12 text-center">
            
                                                        <div class="dropBox d-flex">
                                                            <div class="textCenter">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*" name="images[]"
                                                                            class="imageUploader">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <button class="clickAdd">
                                                            <span>
                                                                <i class="feather icon-plus"></i>
                                                            </span>
                                                        </button>
            
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.place')}}</label>
                                                        <div class="controls">
                                                            <select name="place_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                <option value>{{__('admin.place')}}</option>
                                                                @foreach ($places as $place)
                                                                    <option value="{{$place->id}}">{{$place->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.section')}}</label>
                                                       
                                                        <input type="hidden" name="category_id" id="root_category" value="">
                                                        <div class="col-md-12 col-12" id="category_level">
                                                            <div id="jstree">
                                                                @include('admin.categories_services.view_tree',['mainCategories' => $categories])
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="tab-content">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                    <div class="controls">
                                                                        <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.options')}}</label>
                                                        <div class="controls">
                                                            <select name="options[]" class="select2 form-control"  multiple="">
                                                                <option value>{{__('admin.options')}}</option>
                                                                @foreach ($options as $option)
                                                                    <option value="{{$option->id}}">{{$option->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> 


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.allow_notes')}} :</label>
                                                    {{-- <div class="controls"> --}}
                                                        <label class="switch">
                                                            <input name="allow_notes" type="checkbox" value="1"/>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.need_confirm')}} :</label>
                                                    {{-- <div class="controls"> --}}
                                                        <label class="switch">
                                                            <input name="need_confirm" type="checkbox" value="1"/>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.num_reservations') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="num_reservations"  class="form-control" min="0" 
                                                            placeholder="{{ __('admin.num_reservations') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.sort')}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="sort"  class="form-control" placeholder="{{__('admin.sort')}}" min="0" >
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                </div>


                                <div role="tabpanel" class="tab-pane" id="account-vertical-times" aria-labelledby="account-pill-times" aria-expanded="false">
                                    <div class="row">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                               <tr>
                                                {{-- <th>#</th> --}}
                                                <th>{{ __('admin.day') }}</th>
                                                <th>{{ __('admin.time') }}</th>
                                               </tr>
                                            </thead>
                                            <tbody>
                                                @include('admin.meetingrooms.create_day',['day' => 'Saturday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Sunday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Monday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Tuesday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Wednesday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Thursday'])
                                                @include('admin.meetingrooms.create_day',['day' => 'Friday'])
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <div class="col-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.add')}}</button>
        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
    </div>

</form>
<!-- account setting page end -->
</div>

@endsection
@section('js')
<script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

{{-- show selected image script --}}
    @include('admin.shared.addImage')
{{-- show selected image script --}}

{{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
{{-- submit add form script --}}

<script>
    function hideCustomTime(id) {
        $('#'+id+'-btn').hide();
        $('.times-row-'+id).hide();
        $('.days-row-'+id).show();
    }

    function showCustomTime(id) {
        $('#'+id+'-btn').show();
        $('.times-row-'+id).show();
        $('.days-row-'+id).hide();
    }

           var rowCountsArray = [];
           function addMoreDayTimes(e, dayCode) {
               if (e.preventDefault) {
                   e.preventDefault();
               } else {
                   e.returnValue = false;
               }
               var rowCount = Math.floor(Math.random() * 9000000000) + 1000000000;
               rowCountsArray.push(rowCount);
               var options =`<option value="0">12:00 AM</option><option value="1">1:00 AM</option><option value="2">2:00 AM</option><option value="3">3:00 AM</option><option value="4">4:00 AM</option><option value="5">5:00 AM</option><option value="6">6:00 AM</option><option value="7">7:00 AM</option><option value="8">8:00 AM</option><option value="9">9:00 AM</option><option value="10">10:00 AM</option><option value="11">11:00 AM</option><option value="12">12:00 PM</option><option value="13">1:00 PM</option><option value="14">2:00 PM</option><option value="15">3:00 PM</option><option value="16">4:00 PM</option><option value="17">5:00 PM</option><option value="18">6:00 PM</option><option value="19">7:00 PM</option><option value="20">8:00 PM</option><option value="21">9:00 PM</option><option value="22">10:00 PM</option><option value="23">11:00 PM</option>`;
               var divContent = $('#div-content-' + dayCode);
               var newRow = `
               <div class="row times-row-${dayCode}" id="rowId-${dayCode}-${rowCount}" style="margin-bottom:5px;">
                   <div class="col-md-3">
                       <div class="input-group">
                        <select class="form-control" name="times[${dayCode}][from][]">
                            ${options}
                        </select>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="input-group">
                        <select class="form-control" name="times[${dayCode}][to][]">
                            ${options}
                        </select>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="input-group">
                            <input type="number" name="times[${dayCode}][price][]" class="form-control" placeholder="{{ __('admin.price') }}">
                        </div>
                    </div>
                   <div class="col-md-3">
                       <button type="button" class="btn btn-danger" onclick="removeDayTimes('${dayCode}', ${rowCount}, 'row')" style="margin-top:0px;">X</button>
                   </div>
               </div>`;
   
               divContent.append(newRow);
           }
   
           function removeDayTimes(dayCode, index, flag = '') {
               if (flag === 'row') {
                   $('#rowId-' + dayCode + '-' + index).remove();
                   const i = rowCountsArray.indexOf(index);
                   if (i > -1) {
                       rowCountsArray.splice(i, 1);
                   }
               }
           }
   

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript">
    $(function () {

        $('#jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('#jstree').on("changed.jstree", function (e, data) {
            $('#root_category').val(data.selected);
        });

    });
</script>
@endsection

