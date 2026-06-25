@extends('admin.layouts.main')
@section('title','Edit About')
@section('content')
@include('admin.partials.alerts')
<form action="{{ route('about.update', $about->id) }}" method="post">
  @csrf
  @method('PUT')
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="8">{{ old('description', $about->description) }}</textarea>
      </div>
    </div>
    <div class="card-footer text-right">
      <button class="btn btn-success">Save</button>
      <a href="{{ route('about.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</form>
@endsection
