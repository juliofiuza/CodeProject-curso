<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{
	public function transform(ProjectTask $projecttask)
	{
		return [
			'id' => $projecttask->id,
			'name' => $projecttask->name,
			'start_date' => $projecttask->start_date,
			'due_date' => $projecttask->due_date,
			'status' => $projecttask->status,
			'project_id' => $projecttask->project_id,
		];
	}
}