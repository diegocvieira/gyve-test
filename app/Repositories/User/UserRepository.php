<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $user;
    }

    public function update($userId, $data)
    {
        $user = $this->findById($userId);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
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
