@extends('admin.layouts.main')

@section('title', 'Tambah Testimonial')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Testimonial</h3>
        </div>

        <form action="{{ route('testimonials.store') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Pesan / Testimonial</label>
                    <textarea name="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="">-- Pilih Rating --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} ★</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection