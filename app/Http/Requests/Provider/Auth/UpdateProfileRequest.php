<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function __construct(Request $request) {
        if($request['phone']){
          $request['phone']        = fixPhone($request['phone']);
        }
        // if($request['country_code']){
        //   $request['country_code'] = fixPhone($request['country_code']);
        // }
    
        // if ($request['phone'] && auth('provider')->user()->phone !== $request['phone']) {
        //   $request['active'] = false;
        // }
    
      }

    public function rules()
    {
        return [
            // 'country_code' => 'sometimes|required|numeric|digits_between:2,5',
            'phone'        => 'sometimes|required|numeric|min:7|unique:providers,phone,' . auth('provider')->id(),
            'email'        => 'sometimes|required|email|unique:providers,email,' . auth('provider')->id(),
            'name'         => 'sometimes|required|max:50',
            // 'type'         => 'required|in:service,place',
            'gender'       => 'nullable|in:male,female',
            'image'        => 'nullable|image',
            'job'            => 'nullable',
            'info'           => 'nullable',
            'education_info' => 'nullable',



          ];
    }
}
