<tr>
                                                    
    <td>
        {{ __('admin.'.$day) }}
    </td>
    <td  id="div-content-{{ $day }}">
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-3">

                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="times[{{ $day }}][is_full_day]" id="inlineRadio1" value="1" onclick="hideCustomTime('{{ $day }}')" checked>
                    <label class="form-check-label" for="inlineRadio1"> {{ __('admin.all_day') }} </label>
                </div> --}}
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="times[{{ $day }}][is_full_day]" id="inlineRadio2" value="0" onclick="showCustomTime('{{ $day }}')" checked>
                    <label class="form-check-label" for="inlineRadio2"> {{ __('admin.custom_time') }} </label>
                </div> --}}

                <button type="button" id="{{ $day }}-btn" class="btn btn-success" onclick="addMoreDayTimes(event, '{{ $day }}')">
                {{ __('admin.add') }} 
                {{-- <i class="fa fa-plus-circle"></i> --}}
                </button>
            </div>
            {{-- <div class="col-md-3">
                <input class="form-control days-row-{{ $day }}" type="number" name="day_prices[]" placeholder="{{ __('admin.price') }}">
            </div> --}}


        </div>
    </td>
</tr>