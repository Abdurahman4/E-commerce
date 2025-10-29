@extends('layouts.app')

@section('content')
<style>
.edit-wrapper {
    max-width: 700px;
    margin: 50px auto;
    background: blueviolet;
    border-radius: 15px;
    padding: 27px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.edit-title {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}
.form-label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}
.form-control {
    border-radius: 10px;
    padding: 12px;
}
.btn-update {
    background: linear-gradient(45deg, #6675e7, #764ba2);
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 1rem;
    border-radius: 12px;
    width: 100%;
    transition: 0.3s;
}
.btn-update:hover {
    background: linear-gradient(45deg, #764ba2, #6675e7);
}
.current-img {
    border-radius: 12px;
    margin-top: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>

<div class="edit-wrapper">
    <h1 class="edit-title">✏️ Edit Product</h1>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input name="name" value="{{ old('name', $product->name) }}" 
                   class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price ($)</label>
            <input name="price" value="{{ old('price', $product->price) }}" 
                   class="form-control" type="number" step="0.01" placeholder="Enter price" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input name="stock" value="{{ old('stock', $product->stock) }}" 
                   class="form-control" type="number" placeholder="Enter stock quantity">
        </div>

        

        @if($product->image)
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="{{ asset('storage/'.$product->image) }}" width="160" class="current-img" alt="">
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Upload New Image</label>
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Uploading a new image will replace the old one</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Basic Description</label>
            <textarea name="description" class="form-control" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Extra Details</label>
            <textarea name="extra_details" class="form-control" placeholder="Enter extra details">{{ old('extra_details', $product->extra_details) }}</textarea>
        </div>
        

        <button class="btn-update" type="submit">💾 Update Product</button>
    </form>
</div>
@endsection
