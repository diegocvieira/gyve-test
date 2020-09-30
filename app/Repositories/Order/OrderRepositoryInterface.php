<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function create($data);

    public function allPaginatedByUser($userId, $pages);

    public function findByIdAndUser($orderId, $userId);

    public function updateState($orderId, $userId, $orderState);

    public function searchWithFiltersPaginated($request, $pages);
}
