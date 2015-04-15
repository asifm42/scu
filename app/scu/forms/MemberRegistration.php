<?php
namespace Scu\Forms;

class MemberRegistration extends FormValidator {

	protected $rules = [
        'name'             => 'required|max:255',
        'nickname'         => 'required|max:255',
		'email'            => 'required|email',
		'password'         => 'required|same:confirm_password',
		'confirm_password' => 'required'
	];

	protected $messages = [
		'password.same' => 'The password and confirm password must match.'
	];

}
