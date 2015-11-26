<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        if (method_exists($this, 'overrideInputs')) {
            $this->overrideInputs();
        }

        return parent::getValidatorInstance();
    }
}
