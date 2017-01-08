<header class="header">
    <div class="header-item rotatable">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo_ico.png') }}" alt="@lang('page.title.home')"/>
        </a>
    </div>

    @foreach($navItems as $navItem)
        <div class="header-item">
            <a class="{{ $navItem->isActive() ? 'active' : '' }}" href="{{ $navItem->getUrl() }}">
                {{ trans($navItem->getTitle()) }}
            </a>
        </div>
    @endforeach
</header>
