@extends('admin.layouts.main')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Testimonial</h3>
        </div>

        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Nama pelanggan --}}
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="name" class="form-control" required
                        value="{{ old('name', $testimonial->name) }}">
                </div>

                {{-- Pesan / Comment --}}
                <div class="form-group">
                    <label>Pesan / Testimonial</label>
                    <textarea name="comment" class="form-control" rows="4"
                        required>{{ old('comment', $testimonial->comment) }}</textarea>
                </div>

                {{-- Rating --}}
                <div class="form-group">
                    <label>Rating</label>
                    <select name="rating" class="form-control" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>
                                {{ $i }} ★
                            </option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
@endsection