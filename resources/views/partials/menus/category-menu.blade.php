<nav class="category-menu">
    <span class="vh" id="category-menu-title">Select a category</span>

    <ul class="category-menu__list" aria-describedby="category-menu-title">

        @foreach($categories as $i => $category)
            <li class="category-menu__list-item {{ !$i ? 'js-class-toggler-trigger' : '' }}" data-class-toggler-target="category-menu__list">

                @if($i)
                    <a href="{{ route('categories.select', $category->id) }}" class="category-menu__link">
                @endif

                {{ $category->title }}

                @if($i)
                    </a>
                @else
                    <button class="category-menu__switch-button">
                        <i class="fa fa-angle-down"></i>
                    </button>
                @endif

            </li>
        @endforeach
    </ul>
</nav>
