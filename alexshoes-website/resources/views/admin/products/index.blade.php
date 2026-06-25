@extends('admin.layouts.main')
@section('title', 'Products')

@section('content')
  @include('admin.partials.alerts')

  <div class="mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
  </div>

  <div class="row">
    @foreach($products as $product)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          @if($product->image)
            <img src="{{ asset($product->image) }}" class="card-img-top" style="height:200px;object-fit:cover;">
          @endif

          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
            <p class="font-weight-bold">{{ rupiah($product->price) }}</p>

            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Delete this product?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-3">
    {{ $products->links() }}
  </div>
@endsection