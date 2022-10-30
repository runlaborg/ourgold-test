<?php

namespace App\Http\Requests;

use App\Models\Furniture;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FurnitureRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'room_id' => 'required|exists:App\Models\Room,id',
            'title' => 'max:100',
            'type' => ['required', Rule::in(Furniture::$types)],
            'material' => ['required', Rule::in(Furniture::$materials)],
            'color' => 'required|max:100',
        ];
    }
}
