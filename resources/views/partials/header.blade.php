<header class="header">
    <p>Header</p>

    <a href="{{ url('/') }}">@lang('page.title.home')</a>

    @foreach($navItems as $navItem)
        <a href="{{ $navItem->getUrl() }}">{{ $navItem->getTitle() }}</a>
    @endforeach
</header>
