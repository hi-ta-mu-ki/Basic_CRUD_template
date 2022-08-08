<?php

namespace App\Repositories;

use App\Models\B_master;

class B_master_Repository implements B_master_RepositoryInterface
{
    public function all()
    {
        return B_master::orderBy('id', 'asc');
    }

    public function search($keyword)
    {
        return B_master::where('name', 'like', '%' . $keyword . '%')->orwhere('tel', 'like', '%' . $keyword . '%')->orderBy('id', 'asc');
    }

    public function create(array $item)
    {
        return B_master::create($item);
    }

    public function latest()
    {
        return B_master::latest()->select('id')->first();
    }

    public function show($id)
    {
        return B_master::findOrFail($id);
    }

    public function update($id, array $item)
    {
        return B_master::whereId($id)->update($item);
    }

    public function delete($id)
    {
        return B_master::destroy($id);
    }
}