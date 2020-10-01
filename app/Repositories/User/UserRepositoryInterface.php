<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function create($data);

    public function allPaginated($pages);

    public function searchPaginated($request, $pages);

    public function update($userId, $data);

    public function findById($userId);

    public function destroy($userId);
}
