@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
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
    #infowindow-content {
        display: none;
    }

    #map1 #infowindow-content {
        display: inline;
    }
    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }
    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }
    .pac-container {
        z-index: 9999999;
    }
    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
    #search1 {
        background-color: #fff;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        /* left: 0 !important; */
        margin-right: 13px;
        width: 50%;
        top: 17px !important;
        right: 50px !important;
        /* z-index: 99 !important; */
        height: 30px;
        margin: auto;
        /* border: 1px solid #5e65a1; */
        border-radius: 5px;
    }
    #search1:focus {
        border-color: #4d90fe;
    }
    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 250px;
    }  
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.update') . ' ' . __('admin.service')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.services.update' , ['id' => $service->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    
                                    {{-- to create languages tabs uncomment that --}}
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
                                                @foreach ($service->images as $image)
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$image->image}}" class="im">
                                                                <button class="delete-image" data-id="{{$image->id}}" ><i class="feather icon-trash text-danger"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
    
                                            <button class="clickAdd">
                                                <span>
                                                    <i class="feather icon-plus"></i>
                                                </span>
                                            </button>
                                            
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.provider')}}</label>
                                                <div class="controls">
                                                    <select name="provider_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.provider')}}</option>
                                                        @foreach ($providers as $provider)
                                                            <option value="{{$provider->id}}" {{ $provider->id == $service->provider_id ? 'selected' : ''}}>{{$provider->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.section')}}</label>

                                                <input type="hidden" name="category_id" id="root_category" value="{{ $service->category_id }}">
                                                <?php $category = $service->category;?>
                                                <div class="col-md-12 col-12" id="category_level">
                                                    <div id="jstree">
                                                        @include('admin.categories_services.edit_tree_products',['mainCategories' => $categories])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.course_place')}}</label>
                                                <div class="controls">
                                                    <select name="place_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.course_place')}}</option>
                                                        @foreach ($places as $place)
                                                            <option value="{{$place->id}}" {{ $place->id == $service->place_id ? 'selected' : ''}}>{{$place->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                    {{-- to create languages tabs uncomment that --}}
                                       <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" name="name[{{$lang}}]" value="{{$service->getTranslations('name')[$lang]??''}}" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="description">{{ __('admin.description') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="description[{{$lang}}]" id="description" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.description')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">{{ $service->getTranslations('description')[$lang]??''}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="times">{{ __('admin.times') }} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="times[{{$lang}}]" id="times" cols="30" rows="10"
                                                                        placeholder="{{__('admin.write') . __('admin.times')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">{{ $service->getTranslations('times')[$lang]??''}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        
                                    {{--  to create languages tabs uncomment that --}}
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.start_date') }}</label>
                                            <div class="controls">
                                                <input type="datetime-local" name="start_date" value="{{ $service->start_date }}" class="form-control"
                                                    placeholder="{{ __('admin.start_date') }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.is_free')}} :</label>
                                            {{-- <div class="controls"> --}}
                                                <label class="switch">
                                                    <input name="is_free" id="is_free" type="checkbox" value="1" {{ $service->is_free == 1 ? 'checked' : '' }}/>
                                                    <span class="slider round"></span>
                                                </label>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 price">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.price') }}</label>
                                            <div class="controls">
                                                <input type="number" name="price" value="{{ $service->price }}" class="form-control" min="0" step="0.01"
                                                    placeholder="{{ __('admin.price') }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 price">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.offer_price') }}</label>
                                            <div class="controls">
                                                <input type="number" name="offer_price" value="{{ $service->offer_price }}"  class="form-control" min="0" step="0.01"
                                                    placeholder="{{ __('admin.offer_price') }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.address') }}</label>
                                            <div class="controls">
                                                <input type="text" id="address1" value="{{ $service->address }}" name="address" class="form-control" placeholder="{{ __('admin.address') }}" >
                                                <input id="search1" class="controls" type="text" placeholder="search">
                                                <div id="map1" class="store_map" style="width: 100%;height:250px;"></div>
                                                <input type="hidden" id="lat1" value="{{ $service->lat }}" name="lat" class="form-control" >
                                                <input type="hidden" id="lng1" value="{{ $service->lng }}" name="lng" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.num_seats') }}</label>
                                            <div class="controls">
                                                <input type="number" name="num_seats" value="{{ $service->num_seats }}"  class="form-control" min="0" 
                                                    placeholder="{{ __('admin.num_seats') }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.num_reserved_seets') }}</label>
                                            <div class="controls">
                                                <input type="number" name="num_reservations" value="{{ $service->num_reservations }}"  class="form-control" min="0" 
                                                    placeholder="{{ __('admin.num_reserved_seets') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.allow_notes')}} :</label>
                                            {{-- <div class="controls"> --}}
                                                <label class="switch">
                                                    <input name="allow_notes" type="checkbox" value="1" {{ $service->allow_notes == 1 ? 'checked' : '' }}/>
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
                                                    <input name="need_confirm" type="checkbox" value="1" {{ $service->need_confirm == 1 ? 'checked' : '' }}/>
                                                    <span class="slider round"></span>
                                                </label>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.service_type')}}</label>
                                            <div class="controls">
                                                <select name="type" class="select2 form-control"  >
                                                    <option value>{{__('admin.service_type')}}</option>
                                                    <option value="offline" {{ $service->type == 'offline' ? 'selected' : '' }}>{{__('admin.offline')}}</option>
                                                    <option value="online" {{ $service->type == 'online' ? 'selected' : '' }}>{{__('admin.online')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.options')}}</label>
                                            <div class="controls">
                                                <select name="options[]" class="select2 form-control"  multiple="">
                                                    <option value>{{__('admin.options')}}</option>
                                                    @foreach ($options as $option)
                                                        <option value="{{$option->id}}" @if (in_array($option->id,$service->options??[]))) selected @endif >{{$option->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <!-- checkBoxs -->
                                        <div class="form-group">
                                            <label for="b-name" class="form-label">{{__('admin.target_audience')}} </label>
                                            <div class="checks checks1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="cont">
                                                            <input type="checkbox"  name="target_audience[]" value="male" {{ in_array('male',$service->target_audience??[])?'checked':'' }}/>
                                                            <span class="checkmark"></span>
                                                            <span class="label">{{__('admin.males')}} </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="cont">
                                                            <input type="checkbox"  name="target_audience[]" value="female" {{ in_array('female',$service->target_audience??[])?'checked':'' }}/>
                                                            <span class="checkmark"></span>
                                                            <span class="label">{{__('admin.females')}} </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{ __('admin.from_age') }}</label>
                                                            <div class="controls">
                                                                <input type="number" name="from_age" value="{{ $service->from_age }}"  class="form-control" min="0" step="1"
                                                                    placeholder="{{ __('admin.from_age') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{ __('admin.to_age') }}</label>
                                                            <div class="controls">
                                                                <input type="number" name="to_age" value="{{ $service->to_age }}"  class="form-control" min="0" step="1"
                                                                    placeholder="{{ __('admin.to_age') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.sort')}}</label>
                                            <div class="controls">
                                                <input type="number" name="sort" value="{{ $service->sort }}"  class="form-control" placeholder="{{__('admin.sort')}}" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{ __('admin.expire_at') }}</label>
                                            <div class="controls">
                                                <input type="date" name="expire_at" value="{{ $service->expire_at }}" class="form-control" placeholder="{{ __('admin.expire_at') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit edit form script --}}
        @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
<script>
        $(document).on('click', '.delete-image', function(e) {
            e.preventDefault();
            var image_id = $(this).data('id');
            var url = '{{ route('admin.services.delete.image') }}';
            if (confirm('Are you sure to delete this image')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: 'POST',
                    data: {
                        image_id: image_id
                    },
                    dataType: 'json',
                    success: (msg) => {
                        if (msg.msg == 'success') {
                            $(this).parents('.textCenter').remove()
                            Swal.fire({
                                position: 'top-start',
                                type: 'success',
                                title: '{{ __('تم حذف المحدد بنجاح') }}',
                                showConfirmButton: false,
                                timer: 1500,
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,

                            })
                        }
                    }
                });
            }
        })    
</script>   
<script>
    if( $('#is_free').is(':checked') ){
        $('.price').hide();
    }else{
        $('.price').show();
    } 
    $('#is_free').on('change', function(e) { 
        e.preventDefault();
        if( $('#is_free').is(':checked') ){
            $('.price').hide();
        }else{
            $('.price').show();
        }
    });
    </script>
<?php $google_places_key =  $settings['google_places'] ;?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{$google_places_key}}&libraries=places&language=ar"></script>
<script type="text/javascript">

//************ FIRST MAP ********************//
    // function initMap(){
		var map; var marker;
		var myLatlng  = new google.maps.LatLng({{ $service->lat??'0' }}, {{ $service->lng??'0' }});
		var geocoder  = new google.maps.Geocoder();
		var mapOptions = {
		    zoom: 14,
		    center: myLatlng,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("map1"), mapOptions);
		marker = new google.maps.Marker({
		    map: map,
		    position: myLatlng,
		    draggable: true
		});

/*start search box*/
        // Create the search box and link it to the UI element.
        var input = document.getElementById('search1');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            marker.setPosition(place.geometry.location);
		    $('#address1').val(place.formatted_address);
		    $('#lat1').val(place.geometry.location.lat());
		    $('#lng1').val(place.geometry.location.lng());
            if(place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            }else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
/*end search box*/
		google.maps.event.addListener(marker, 'dragend', function() {
		    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
		        // if (status == google.maps.GeocoderStatus.OK) {
		            // if (results[0]) {
		                $('#address1').val(marker.getPosition().formatted_address);
		                $('#lat1').val(marker.getPosition().lat());
		                $('#lng1').val(marker.getPosition().lng());
		            // }
		        // }
		    });
		});

    // }
	// google.maps.event.addDomListener(window, 'load', initMap);

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