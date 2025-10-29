@extends('layouts.app')

@section('content')

<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"> 

<div class="products-container">
    <div class="products-card">
        <h1 class="products-title">📦 Products</h1>
        
        <a href="{{ route('admin.products.create') }}" class="add-product-btn"> Add product ➕ </a>

        <table class="products-table">
            <thead>
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>stock</th>
                    <th>procedures</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" class="product-image">
                        @else
                            <span class="text-muted">there is no image</span>
                        @endif
                    </td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->price }} $</td>
                    <td>
                        @if($p->stock > 0)
                            <span style="color:green; font-weight:bold">{{ $p->stock }}</span>
                        @else
                            <span style="color:red; font-weight:bold">Out of stock</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p->id) }}" class="action-btn edit-btn"> Edit ✏️</a>
                        
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete')" class="action-btn delete-btn"> Delete 🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align:center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
