@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Course</h1>

<form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.courses.form')

    <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
</form>

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.2/tinymce.min.js" integrity="sha512-sWydClczl0KPyMWlARx1JaxJo2upoMYb9oh5IHwudGfICJ/8qaCyqhNTP5aa9Xx0aCRBwh71eZchgz0a4unoyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    tinymce.init({
        selector: '.custom-editor',
        height: 300,
        plugins: 'code',
        // toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    })
</script>
@stop
