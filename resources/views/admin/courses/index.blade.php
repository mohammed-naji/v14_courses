@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Courses</h1>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
@endif

{{-- {{ $courses->count() }} --}}
<table class="table table-hover table-bordered table-striped">
    <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    @forelse ($courses as $course)
    <tr>
        <td>{{ $course->id }}</td>
        <td><img src="{{ asset('uploads/'.$course->image) }}" width="80" alt=""></td>
        <td>{{ $course->title }}</td>
        <td>{{ $course->created_at->format('d F, Y - h:m:s A') }}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('admin.courses.edit', $course->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <form class="d-inline" action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">No Data Available</td>
    </tr>
    @endforelse


</table>

@stop
