@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Roles</h1>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
@endif

{{-- {{ $roles->count() }} --}}
<table class="table table-hover table-bordered table-striped">
    <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    @forelse ($roles as $role)
    <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>{{ $role->created_at->format('d F, Y - h:m:s A') }}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit', $role->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <form class="d-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center">No Data Available</td>
    </tr>
    @endforelse


</table>

@stop
