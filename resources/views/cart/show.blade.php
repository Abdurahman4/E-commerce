@extends('layouts.app')

@section('content')

<link href="css/cart/show.css" rel="stylesheet">

<div style="max-width:800px; margin:auto; padding:20px;">
    <h2>Your Cart 🛒</h2>

    @php
        $userId = auth()->id();
        $cart = session("cart_user_$userId", []);
        $total = 0;
        $totalItems = 0;
    @endphp

    @if(count($cart) > 0)
        @foreach($cart as $id => $item)
            <div style="border-bottom:1px solid #ccc; padding:10px 0; display:flex; justify-content:space-between;">
                <span>{{ $item['name'] }} x {{ $item['qty'] }}</span>
                <span>${{ $item['price'] * $item['qty'] }}</span>
                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">🗑️</button>
                </form>
            </div>
            @php
                $total += $item['price'] * $item['qty'];
                $totalItems += $item['qty'];
            @endphp
        @endforeach

        <h3 style="margin-top:15px;">Total ({{ $totalItems }} items): ${{ $total }}</h3>

        <form action="{{ route('order.checkout') }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" style="padding:10px 20px; background:green;
             color:white; border:none; border-radius:8px; cursor: pointer;
             background: linear-gradient(135deg, #38f9d7, #43e97b); 
             transform: scale(1.05);
             box-shadow: 0 6px 18px rgba(0,0,0,0.25);">
                ✅ Checkout
            </button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif

 <!-- ✅ الطلبات السابقة -->
<div class="order-section" style="margin-top:30px;">
    <h2>📦 Your Orders</h2>

    @auth
        @if (Auth::user()->orders->count() > 0)
            @foreach(Auth::user()->orders as $order)
                <div class="order-card">
                    <h3>Order #{{ $order->id }} - ${{ $order->total_price }} - {{ ucfirst($order->status) }}</h3>
                    <ul>
                        @foreach($order->items as $item)
                            <li>
                                {{ $item->product->name }} x {{ $item->quantity }}
                                = ${{ $item->product->price * $item->quantity }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @else
            <!-- ✅ هذا يظهر فقط إذا المستخدم مسجل دخول وليس لديه طلبات -->
            <div class="no-orders">
                <div class="no-orders-icon">📭</div>
                <h3>There are no orders</h3>
                <p>You haven't placed any orders yet. Start shopping to discover our amazing products</p>
                <a href="/shop" class="btn">Home</a>
            </div>
        @endif
    @else
        <!-- ✅ هذا يظهر إذا المستخدم غير مسجل دخول -->
        <div class="no-orders">
            <div class="no-orders-icon">🔒</div>
            <h3>Please log in</h3>
            <p>Please log in to view your orders</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
    @endauth
</div>
@endsection
