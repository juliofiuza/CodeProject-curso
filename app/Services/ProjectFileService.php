<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService
{

    /**
     * @var ProjectRepository
     */
	protected $repository;

    /**
     * @var ProjectRepository
     */
	protected $projectRepository;

    /**
     * @var ProjectValidator
     */
	protected $validator;

    /**
     * @var ProjectValidator
     */
	protected $filesystem;

    /**
     * @var ProjectValidator
     */
	protected $storage;

	public function __construct(ProjectFileRepository $repository,
								ProjectRepository $projectRepository,
								ProjectFileValidator $validator,
								Filesystem $filesystem,
								Storage $storage)
	{
		$this->repository = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator = $validator;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
	}

	public function create(array $data)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			$projectFile = $project->files()->create($data);
			$this->storage->put($projectFile->id.'.'.$data['extension'], $this->filesystem->get($data['file']));
			
			return $projectFile;
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}

	public function update(array $data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data,$id);
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}

	public function delete($id)
	{
		$projectFile = $this->repository->skipPresenter()->find($id);
		if ($this->storage->exists($projectFile->id.'.'.$projectFile->extension)){
			$this->storage->delete($projectFile->id.'.'.$projectFile->extension);
			return $projectFile->delete();
		}
	}

	public function getFilePath($id) {
		$projectFile = $this->repository->skipPresenter()->find($id);
		return $this->getBaseURL($projectFile);
	}

	public function getBaseURL($projectFile)
	{
		switch ($this->storage->getDefaultDriver()) {
			case 'local':
				return $this->storage->getDriver()->getAdapter()->getPathPrefix().'/'.$projectFile->id . '.' . $projectFile->extension;
		}

	}

    private function checkProjectOwner($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectFileId)
    {
        if ($this->checkProjectOwner($projectFileId) or $this->checkProjectMember($projectFileId)) {
            return true;
        }

        return false;
    }

}