<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display orders
        $orders = Order::with( 'items')->latest()->paginate(10);
        return view('backend.orders.index', compact('orders'));
    }
}
