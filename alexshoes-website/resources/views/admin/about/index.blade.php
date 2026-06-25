@extends('admin.layouts.main')

@section('title','About Us')

@section('content')
@include('admin.partials.alerts')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">About Us</h3>
    <div class="card-tools">
      <a href="{{ route('about.edit', $about->id) }}" class="btn btn-sm btn-primary">Edit</a>
    </div>
  </div>
  <div class="card-body">
    {!! nl2br(e($about->description)) !!}
  </div>
</div>
@endsection
