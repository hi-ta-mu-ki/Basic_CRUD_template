<?php

namespace App\Repositories;

use App\Models\User;

class User_Repository implements User_RepositoryInterface
{
    public function all()
    {
        return User::orderBy('id', 'asc');
    }

    public function search($keyword)
    {
        return User::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc');
    }

    public function create(array $item)
    {
        return User::create($item);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, array $item)
    {
        return User::whereId($id)->update($item);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}