@extends('provider.layout.master')
@section('content')
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
@endsection
    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.add_place')}}</h5>
            </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form  method="POST" action="{{route('provider.createPlace')}}" class="store form-horizontal" novalidate id="form">
    @csrf
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
                                                            <label for="first-name-column">{{__('admin.section')}}</label>
                                                            <div class="controls">
                                                                <select name="category_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                    <option value>{{__('admin.section')}}</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{__('admin.city')}}</label>
                                                            <div class="controls">
                                                                <select name="city_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                    <option value>{{__('admin.city')}}</option>
                                                                    @foreach ($cities as $city)
                                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {{-- to create languages tabs uncomment that --}}
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
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="description">{{ __('admin.description') }} {{ $lang }}</label>
                                                                                <textarea class="form-control" name="description[{{$lang}}]" id="description" cols="30" rows="10"
                                                                                    placeholder="{{__('admin.write') . __('admin.description')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    
                                                {{--  to create languages tabs uncomment that --}}
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{ __('admin.num_meeting_rooms') }}</label>
                                                        <div class="controls">
                                                            <input type="number" name="num_meeting_rooms" class="form-control" min="0" step="1"
                                                                placeholder="{{ __('admin.num_meeting_rooms') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{ __('admin.address') }}</label>
                                                        <div class="controls">
                                                            <input type="text" id="address1" name="address" class="form-control" placeholder="{{ __('admin.address') }}" >
                                                            <input id="search1" class="controls" type="text" placeholder="search">
                                                            <div id="map1" class="store_map" style="width: 100%;height:250px;"></div>
                                                            <input type="hidden" id="lat1" name="lat" class="form-control" >
                                                            <input type="hidden" id="lng1" name="lng" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                       

                                                
                                                </div>
            
            
            



                <div class="col-12 d-flex justify-content-center mt-3">
                    <button type="submit"
                        class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.add') }}</button>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>

@section('js')
<script>
    $(".image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
                $('.image-preview').addClass("up");
                $(".fancyLink").attr("href" , e.target.result)
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<?php $google_places_key =  $settings['google_places'] ;?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{$google_places_key}}&libraries=places&language=ar"></script>
<script type="text/javascript">

//************ FIRST MAP ********************//
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        (position) => {
            var map; var marker;
            var geocoder  = new google.maps.Geocoder();
            // infoWindow.setPosition(pos);
            // infoWindow.setContent("Location found.");
            // infoWindow.open(map);
            // var x= position.coords.latitude;
            myLatlng= new google.maps.LatLng( position.coords.latitude,  position.coords.longitude);
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
            $('#lat1').val(marker.getPosition().lat());
            $('#lng1').val(marker.getPosition().lng());

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
        },(error) => {
            var message = '{{ __('admin.open_location') }}';
            alert(message);
            // function initMap(){
                var map; var marker;
                var myLatlng  = new google.maps.LatLng(29.2259, 47.5892);
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

        }
    );

}else{
    // function initMap(){
		var map; var marker;
		var myLatlng  = new google.maps.LatLng(29.2259, 47.5892);
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

}
</script>
@endsection
@endsection
