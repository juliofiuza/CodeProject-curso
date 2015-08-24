<?php

namespace CodeProject\Services;

use CodeProject\Repository\ClientRepository;

class CLientService
{
	protected $repository;

	public function __construct(ClientRepository $repository)
	{
		$this->repository = $repository;
	}

	public function create(array $data)
	{
		return $this->repository->create($data);
	}

	public function update(array $data, $id)
	{
		return $this->repository->update($data, $id);
	}
}