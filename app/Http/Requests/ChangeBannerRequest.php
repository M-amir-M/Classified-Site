<?php

namespace App\Http\Requests;

use App\Banner;
use App\Http\Requests\Request;

class ChangeBannerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Banner::where([
            'user_id' => auth()->user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|mimes:jpg,jpeg,png,gif'
        ];
    }
}
