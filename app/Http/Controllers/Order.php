<?php

namespace App\Http\Controllers;

use App\Models\Order as ModelsOrder;
use App\Models\User;
use Illuminate\Http\Request;

class Order extends Controller
{
    /**
     * View Create Order
     *
     * @return void
     */
    public function index()
    {
        return view('create-order');
    }

    public function deleteOrder(Request $request)
    {
        $data = new \stdClass();

        if(strlen($request->hash) < 32 || strlen($request->hash) > 32) {
        
            $data->error = true;
            echo json_encode($data);
            return;
        }

        ModelsOrder::where('products.orders.hash', '=', $request->hash)->delete();
        User::where('products.users.hash', '=', $request->hash)->delete();

        $data->delete = true;
        echo json_encode($data);
        return;
    }

    /**
     * Método para atualizar os pedidos
     *
     * @param Request $request
     * @return void
     */
    public function updateOrder(Request $request)
    {
        if($request->has(['name', 'email', 'product_name', 'qty', 'price'])) {

            if(!preg_match("/^[\w\.\-\d\_]+@[a-z\d\.\-\_]+(\.com|\.com\.[a-z]{2,4})$/", $request->email)) {
                return redirect('/')->with('warning_msg', 'formato de email invalido');
            }
    
            if(!preg_match("/^\d+$/", $request->qty)) {
                return redirect('/')->with('warning_msg', 'campo quantidade aceita apenas números');
            }
    
            if(!preg_match("/^[\d.]+$/", $request->price)) {
                return redirect('/')->with('warning_msg', 'campo preço aceita apenas números e pontos (.)');
            }
               
            $user = User::where('email', '=', $request->email)->firstOrFail();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
    
            $order = ModelsOrder::where('orders.hash', '=', $request->hash)->firstOrFail();
            $order->product = $request->product_name;
            $order->qty = $request->qty;
            $order->price = $request->price;
            $order->save();
    
            return redirect('/')->with('success_msg', 'pedido atualizado com sucesso');
        }
    }

    /**
     * View Update Order
     *
     * @param Request $request
     * @return void
     */
    public function viewOrder(Request $request)
    {
        $data = User::join('orders', 'users.id', '=', 'orders.user_id')
        ->where('orders.hash', '=', $request->hash)->firstOrFail(['name', 'email', 'product', 'qty', 'price', 'orders.hash AS hash_order']);
        
        return view('update-order', ['data' => $data]);
    }

    /**
     * Post Create Order
     *
     * @param Request $request
     * @return void
     */
    public function postOrder(Request $request)
    {
        if($request->has(['name', 'email', 'product_name', 'qty', 'price'])) {

            $user = new User();
            $email_data = $user->where('email', '=', $request->email)->first();

            if(!empty($email_data)) {
                return redirect('/')->with('warning_msg', 'este email já existe');
            }

            if(!preg_match("/^[\w\.\-\d\_]+@[a-z\d\.\-\_]+(\.com|\.com\.[a-z]{2,4})$/", $request->email)) {
                return redirect('/')->with('warning_msg', 'formato de email invalido');
            }

            if(!preg_match("/^\d+$/", $request->qty)) {
                return redirect('/')->with('warning_msg', 'campo quantidade aceita apenas números');
            }

            if(!preg_match("/^[\d.]+$/", $request->price)) {
                return redirect('/')->with('warning_msg', 'campo preço aceita apenas números e pontos (.)');
            }

            $hash = md5(rand(0, 1000) . $user->id . $request->product_name);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->hash = $hash;
            $user->save();

            $order = new ModelsOrder();
            $order->user_id = $user->id;
            $order->product = $request->product_name;
            $order->qty = $request->qty;
            $order->price = $request->price;
            $order->hash = $hash;
            $order->save();

            return redirect('/')->with('success_msg', 'pedido cadastrado com sucesso');
        }
    }
}
