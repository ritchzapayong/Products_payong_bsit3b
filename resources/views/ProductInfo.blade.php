@extends('layout')

@section('title', 'Product Information')

@section('content')
  <h1 class="text-center mb-4">Product Information</h1>

  <!-- Add Product Form -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form class="row g-3" method="POST" action="{{ route('products.add') }}">
        @csrf
        <div class="col-md-6">
          <label class="form-label">Product ID</label>
          <input type="text" name="id" class="form-control" placeholder="Enter Product ID" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Product Name</label>
          <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Product Category</label>
          <input type="text" name="category" class="form-control" placeholder="Enter Category" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Product Quantity</label>
          <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Product Price</label>
          <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter Price" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary me-2">Add Product</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Table for Product List -->
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">Product List</h5>
        <!-- Search Form -->
        <form class="d-flex" method="GET" action="{{ route('products.search') }}">
          <input class="form-control me-2" type="search" name="keyword" placeholder="Search product name...">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>ID</th><th>Name</th><th>Category</th><th>Quantity</th><th>Price</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $index => $p)
              <tr>
                <td>{{ $p['id'] }}</td>
                <td>{{ $p['name'] }}</td>
                <td>{{ $p['category'] }}</td>
                <td>{{ $p['quantity'] }}</td>
                <td>{{ $p['price'] }}</td>
                <td>
                  <a href="{{ route('products.edit', $index) }}" class="btn btn-sm btn-warning">Edit</a>
                  <a href="{{ route('products.delete', $index) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center">No products available</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection