<?php

namespace App\Services;

use App\Repositories\B_master_RepositoryInterface;

class B_master_Service implements B_master_ServiceInterface
{
    private $b_master_repository;

    public function __construct(
        B_master_RepositoryInterface $b_master_repository
    ) {
        $this->b_master_repository = $b_master_repository;
    }

    public function list($keyword)
    {
      if (empty($keyword))
        return $this->b_master_repository->all();
      else
        return $this->b_master_repository->search($keyword);
    }

    public function create($item)
    {
      return $this->b_master_repository->create($item);
    }

    public function latest()
    {
      return $this->b_master_repository->latest();
    }

    public function show($id)
    {
      return $this->b_master_repository->show($id);
    }

    public function update($id, $item)
    {
      return $this->b_master_repository->update($id, $item);
    }

    public function delete($id)
    {
      return $this->b_master_repository->delete($id);
    }

}
