<?php

namespace App\Repositories\Order;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function create($data)
    {
        return Order::create($data);
    }

    public function allPaginated($userId, $pages)
    {
        return Order::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($pages);
    }

    public function updateState($orderId, $userId, $orderState)
    {
        return Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->update([
                'state' => $orderState
            ]);
    }

    public function findByIdAndUser($orderId, $userId)
    {
        return Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->first();
    }

    public function searchPaginated($request, $pages)
    {
        return Order::filterState($request->state)
            ->filterControlNumber($request->control_number)
            ->paginate($pages);
    }
}
