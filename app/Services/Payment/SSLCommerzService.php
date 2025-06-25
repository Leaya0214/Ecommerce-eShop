<?php
namespace App\Services\Payment;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class SSLCommerzService
{
    public function initiatePayment(Order $order)
    {
        $post_data = [];

        $post_data['total_amount'] = $order->amount;
        $post_data['currency'] = $order->currency;
        $post_data['tran_id'] = $order->transaction_id;

        $post_data['cus_name'] = $order->customer_name;
        $post_data['cus_email'] = $order->email;
        $post_data['cus_add1'] = $order->address;
        $post_data['cus_add2'] = $order->opt_address;
        $post_data['cus_city'] = $order->state;
        $post_data['cus_postcode'] = $order->zip;
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = $order->phone;

        $post_data['success_url'] = route('success');
        $post_data['fail_url'] = route('fail');
        // $post_data['cancel_url'] = route('cancel');
        $total_order = OrderItem::where('order_id', $order->id)->count();

        $post_data['shipping_method'] = "Home Delivery";
        $post_data['num_of_item'] = $total_order;
        $post_data['ship_name'] = "Home Delivery";
        $post_data['ship_add1'] = $order->address;
        $post_data['ship_city'] = $order->state;
        $post_data['ship_postcode'] = $order->zip;
        $post_data['ship_country'] = 'Bangladesh';
        $post_data['product_name'] = "E-Commerce Products";
        $post_data['product_category'] = "General";
        $post_data['product_profile'] = "physical-goods";
        $post_data['product_amount'] = $order->amount;

        $sslc = new SslCommerzNotification();

        return $sslc->makePayment($post_data, 'hosted');
    }
}
