@csrf

<category-chapter-select
    category="{{ old('category') ?: $page->category->title ?? '' }}"
    chapter="{{ old('chapter') ?: $page->chapter->title ?? '' }}">
</category-chapter-select>

<div class="row">
    <label class="col-12">
        Title
        <input name="title" type="text" value="{{ old('title') ?: $page->title ?? '' }}" />
    </label>

    <label class="col-12">
        Description
        <textarea name="description" rows="2">{{ old('description') ?: $page->description ?? '' }}</textarea>
    </label>

    <label class="col-sm-12">
        Content

        <textarea name="content" class="markdown-editor">{{ old('content') ?: $page->content ?? '' }}</textarea>
        <small class="markdown-editor__status">Not yet saved</small>
    </label>

    <div class="col-sm-12 text-right mt-3">
        <button class="btn">Save as draft</button>
        <button class="btn">Preview</button>
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
