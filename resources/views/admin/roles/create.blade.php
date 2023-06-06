@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Role</h1>

<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" name="name">
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Permissions</label> <br>
        <label><input type="checkbox" id="check_all"> Check All</label>
        <ul style="column-count: 2" class="list-unstyled">
            @foreach ($permissions as $p)
                <li>
                    <label><input name="permissions[]" type="checkbox" value="{{ $p->id }}"/> {{ $p->name }}</label>
                </li>
            @endforeach

        </ul>
    </div>
    <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
</form>

@stop

@section('scripts')

<script>

    // $('#check_all').on('change', function() {
    $('#check_all').change(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    })

</script>

@stop
