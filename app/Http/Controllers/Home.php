<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;

class Home extends Controller
{
    public function index()
    {
        $data = User::join("orders", 'orders.user_id', '=', 'users.id')
        ->orderByDesc('users.id')
        ->get(['orders.id AS o_id', 'name', 'product', 'email', 'qty', 'price', 'orders.hash AS hash_order']);
        
        return view('products', ['data' => $data]);
    }
}
