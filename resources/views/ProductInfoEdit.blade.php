@extends('layout')

@section('title', 'Edit Product')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Edit Product Information</h4>
        </div>
        <div class="card-body">
          <form class="row g-3" method="POST" action="{{ route('products.update', $index) }}">
            @csrf
            <div class="col-md-6">
              <label class="form-label">Product ID</label>
              <input type="text" class="form-control" value="{{ $product['id'] }}" readonly>
              <small class="text-muted">Product ID cannot be changed</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Product Name</label>
              <input type="text" name="name" class="form-control" value="{{ $product['name'] }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Product Category</label>
              <input type="text" name="category" class="form-control" value="{{ $product['category'] }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Quantity</label>
              <input type="number" name="quantity" class="form-control" value="{{ $product['quantity'] }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Price</label>
              <input type="number" step="0.01" name="price" class="form-control" value="{{ $product['price'] }}">
            </div>
            <div class="col-12 d-flex justify-content-end">
              <a href="{{ route('products.masterlist') }}" class="btn btn-secondary me-2">Cancel</a>
              <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection