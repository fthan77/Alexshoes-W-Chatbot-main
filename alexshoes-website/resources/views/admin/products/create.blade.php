@extends('admin.layouts.main')
@section('title', 'Add Product')

@section('content')
  @include('admin.partials.alerts')

  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-body">

        <div class="form-group mb-2">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="form-group mb-2">
          <label>Description</label>
          <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Detail Benefits</label>
          <textarea name="detail_benefits" class="form-control" rows="5">{{ old('detail_benefits') }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Detail Process</label>
          <textarea name="detail_process" class="form-control" rows="5">{{ old('detail_process') }}</textarea>
        </div>

        <div class="form-group mb-2">
          <label>Price (Rp)</label>
          <input type="number" name="price" class="form-control" required value="{{ old('price') }}">
        </div>

        <div class="form-group mb-2">
          <label>Image</label>
          <input type="file" name="image" accept="image/*" class="form-control">
        </div>

      </div>
      <div class="card-footer text-right">
        <button class="btn btn-success">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
      </div>
    </div>
  </form>
@endsection
