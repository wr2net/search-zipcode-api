<?php

namespace App\ZipCodes\Search\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ZipCodeRequest
 * @package App\ZipCodes\Requests
 */
class ZipCodeRequest extends FormRequest
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
        if (!$this->zipCode) {
            return [
                "raw" => ['nullable', 'string'],
                'zip_code' => ['required', 'string'],
                "address" => ['nullable', 'string'],
                "neighborhood" => ['nullable', 'string'],
                "city" => ['nullable', 'string'],
                "state" => ['nullable', 'string'],
            ];
        }

        return [
            "raw" => ['nullable', 'string'],
            'zip_code' => ['required', 'string'],
            "address" => ['nullable', 'string'],
            "neighborhood" => ['nullable', 'string'],
            "city" => ['nullable', 'string'],
            "state" => ['nullable', 'string'],
        ];
    }
}
