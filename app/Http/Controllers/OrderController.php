<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface;
use Auth;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function store()
    {
        $data = [
            'user_id' => Auth::user()->id,
            'control_number' => round(microtime(true)),
            'state' => 1
        ];

        try {
            $this->orderRepository->create($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }

        return redirect()->back()->withSuccess('Order successfully created');
    }

    public function updateState(Request $request)
    {
        $orderId = $request->order_id;
        $userId = Auth::user()->id;
        $orderState = $request->state;

        try {
            $order = $this->orderRepository->findByIdAndUser($orderId, $userId);

            if (!$order || !$order->nextStateIsValid($orderState)) {
                return redirect()->back()->withErrors('State not changed');
            }

            $this->orderRepository->updateState($orderId, $userId, $orderState);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }

        return redirect()->back()->withSuccess('State successfully changed');
    }

    public function search(Request $request)
    {
        $controlNumber = $request->control_number;
        $state = $request->state;
        $pages = 10;

        $orders = $this->orderRepository->searchPaginated($request, $pages);

        return view('home', compact('orders', 'state', 'controlNumber'));
    }
}
