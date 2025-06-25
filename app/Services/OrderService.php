<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;


class OrderService{
    public function createOrder(array $customer, array $cart, float $totalAmount, string $transaction_id){
        return DB::transaction( function() use ($customer,$cart,$totalAmount,$transaction_id){
            $order = Order::create([
                'transaction_id' => $transaction_id,
                'customer_name' => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'address' => $customer['address'],
                'opt_address' => $customer['address2'],
                'state' => $customer['state'],
                'zip' => $customer['zip'],
                'amount' => $totalAmount,
                'currency' => 'BDT',
                'status' => 'Pending',
            ]);

            foreach($cart as $item){
                $order->items()->create([
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'discount' => $item['discount'],
                    'image' => $item['image'],
                ]);
            }

            
        $payment = Payment::create([
            'order_id' => $order->id,
            'gateway' => 'cod',
            'transaction_id' => $transaction_id,
            'status' => 'Pending',
        ]);
             return $order;
        });
    }
}