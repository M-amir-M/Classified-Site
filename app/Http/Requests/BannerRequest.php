<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerRequest extends Request
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
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'city' => 'required',
            'location' => 'required',
        ];
    }

    public function messages(){
        return [
            'category_id.required' => 'دسته آگهی خود را انتخاب کنید.',
            'location.required' => 'محله خود را بنویسید.',
        ];
    }
}
