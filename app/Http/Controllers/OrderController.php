<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = auth()->id();
        $cart = session("cart_user_$userId", []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        // إنشاء Order جديد
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart)),
            'status' => 'pending',
        ]);

        // إضافة عناصر الطلب
            foreach ($cart as $productId => $item) {
                $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }
        foreach ($order->items as $item) {
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }
        

        // مسح السلة بعد الشراء
        session()->forget("cart_user_$userId");

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
