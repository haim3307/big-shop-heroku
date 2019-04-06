<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $item_id = isset($request->item_id)?','.$request->item_id:'';
        return [
            'name' => 'required|max:255',
            'url' => 'required|max:255|regex:/^[a-z\d-]+$/|unique:categories,url'.$item_id,
/*            'description' => 'required|min:10',*/
            'img' => 'image'
        ];
    }
}
