<?php

namespace App\Services;

use App\Repositories\User_RepositoryInterface;
use Illuminate\Support\Facades\Hash;

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

    public function create($item)
    {
      $item['password'] = Hash::make($item['password_raw']);
      if ($item['role'] < 6)
        $item['password_raw'] = "";
      return $this->user_repository->create($item);
    }

    public function update($id, $item)
    {
      $item['password'] = Hash::make($item['password_raw']);
      if ($item['role'] < 6)
        $item['password_raw'] = "";
      return $this->user_repository->update($id, $item);
    }

    public function delete($id)
    {
      return $this->user_repository->delete($id);
    }

}
