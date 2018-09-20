@extends('layouts.master')

@section('content')

<h1 class="heading--underline">Create New Page</h1>

<form action="/pages" method="POST">
    <category-chapter-select></category-chapter-select>

    <div class="row">
        <label class="col-12">
            Title
            <input name="title" type="text"/>
        </label>

        <label class="col-12">
            Description
            <textarea name="description" rows="2"></textarea>
        </label>

        <label class="col-sm-12">
            Content

            <textarea name="content" class="markdown-editor"></textarea>
            <small class="markdown-editor__status">Not yet saved</small>
        </label>

        <button class="btn">Save as draft</button>
        <button class="btn">Preview</button>
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</form>

@stop
