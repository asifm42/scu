<?php
namespace Scu\Forms;

class MemberEdit extends FormValidator {

    protected $rules = [
        'name'  => 'required|max:255'
    ];
}