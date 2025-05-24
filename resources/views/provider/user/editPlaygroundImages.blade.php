@extends('provider.layout.master')

@section('content')
<div class="page-contant mt-4 mb-5">
    <div class="container">
        <div class="login-title">
            <h6>{{__('provider.editProviderTimes')}}</h6>
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
        @if(session('error'))
            <div class="alert alert-danger">
                <ul>
                        <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif

            <form class="log-form row flex-column mt-5" action="{{route('provider.updateProviderImages')}}" method="POST" id="form">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                    <div class="imgMontg col-12 text-center">

                        <div class="dropBox d-flex">
                            @foreach ($provider->images as $image)
                                <div class="textCenter">
                                    <div class="imagesUploadBlock">
                                        <label class="uploadImg">
                                            <span><i class="feather icon-image"></i></span>
                                            <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                        </label>
                                        <div class="uploadedBlock">
                                            <img src="{{$image->image}}" class="im">
                                            <button class="delete-image" data-id="{{$image->id}}" ><i class="feather icon-trash text-danger">X</i></button>
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
                </div>
            </div>
                <button type="submit"  class="add-btn">{{__('provider.Confirm')}}</button>
            </form>
        </div>
    </div>
@section('js')
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
                method: 'DELETE',
                data: {
                    image_id: image_id
                },
                dataType: 'json',
                success: (msg) => {
                    if (msg.msg == 'success') {
                        $(this).parents('.textCenter').remove()
                        toastr.success("{{ __('تم حذف المحدد بنجاح') }}")
                    }
                }
            });
        }
    })
</script>
@endsection
@endsection
