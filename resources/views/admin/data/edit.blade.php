@extends('layouts.base')

@section('content')
    <h1>Edit</h1>
    <a href="{{ route('admin.data.index') }}">back</a>
    <div class="row">
        <div class="col-lg-12">
            <form method="put" action="{{ route('admin.data.update', ['id' => $data->id]) }}">
                @csrf
                {{ method_field('PUT') }}
                {!! App\Helpers\AppForm::input('text', "Name", "name", true, $data->name) !!}
                <input type="submit">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    console.log("Hello")
</script>
@endsection