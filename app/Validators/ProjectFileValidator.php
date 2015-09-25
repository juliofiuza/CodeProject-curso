<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

	protected $rules = [
		'name' => 'required',
		'file' => 'required|mimes:jpeg,jpg,png,gif,png,zip',
		'description' => 'required'
	];
}