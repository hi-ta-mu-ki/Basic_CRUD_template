<?php

namespace App\Services;

use App\Repositories\User_RepositoryInterface;
use App\Library\DataFormat;

class User_Service implements User_ServiceInterface
{
    private $user_repository;

    public function __construct(
        User_RepositoryInterface $user_repository
    ) {
        $this->user_repository = $user_repository;
    }

    public function list($keyword)
    {
      if (empty($keyword))
        return $this->user_repository->all();
      else
        return $this->user_repository->search($keyword);
    }

    public function show($id)
    {
      return $this->user_repository->show($id);
    }

    public function create($request)
    {
      $item = DataFormat::user_format($request);
      return $this->user_repository->create($item);
    }

    public function update($id, $request)
    {
      $item = DataFormat::user_format($request);
      return $this->user_repository->update($id, $item);
    }

    public function delete($id)
    {
      return $this->user_repository->delete($id);
    }

}
