<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
	public function transform(ProjectFile $projectfile)
	{
		return [
			'id' => $projectfile->id,
			'project_id' => $projectfile->project_id,
			'name' => $projectfile->name,
			'description' => $projectfile->description,
			'extension' => $projectfile->extension
		];
	}
}