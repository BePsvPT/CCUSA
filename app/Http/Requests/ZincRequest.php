<?php

namespace App\Http\Requests;

use App\Models\Zinc;

class ZincRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'year' => 'required|in:'.implode(',', Zinc::year()),
            'month' => 'required|in:'.implode(',', Zinc::month()).'|unique:zinc,month,NULL,id,year,'.$this->input('year'),
            'topic' => 'required|string|max:255',
            'published' => 'boolean',
            'image' => 'sometimes|required|array',
            'image.*' => 'sometimes|required|image',
        ];

        if ($this->isMethod('PATCH')) {
            $rules['month'] = str_replace('NULL', $this->route('zinc'), $rules['month']);
        }

        return $rules;
    }
}
