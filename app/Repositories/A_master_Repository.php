<?php

namespace App\Repositories;

use App\Models\A_master;

class A_master_Repository implements A_master_RepositoryInterface
{
    public function all()
    {
        return A_master::orderBy('id', 'asc');
    }

    public function search($keyword)
    {
        return A_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc');
    }

    public function create(array $item)
    {
        return A_master::create($item);
    }

    public function show($id)
    {
        return A_master::findOrFail($id);
    }

    public function update($id, array $item)
    {
        return A_master::whereId($id)->update($item);
    }

    public function delete($id)
    {
        return A_master::destroy($id);
    }
}