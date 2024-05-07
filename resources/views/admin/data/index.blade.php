@extends('layouts.base')

@section('content')
    <h1>Index</h1>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <tr>
                    <th> No </th>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Act </th>
                </tr>
                @foreach($data as $d)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $d->id }} </td>
                    <td> {{ $d->name }} </td>
                    <td> 
                        <a class="btn btn-primary" href="{{ route('admin.data.edit', ['id' => $d->id]) }}">Edit</a> 
                        <a class="btn btn-danger" href="{{ route('admin.data.destroy', ['id' => $d->id]) }}">Delete</a> 
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    console.log("Hello")
</script>
@endsection