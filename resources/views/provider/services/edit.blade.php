@extends('provider.layout.master')
@section('content')
@section('css')
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
    <div class="page-contant mt-5 mb-5 pr-2 pl-2">
        <div class="container fadedown1">
            <div class="title mt-5 mb-4">
                <h5 class="mb-0">{{__('provider.edit_service')}}</h5>
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
            <form  method="POST" action="{{route('provider.updateService' , [$service])}}" class="store form-horizontal" id="form">
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
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('admin.section')}}</label>
                                    <div class="controls">
                                        <select name="category_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            <option value>{{__('admin.section')}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ $category->id == $service->category_id ? 'selected' : ''}}>{{$category->name}}</option>
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
                                    <input type="text" name="address" value="{{ $service->address }}" class="form-control" min="0" step="0.01"
                                        placeholder="{{ __('admin.address') }}">
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
                        {{-- <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">{{ __('admin.num_reserved_seets') }}</label>
                                <div class="controls">
                                    <input type="number" name="num_reservations" value="{{ $service->num_reservations }}"  class="form-control" min="0" 
                                        placeholder="{{ __('admin.num_reserved_seets') }}">
                                </div>
                            </div>
                        </div> --}}
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

                        
                        <div class="col-12 d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
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
<script>
    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();
        var image_id = $(this).data('id');
        var url = '{{ route('provider.deleteImage') }}';
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
@endsection
@endsection
