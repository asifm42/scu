<?php
namespace Scu\Forms;

class TeamForm extends FormValidator {

    protected $rules = [
        'name'     => 'required|max:255',
        'description'  => 'required'
    ];

    protected $messages = [];
}