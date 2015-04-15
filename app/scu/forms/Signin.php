<?php
namespace Scu\Forms;

class Signin extends FormValidator {

	protected $rules = [
		'email'     => 'required|max:255',
		'password'  => 'required'
	];

	protected $messages = [];

}
