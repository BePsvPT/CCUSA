<?php

namespace App\Http\Requests;

class CooperativeStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:191',
            'began_at' => 'required|date',
            'ended_at' => 'required|date',
            'phone' => 'required|string|max:16',
            'address' => 'required|string|max:64',
            'description' => 'required|string',
            'business_hours' => 'required|string',
            'cover' => 'array',
            'cover.*' => 'required|image',
            'gallery' => 'array',
            'gallery.*' => 'required|image',
            'published' => 'boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['cover'] = 'required|'.$rules['cover'];
        }

        return $rules;
    }
}
