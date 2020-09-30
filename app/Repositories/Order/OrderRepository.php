<?php

namespace App\Repositories\Order;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function create($data)
    {
        Order::create($data);
    }

    public function allPaginatedByUser($userId, $pages)
    {
        $orders = Order::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($pages);

        return $orders;
    }

    public function updateState($orderId, $userId, $orderState)
    {
        $order = Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->update([
                'state' => $orderState
            ]);

        return $order;
    }

    public function findByIdAndUser($orderId, $userId)
    {
        $order = Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->first();

        return $order;
    }

    public function searchWithFiltersPaginated($request, $pages)
    {
        $orders = Order::filterState($request->state)
            ->filterControlNumber($request->control_number)
            ->paginate($pages);

        return $orders;
    }
}
