<nav class="primary-menu">
    <ul class="primary-menu__list">

        <li class="primary-menu__list-item {{ request()->route()->named('home') ? 'primary-menu__list-item--current' : '' }}">
            <a href="{{ route('home') }}" class="primary-menu__brand primary-menu__link">
                <i class="primary-menu__icon fa fa-home"></i>
                Home
            </a>
        </li>

        @foreach($chapters as $chapter)
            <li class="primary-menu__list-item js-class-toggler-target--{{ $chapter->id }}">
                <button class="primary-menu__link js-class-toggler-trigger" data-class-toggler-target="js-class-toggler-target--{{ $chapter->id }}">
                    <i class="primary-menu__icon fa fa-folder-o"></i>
                    {{ $chapter->title }}
                    @if($chapter->pages)
                        <i class="primary-menu__show-more fa fa-angle-left"></i>
                    @endif
                </button>

                @if($chapter->pages)
                    <ul class="primary-menu__sub-list">
                        <li class="primary-menu__list-item">
                            <a class="primary-menu__sub-link" href="{{ route('chapters.show', $chapter->id) }}">
                                <i class="primary-menu__icon fa fa-bars"></i>
                                View all
                            </a>
                        </li>

                        @foreach($chapter->pages as $page)
                            <li class="primary-menu__list-item">
                                <a class="primary-menu__sub-link" href="{{ $page->permalink() }}">
                                    <i class="primary-menu__icon fa fa-file-o"></i>
                                    {{ $page->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

    </ul>
</nav>
