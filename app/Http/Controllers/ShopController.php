<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class ShopController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        return view('shop.index',compact('products'));
    }
   
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = (int) $request->input('qty', 1);
    
        
        if ($qty > $product->stock) {
            return redirect()->back()->with('error', 'The required quantity is not available in stock!❌');
        }
    
        $userId = auth()->id();
        $cart = Session::get("cart_user_$userId", []);
    
        if(isset($cart[$id])) {
            $newQty = $cart[$id]['qty'] + $qty;
    
            if ($newQty > $product->stock) {
                return redirect()->back()->with('error', 'Available quantity exceeded!❌');
            }
    
            $cart[$id]['qty'] = $newQty;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty
            ];
        }
    
        Session::put("cart_user_$userId", $cart);
    
        return redirect()->back()->with('success', 'The product has been added to the cart✅');
    }
    

public function removeFromCart($id)
{
    $userId = auth()->id();
    $cart = Session::get("cart_user_$userId", []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        Session::put("cart_user_$userId", $cart);
    }

    return redirect()->back()->with('success', 'the product has been removed from cart🗑️');
}

}
