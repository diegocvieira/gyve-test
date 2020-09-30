<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface;
use Session;
use Auth;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create()
    {
        return view('order.create');
    }

    public function store()
    {
        $userId = Auth::user()->id;
        $state = 1;
        $controlNumber = round(microtime(true));

        $data = [
            'user_id' => $userId,
            'control_number' => $controlNumber,
            'state' => $state
        ];

        try {
            $this->orderRepository->create($data);

            Session::flash('error_message', 'Order successfully created');
        } catch (\Throwable $th) {
            Session::flash('error_message', $th->getMessage());
        }

        return redirect()->route('home');
    }

    public function updateState(Request $request)
    {
        $orderId = $request->order_id;
        $userId = Auth::user()->id;
        $orderState = $request->state;

        try {
            $order = $this->orderRepository->findByIdAndUser($orderId, $userId);

            if (!$order || !$order->nextStateIsValid($orderState)) {
                Session::flash('error_message', 'State not changed');
                return redirect()->route('home');
            }

            $this->orderRepository->updateState($orderId, $userId, $orderState);

            Session::flash('error_message', 'State successfully changed');
        } catch (\Throwable $th) {
            Session::flash('error_message', $th->getMessage());
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $controlNumber = $request->control_number;
        $state = $request->state;
        $pages = 10;

        $orders = $this->orderRepository->searchWithFiltersPaginated($request, $pages);

        return view('home', compact('orders', 'state', 'controlNumber'));
    }
}
