@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
    .uploadedBlock{
        margin: 5px !important;
    }
    .clickAdd{
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
    .delete-image{
        position: absolute;
        z-index: 9999999;
        left: 36%;
        top: 42%;
        background: bottom;
        font-size: 26px;
        border: aquamarine;
    }
</style>
@endsection
{{-- extra css files --}}
@section('content')

<div class="content-body">
<form class="show form-horizontal" novalidate>
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

                                                <div class="imgMontg col-12 text-center">

                                                    <div class="dropBox d-flex">
                                                        @foreach ($meetingroom->images as $image)
                                                            <div class="textCenter">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        <img src="{{$image->image}}" class="im">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                </div>


                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.place')}}</label>
                                                        <div class="controls">
                                                            <select name="place_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                <option value>{{__('admin.place')}}</option>
                                                                @foreach ($places as $place)
                                                                    <option value="{{$place->id}}" {{ $place->id == $meetingroom->place_id ? 'selected' : ''}}>{{$place->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.section')}}</label>
                                                        
                                                        <input type="hidden" name="category_id" id="root_category" value="{{ $meetingroom->category_id }}">
                                                        <?php $category = $meetingroom->category;?>
                                                        <div class="col-md-12 col-12" id="category_level">
                                                            <div id="jstree">
                                                                @include('admin.categories_services.edit_tree_products',['mainCategories' => $categories])
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
                                                                        <input type="text" name="name[{{$lang}}]" value="{{$meetingroom->getTranslations('name')[$lang]??''}}" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
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
                                                                    <option value="{{$option->id}}" @if (in_array($option->id,$meetingroom->options))) selected @endif >{{$option->name}}</option>
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
                                                            <input name="allow_notes" type="checkbox" value="1" {{ $meetingroom->allow_notes == 1?'checked' : '' }}/>
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
                                                            <input name="need_confirm" type="checkbox" value="1" {{ $meetingroom->need_confirm == 1 ? 'checked' : '' }}/>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.num_reservations') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="num_reservations" value="{{ $meetingroom->num_reservations }}"  class="form-control" min="0" 
                                                            placeholder="{{ __('admin.num_reservations') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.sort')}}</label>
                                                    <div class="controls">
                                                        <input type="number" name="sort" value="{{ $meetingroom->sort }}"  class="form-control" placeholder="{{__('admin.sort')}}" min="0">
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
                                                @include('admin.meetingrooms.show_day',['day' => 'Saturday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Sunday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Monday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Tuesday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Wednesday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Thursday'])
                                                @include('admin.meetingrooms.show_day',['day' => 'Friday'])
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

<script>
    $('.show input').attr('disabled' , true)
    $('.show textarea').attr('disabled' , true)
    $('.show select').attr('disabled' , true)
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

