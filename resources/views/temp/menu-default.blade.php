@extends('portal.dashboard')

@section('read-data')
<div class="container">
<table class="table">
    <thead class="thead-dark">
        <tr>
        @foreach($fields as $field)
        <th scope="col">{{ $field }}</th>
        @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            @foreach($fields as $field)
                @if($field=='area_id')
                    <td>{{ $areas[$item->$field] }}</td>
                @else
                <td>{{ $item->$field }}</td>
                @endif
            @endForeach
        </tr>
        {{ $item->name }}
        @endforeach
    </tbody>
</table>
{{ $data->links() }}
</div>
@endsection