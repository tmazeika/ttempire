<footer class="footer">
    <div class="footer-item">
        &copy; {{ date('Y') }} Table Tennis Empire
    </div>

    <div class="spacer"></div>

    <div class="footer-item footer-lang">
        <img src="{{ asset('/img/america_flag.png') }}"/>
        <a class="footer-item-link {{ LaravelLocalization::getCurrentLocale() === 'en-US' ? 'active' : '' }}" href="{{ LaravelLocalization::getLocalizedURL('en-US') }}">USD</a>
        <img src="{{ asset('/img/europe_flag.png') }}"/>
        <a class="footer-item-link {{ LaravelLocalization::getCurrentLocale() === 'en-GB' ? 'active' : '' }}" href="{{ LaravelLocalization::getLocalizedURL('en-GB') }}">EUR</a>
    </div>

    <div class="footer-item">
        built by <a href="https://mazeika.me">T.J. Mazeika</a>
    </div>
</footer>
