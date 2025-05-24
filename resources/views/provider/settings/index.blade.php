@extends('provider.layout.master')
@section('content')

    <div class="page-contant mt-4">
        <div class="container">
            <div class="language">
                    <h5 class="mb-0">{{__('provider.The language')}}</h5>
                    <form action="{{route('provider.changeLang')}}" method="POST" id="langForm">
                        @csrf
                        <select name="lang" id="lang">
                            <option value="ar" {{(lang() == 'ar')?'selected' : ''}}>العربية</option>
                            <option value="en" {{(lang() == 'en')?'selected' : ''}}>English</option>
                        </select>
                    </form>
            </div>
        </div>
    </div>
@section('js')
<script>
    $("#lang").change(function () {
        $('#langForm').submit();
    });
</script>
@endsection
@endsection
