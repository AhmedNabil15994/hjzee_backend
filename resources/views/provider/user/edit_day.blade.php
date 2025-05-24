<tr>
                                                    
    <td>
        {{ __('admin.'.$day) }}
    </td>
    <td  id="div-content-{{ $day }}">
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-3">
                 <?php $all_days = ($row->times->where('day',$day)->whereBetween('time',['00:00','24:00'])->count() == 24)? true : false; ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="times[{{ $day }}][is_full_day]" id="inlineRadio1" value="1" onclick="hideCustomTime('{{ $day }}')" {{ $all_days == true ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio1"> {{ __('admin.all_day') }} </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="times[{{ $day }}][is_full_day]" id="inlineRadio2" value="0" onclick="showCustomTime('{{ $day }}')" {{ $all_days != true ? 'checked' : '' }} >
                    <label class="form-check-label" for="inlineRadio2"> {{ __('admin.custom_time') }} </label>
                </div>

                <button type="button" id="{{ $day }}-btn" style="{{ $all_days == true ? 'display:none;' : '' }}" class="btn btn-success" onclick="addMoreDayTimes(event, '{{ $day }}')">
                {{ __('admin.add') }} 
                <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
        <?php
            $times = $row->times->where('day',$day)->pluck('time')->toArray();
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
                <div class="row times-row-{{ $day }}" id="rowId-{{ $day }}-{{ $loop->iteration }}" style="{{ $all_days == true ? 'display:none;' : '' }} margin-bottom:5px;" >
                    <div class="col-md-3">
                        <div class="input-group">
                         <select class="form-control" name="times[{{ $day }}][from][]">
                            <option value="0" {{ $from == 0? 'selected' : '' }}>12:00 AM</option><option value="1" {{ $from == 1? 'selected' : '' }}>1:00 AM</option><option value="2" {{ $from == 2? 'selected' : '' }}>2:00 AM</option><option value="3" {{ $from == 3? 'selected' : '' }}>3:00 AM</option><option value="4" {{ $from == 4? 'selected' : '' }}>4:00 AM</option><option value="5" {{ $from == 5? 'selected' : '' }}>5:00 AM</option><option value="6" {{ $from == 6? 'selected' : '' }}>6:00 AM</option><option value="7" {{ $from == 7? 'selected' : '' }}>7:00 AM</option><option value="8" {{ $from == 8? 'selected' : '' }}>8:00 AM</option><option value="9" {{ $from == 9? 'selected' : '' }}>9:00 AM</option><option value="10" {{ $from == 10? 'selected' : '' }}>10:00 AM</option><option value="11" {{ $from == 11? 'selected' : '' }}>11:00 AM</option><option value="12"{{ $from == 12? 'selected' : '' }}>12:00 PM</option><option value="13" {{ $from == 13? 'selected' : '' }}>1:00 PM</option><option value="14" {{ $from == 14? 'selected' : '' }}>2:00 PM</option><option value="15" {{ $from == 15? 'selected' : '' }}>3:00 PM</option><option value="16" {{ $from == 16? 'selected' : '' }}>4:00 PM</option><option value="17" {{ $from == 17? 'selected' : '' }}>5:00 PM</option><option value="18" {{ $from == 18? 'selected' : '' }}>6:00 PM</option><option value="19" {{ $from == 19? 'selected' : '' }}>7:00 PM</option><option value="20" {{ $from == 20? 'selected' : '' }}>8:00 PM</option><option value="21" {{ $from == 21? 'selected' : '' }}>9:00 PM</option><option value="22" {{ $from == 22? 'selected' : '' }}>10:00 PM</option><option value="23"{{ $from == 23? 'selected' : '' }}>11:00 PM</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                         <select class="form-control" name="times[{{ $day }}][to][]">
                            <option value="0" {{ $to == 0? 'selected' : '' }}>12:00 AM</option><option value="1" {{ $to == 1? 'selected' : '' }}>1:00 AM</option><option value="2" {{ $to == 2? 'selected' : '' }}>2:00 AM</option><option value="3" {{ $to == 3? 'selected' : '' }}>3:00 AM</option><option value="4" {{ $to == 4? 'selected' : '' }}>4:00 AM</option><option value="5" {{ $to == 5? 'selected' : '' }}>5:00 AM</option><option value="6" {{ $to == 6? 'selected' : '' }}>6:00 AM</option><option value="7" {{ $to == 7? 'selected' : '' }}>7:00 AM</option><option value="8" {{ $to == 8? 'selected' : '' }}>8:00 AM</option><option value="9" {{ $to == 9? 'selected' : '' }}>9:00 AM</option><option value="10" {{ $to == 10? 'selected' : '' }}>10:00 AM</option><option value="11" {{ $to == 11? 'selected' : '' }}>11:00 AM</option><option value="12" {{ $to == 12? 'selected' : '' }}>12:00 PM</option><option value="13" {{ $to == 13? 'selected' : '' }}>1:00 PM</option><option value="14" {{ $to == 14? 'selected' : '' }}>2:00 PM</option><option value="15" {{ $to == 15? 'selected' : '' }}>3:00 PM</option><option value="16" {{ $to == 16? 'selected' : '' }}>4:00 PM</option><option value="17" {{ $to == 17? 'selected' : '' }}>5:00 PM</option><option value="18" {{ $to == 18? 'selected' : '' }}>6:00 PM</option><option value="19" {{ $to == 19? 'selected' : '' }}>7:00 PM</option><option value="20" {{ $to == 20? 'selected' : '' }}>8:00 PM</option><option value="21" {{ $to == 21? 'selected' : '' }}>9:00 PM</option><option value="22" {{ $to == 22? 'selected' : '' }}>10:00 PM</option><option value="23" {{ $to == 23? 'selected' : '' }}>11:00 PM</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger" onclick="removeDayTimes('{{ $day }}', {{ $loop->iteration }}, 'row')">X</button>
                    </div>
                </div>
            @endforeach
    </td>
</tr>