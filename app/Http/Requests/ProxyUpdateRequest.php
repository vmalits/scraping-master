<?php

namespace App\Http\Requests;

use App\Rules\ProxyType;
use App\Rules\ProxyUniqueFields;
use Illuminate\Foundation\Http\FormRequest;

class ProxyUpdateRequest extends FormRequest
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
            'type' => ['required', 'string', new ProxyType()],
            'ip' => ['required', 'ipv4'],
            'port' => ['required', 'numeric'],
        ];
    }
}
