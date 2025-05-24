<?php

namespace App\Http\Requests\Admin\images;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'                => ['nullable','image'],
            'name.*'                 => 'required',
            'start_date'           => 'required',
            'end_date'             => 'required',
            'link'                 => 'nullable',
            'type'                 => 'required|in:place,service,link',
            'service_id'           => 'nullable|exists:services,id',
            'place_id'             => 'nullable|exists:places,id',
            'sort'                 => 'nullable',
        ];
    }
}
