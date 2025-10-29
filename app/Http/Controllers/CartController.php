<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(){
        $userId = auth()-> id();
        $cart = session('cart_user_$userId',[]);
        $total = 0;
        $totalItems = 0;

        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
            $totalItems += $item['qty'];
        }
        return view('cart.show', compact('cart', 'total', 'totalItems'));
    }
}
