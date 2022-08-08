<?php

namespace App\Services;

use App\Repositories\A_master_RepositoryInterface;

class A_master_Service implements A_master_ServiceInterface
{
    private $a_master_repository;

    public function __construct(
        A_master_RepositoryInterface $a_master_repository
    ) {
        $this->a_master_repository = $a_master_repository;
    }

    public function list($keyword)
    {
      if (empty($keyword))
        return $this->a_master_repository->all();
      else
        return $this->a_master_repository->search($keyword);
    }

    public function create($item)
    {
      return $this->a_master_repository->create($item);
    }

    public function show($id)
    {
      return $this->a_master_repository->show($id);
    }

    public function update($id, $item)
    {
      return $this->a_master_repository->update($id, $item);
    }

    public function delete($id)
    {
      return $this->a_master_repository->delete($id);
    }

}
