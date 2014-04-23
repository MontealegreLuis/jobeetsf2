<?php
namespace Jobeet\JobBoard;

use Jobeet\JobeetBundle\Repository\JobRepository;

class ListLatestActiveJobs
{
	protected $repository;

	public function __construct(JobRepository $repository)
	{
		$this->repository = $repository;
	}

	public function getLatestActiveJobs()
	{
		return $this->repository->findLatestActiveJobs();
	}
}