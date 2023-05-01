<?php

namespace App\Http\Requests;

use App\Enums\Body;
use App\Enums\Fuel;
use App\Enums\Type;
use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'type' => 'required|in:'.implode(',', Type::names()),
            'engine_model' => 'required|max:255',
            'engine_number' => 'required|max:255',
            'engine_capacity' => 'required|numeric',
            'cylinders_count' => 'required|integer|max:255',
            'engine_power' => 'required|integer',
            'max_torque' => 'required|integer',
            'max_speed' => 'required|integer',
            'acceleration_time' => 'required|numeric',
            'doors_count' => 'required|integer|max:255',
            'seats_count' => 'required|integer|max:255',
            'length' => 'required|integer',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'fuel' => 'required|in:'.implode(',', Fuel::names()),
            'fuel_consumption_90' => 'required|numeric',
            'fuel_consumption_120' => 'required|numeric',
            'fuel_consumption_city' => 'required|numeric',
            'brand_id' => 'required|integer|exists:brands,id',
            'country_id' => 'required|integer|exists:countries,id',
            'body' => 'required|in:'.implode(',', Body::names()),
            'release_date' => 'required|date'
        ];
    }
}
