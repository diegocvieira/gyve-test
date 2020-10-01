<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface;
use Auth;

class HomeController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $pages = 10;

        $orders = $this->orderRepository->allPaginated($userId, $pages);

        return view('home', compact('orders'));
    }
}
