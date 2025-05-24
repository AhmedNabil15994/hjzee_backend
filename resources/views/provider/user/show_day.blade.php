<?php 
$all_days = ($provider->times->where('day',$day)->whereBetween('time',['00:00','24:00'])->count() == 24)? true : false; ?>
<h6>
    <span style="color: #2C52A2;">{{ __('admin.'.$day) }}</span>
    <span>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" {{ $all_days == true ? 'checked' : '' }} >
        <label class="form-check-label" for="inlineRadio1"> {{ __('admin.all_day') }} </label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio"  {{ $all_days != true ? 'checked' : '' }} >
        <label class="form-check-label" for="inlineRadio2"> {{ __('admin.custom_time') }} </label>
        </div>
    </span>
</h6>
<?php
$times = $provider->times->where('day',$day)->pluck('time')->toArray();
$result = [];
$subarray = [];
foreach ($times as $index => $time) {
   // Add the current time to the subarray
   $subarray[] = $time;
   // Check if there is a next time
   if (isset($times[$index + 1])) {
       // Compare the current time with the next time
       if ((int)$times[(int)$index + 1] - (int)$time > 1) {
           // There is a gap, so add the subarray to the result and reset it
           $result[] = $subarray;
           $subarray = [];
       }
   } else {
       // There is no next time, so add the subarray to the result
       $result[] = $subarray;
   }
}
?>
@foreach ($result as $sub)
       @if(count($sub) == 1)
           <?php $from = (int)min($sub);?>
           <?php $to   = (int)$times[0] + 1;?>
       @else
          <?php $from = (int)min($sub);?>
          <?php $to   = (int)max($sub);?>
       @endif

       <h6 style="{{ $all_days == true ? 'display:none;' : '' }}">  
        {{__('provider.from')}} <span>{{ $from.':00' }} {{ ($from > 12)? 'PM' : 'AM' }}</span>  - {{__('provider.to')}} <span>{{ $to.':00' }} {{ ($to > 12)? 'PM' : 'AM' }}</span> </h6>
@endforeach