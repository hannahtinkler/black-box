@extends('layouts.master')

@section('content')

<div class="pages__headings">
    <h1 class="heading--charlie">
        {{ $page->chapter->category->title }} - {{ $page->chapter->title }}
        @include('partials.page-options')
    </h1>
    <h2 class="heading--alpha heading--underline my-4">{{ $page->title }}</h2>
</div>


@include('partials.alerts.errors')


<div class="generated-page-content mb-4">
    {!! $page->html !!}
</div>

<hr />

<small>
    Written by <strong><a href="/">{{ $page->creator->name }}</a></strong>
</small>


@stop
