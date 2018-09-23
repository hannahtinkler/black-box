<div class="group--inline pull-right">
    <a class="btn" href="{{ route('pages.edit', $page->id) }}"><i class="fa fa-pencil"></i> Edit</a>

    <form action="{{ route('pages.destroy', $page->id) }}" method="POST">
        @csrf
        {!! method_field('DELETE') !!}
        <button type="submit" class="btn">
            <i class="fa fa-trash-o"></i> Delete
        </button>
    </form>
</div>
