@extends('layouts.app')

@section('content')

<style>
.ADD {
  max-width: 900px;
  margin: 60px auto;
  background: #6a5acd; 
  border-radius: 20px;
  padding: 40px; 
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.Add-title {
  font-size: 2.5rem; 
  font-weight: bold;
  text-align: center;
  margin-bottom: 30px;
  color: white;
}

.form-control {
  font-size: 1.2rem;
  padding: 15px; 
  margin-bottom: 15px;
  border-radius: 10px;
  border: 1px solid #ccc;
}

.btn-success {
  font-size: 1.3rem;
  padding: 15px 25px;
  border-radius: 12px;
}
</style>

<div class="ADD">
  <h1 class="Add-title">Add product</h1>
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="mb-2">
      <input name="name" value="{{ old('name') }}" class="form-control" placeholder="product name" required>
    </div>
    <div class="mb-2">
      <input name="price" value="{{ old('price') }}" class="form-control" type="number" step="0.01" placeholder="price" required>
    </div>
    <div class="mb-2">
      <input name="stock" value="{{ old('stock') }}" class="form-control" type="number" placeholder="stock">
    </div>
    <div class="mb-2">
      <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-2">
      <textarea name="description" class="form-control" placeholder="Basic description">{{ old('description') }}</textarea>
    </div>
    
    <div class="mb-2">
      <textarea name="extra_details" class="form-control" placeholder="Extra details">{{ old('extra_details') }}</textarea>
    </div>
    
    <button class="btn btn-success" type="submit">save</button>
  </form>
</div>
@endsection
