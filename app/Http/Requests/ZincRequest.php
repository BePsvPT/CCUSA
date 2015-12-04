<?php

namespace App\Http\Requests;

use App\Ccusa\Zinc;
use App\Http\Requests\Request;

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
            'year' => 'required|in:' . implode(',', Zinc::year()),
            'month' => 'required|in:' . implode(',', Zinc::month()) . '|unique:zinc,month,NULL,id,year,' . $this->input('year'),
            'topic' => 'required|string|max:255',
            'published' => 'boolean',
            'image' => 'array'
        ];

        foreach ($this->file('image', []) as $key => $value) {
            $rules["image.{$key}"] = 'required|image';
        }

        if ($this->isMethod('PATCH')) {
            $rules['month'] = str_replace('NULL', $this->route('manage'), $rules['month']);
        }

        return $rules;
    }
}
