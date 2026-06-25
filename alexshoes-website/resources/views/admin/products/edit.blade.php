@extends('admin.layouts.main')
@section('title', 'Edit Product')

@section('content')
  @include('admin.partials.alerts')

  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-body">

        <div class="form-group mb-2">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group mb-2">
          <label>Description</label>
          <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Detail Benefits</label>
          <textarea name="detail_benefits" class="form-control" rows="5">{{ old('detail_benefits', $product->detail_benefits) }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Detail Process</label>
          <textarea name="detail_process" class="form-control" rows="5">{{ old('detail_process', $product->detail_process) }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Price (Rp)</label>
          <input type="number" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
        </div>

        <div class="form-group mb-2">
          <label>Current Image</label><br>
          @if($product->image)
            <img src="{{ asset($product->image) }}" style="height:120px;object-fit:cover;">
          @else
            <p class="text-muted">No image uploaded.</p>
          @endif
        </div>

        <div class="form-group mb-2">
          <label>Replace Image</label>
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>
      </div>

      <div class="card-footer text-right">
        <button class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
      </div>
    </div>

  </form>
@endsection
