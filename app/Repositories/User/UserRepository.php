<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create($data)
    {
        return User::create($data);
    }

    public function update($userId, $data)
    {
        return $this->findById($userId)->update($data);
    }

    public function allPaginated($pages)
    {
        return User::orderByDesc('created_at')
            ->paginate($pages);
    }

    public function findById($userId)
    {
        return User::findOrFail($userId);
    }

    public function searchPaginated($request, $pages)
    {
        return User::filterType($request->type)
            ->filterKeyword($request->keyword)
            ->paginate($pages);
    }

    public function destroy($userId)
    {
        return User::destroy($userId);
    }
}
