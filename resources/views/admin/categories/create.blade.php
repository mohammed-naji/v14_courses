@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Category</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}" name="title">
        @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
        @error('image')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
</form>

@stop
