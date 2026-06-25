@extends('admin.layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
    <h1>Selamat Datang di Dashboard Admin</h1>
    <p>Ini halaman awal admin Anda.</p>
    <div class="mt-3">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection
