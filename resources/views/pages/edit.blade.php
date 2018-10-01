@extends('layouts.master')

@section('content')

<h1 class="heading--underline">Edit Page</h1>

@include('partials.alerts.errors')

<form action="{{ route('pages.update', $page->id) }}" method="POST" class="js-page-form">
    {!! method_field('PUT') !!}
    @include('partials.forms.page')
</form>

@stop
