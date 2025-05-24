@extends('provider.layout.master')
@section('content')
<div class="page-contant mt-4 mb-5">
    <div class="container">
        <div class="login-title">
            <h6>{{__('provider.Adjusting working hours')}}</h6>
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

            <form class="log-form row flex-column mt-5" action="{{route('provider.updateProviderTimes')}}" method="POST" id="form">
                @csrf
                @method('PUT')
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                           <tr>
                            <th>{{ __('admin.day') }}</th>
                            <th>{{ __('admin.time') }}</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php $row = $provider;?>
                            @include('provider.user.edit_day',['day' => 'Saturday'])
                            @include('provider.user.edit_day',['day' => 'Sunday'])
                            @include('provider.user.edit_day',['day' => 'Monday'])
                            @include('provider.user.edit_day',['day' => 'Tuesday'])
                            @include('provider.user.edit_day',['day' => 'Wednesday'])
                            @include('provider.user.edit_day',['day' => 'Thursday'])
                            @include('provider.user.edit_day',['day' => 'Friday'])
                        </tbody>
                    </table>
                <button  class="add-btn">{{__('provider.Confirm')}}</button>
            </form>
        </div>
    </div>
@section('js')
<script>
    function hideCustomTime(id) {
    $('#'+id+'-btn').hide();
    $('.times-row-'+id).hide();
    //   $("#main-price-" + id).show();
    }

    function showCustomTime(id) {
        $('#'+id+'-btn').show();
        $('.times-row-'+id).show();
    //   $("#main-price-" + id).hide();
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
                       <button type="button" class="btn btn-danger" onclick="removeDayTimes('${dayCode}', ${rowCount}, 'row')">X</button>
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

@endsection
@endsection
