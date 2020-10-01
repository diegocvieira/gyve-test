<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function create($data);

    public function allPaginated($userId, $pages);

    public function findByIdAndUser($orderId, $userId);

    public function updateState($orderId, $userId, $orderState);

    public function searchPaginated($request, $pages);
}
