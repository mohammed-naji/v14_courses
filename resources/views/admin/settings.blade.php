@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Site Settings</h1>

<form action="{{ route('admin.settings_data') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control" />
    <img width="80" src="{{ asset('uploads/'.settings('logo')) }}" alt="">
</div>
<div class="mb-3">
    <label>Facebook</label>
    <input type="text" name="fb" value="{{ settings('fb') }}" class="form-control" />
</div>
<div class="mb-3">
    <label>Twitter</label>
    <input type="text" name="tw" value="{{ settings('tw') }}" class="form-control" />
</div>
<div class="mb-3">
    <label>Linkedin</label>
    <input type="text" name="li" value="{{ settings('li') }}" class="form-control" />
</div>
<div class="mb-3">
    <label>Youtube</label>
    <input type="text" name="yt" value="{{ settings('yt') }}" class="form-control" />
</div>
<button class="btn btn-success px-5"> <i class="fas fa-save"></i> Save</button>
</form>

@stop
