<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{

	protected $rules = [
		'project' => 'required|integer',
		'title' => 'required',
		'note' => 'required'
	];
}