<?php

namespace App\Http\Requests;

class DocumentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => 'required|string|max:32',
            'group'     => 'required|string|max:32',
            'published' => 'boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['attachment'] = 'required|mimes:pdf';
        }

        return $rules;
    }
}
