@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href=" {{asset ('css/index.css') }}"rel= "stylesheet" >
<div class="topbar">
    <div class="welcome-text">
        Hello <strong>
            @auth 
            {{ Auth::user()->name }}
            @else 
            Guest
            @endauth
        </strong> 👋 <br>
        <small>we wish you a wonderful shopping experience</small>
    </div>
    
    <div class="center-content">
        <button id="welcomeBtn" class="greeting-btn">
            Click for greeting 👋
        </button>
    </div>
    
    <div class="actions">
        <!-- زر السلة -->
        <a href="{{ route('cart.show') }}" class="cart-btn">
            Cart 🛒 
        </a>

        <!-- زر تسجيل الخروج -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout">Log out 🔴</button>
        </form>
    </div>
</div>


<!-- ✅ المنتجات -->
<div class="shop-wrapper">
    <div class="shop-container">
        @foreach($products as $product)
        <div class="product-card">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/250x180?text=No+Image" alt="No image">
            @endif
            
            <h3 style="margin-bottom: 25px; "> {{ $product->name }}</h3>
            <div style="text-align:left;">
                <p class="short-desc">
                   {{ $product->description }}
                </p>
            
                @if($product->extra_details)
                    <button class="view-more-btn more" onclick="toggleDetails({{ $product->id }}, this)">
                        view more 📖 
                    </button>
                    <div class="extra-details" id="details-{{ $product->id }}">
                        <p>{{ $product->extra_details }}</p>
                    </div>
                @endif
            </div>

            <p style="color:grey; font-size: 14px; margin-bottom: 15px;"> 
                 Stock: {{ $product->stock }}
            </p>

            <p class="price">{{ $product->price }} $</p>
            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <input type="number" 
                name="qty" 
                value="1"
                min="1"
                max="{{ $product->stock }}" 
                style="width:50px;">
                <button type="submit" class="add-to-cart-btn">
                    🛒 Add to Cart
                </button>
            </form>
            @else
            <button class="add-to-cart-btn" disabled style="background: gray;">Out of Stock</button>
            @endif
        </div>
        @endforeach
    </div>

</div>

<div style="text-align:center; margin-top:20px;">
    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>
<button id = "colorBtn" style="padding: 10px 20px; background: #3490dc; color: white; border: none; border-radius: 5px;">
Change the color 🎨
</button>


<script>
function toggleDetails(productId, button) {
    const details = document.getElementById('details-' + productId);
    const isShowing = details.classList.toggle('show');
    
    button.textContent = isShowing ? 'view less 📖' : 'view more 📖';
    button.className = isShowing ? 'less' : 'more';
}
// 🎉 لما المستخدم يضغط الزر يطلع تنبيه ترحيبي
document.getElementById('welcomeBtn').addEventListener('click',function(){
    this.style.background= '#4CAF50';
    this.style.color = 'red';
    alert('👋 Hello there! Welcome to our perfume shop 🌸');
});
document.getElementById('colorBtn').addEventListener('click',function() {
const colors = ['#f8d7da', '#d4edda', '#fff3cd', '#cce5ff', '#e2e3e5'];
const randomcolor = colors[Math.floor(Math.random() * colors.length)];
document.body.style.background = randomcolor;  

});

</script>
@endsection
