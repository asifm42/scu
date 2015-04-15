<?php
namespace Scu\Forms;

use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;

abstract class FormValidator {

    protected $validator;

    protected $validation;

    protected $messages = [];

    function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $formData)
    {
        $this->validation = $this->validator->make($formData, $this->getValidationRules(), $this->getCustomMessages());

        if ($this->validation->fails())
        {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        return true;
    }

    protected function getValidationRules()
    {
        return $this->rules;
    }

    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }

    protected function getCustomMessages()
    {
        return $this->messages;
    }
}