<?php

namespace App\Http\Requests;

use App\Layer;
use Illuminate\Foundation\Http\FormRequest;

class StoreLayer extends FormRequest
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
            'image' => 'required|mimes:png',
            'layer_id' => 'required',
        ];
    }

}
