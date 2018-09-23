@extends('layouts.basic')

@section('content')

<div class="access-denied">
    <h1>Sorry...</h1>
    <p>Something went wrong when we tried to authenticate you.</p>

    <div class="mt-4">
        <a href="/login" class="btn btn--primary">Try again?</a>
    </div>
</div>

@stop


@section('scripts')
@stop
