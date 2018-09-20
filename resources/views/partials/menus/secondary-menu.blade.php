<nav class="secondary-menu">
    <span class="vh" id="secondary-menu-title">Top navigation</span>

    <ul class="secondary-menu__list" aria-describedby="secondary-menu-title">

        <li class="secondary-menu__list-item secondary-menu__list-item--brand">
            <a href="{{ route('home') }}" class="secondary-menu__link">
                <i class="secondary-menu__icon fa fa-cube"></i>
                {{ config('app.name') }}
            </a>
        </li>

        <li class="secondary-menu__list-item secondary-menu__list-item--search">
            <i class="secondary-menu__icon fa fa-search"></i>
            <label for="global-search" class="vh">Search</label>
            <input type="text" placeholder="Search..." id="global-search" class="secondary-menu__input js-search">
        </li>

        <li class="secondary-menu__list-item">
            <a href="{{ route('pages.create') }}" class="secondary-menu__link secondary-menu__link--icon" title="Add a new page">
                <i class="secondary-menu__icon fa fa-plus"></i>
                <span class="vh">Add a new page</span>
            </a>
        </li>

    </ul>
</nav>
