<?php
namespace Scu\Forms;

class VerificationCodeReset extends FormValidator {

    protected $rules = [
        'email'     => 'required|max:255|email'
    ];

    protected $messages = [];
}