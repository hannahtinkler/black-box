@extends('layouts.master')

@section('content')

<h1 class="heading--underline">Create New Page</h1>

@include('partials.alerts.errors')

<form action="{{ route('pages.store') }}" method="POST">
    @include('partials.forms.page')
</form>

@stop
