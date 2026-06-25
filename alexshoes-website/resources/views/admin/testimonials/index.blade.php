@extends('admin.layouts.main')
@section('title', 'Testimonials')

@section('content')
  @include('admin.partials.alerts')

  <div class="mb-3">
    <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
  </div>

  <div class="card">
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Message</th>
            <th>Rating</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($testimonials as $t)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $t->name }}</td>
              <td>{{ $t->comment }}</td>
              <td>{{ $t->rating }} ★</td>

              <td>
                <a href="{{ route('testimonials.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('testimonials.destroy', $t->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this testimonial?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>

      <div class="mt-3">
        {{ $testimonials->links() }}
      </div>
    </div>
  </div>

@endsection