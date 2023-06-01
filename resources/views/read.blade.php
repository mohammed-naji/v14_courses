<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <h1>All Notifications ( {{ Auth::user()->unreadnotifications->count() }} )</h1>
        <a href="{{ url('/read-all') }}">Read All</a>
        <div class="list-group">
            {{-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
              The current link item
            </a> --}}
            @foreach (Auth::user()->notifications as $item)
            <a href="{{ url('read/'.$item->id) }}" class="list-group-item list-group-item-action {{ $item->read_at ? '' : 'active' }} ">{{ $item->data['msg'] }}</a>
            @endforeach

          </div>
    </div>

</body>
</html>
