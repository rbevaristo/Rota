<footer class="footer {{ Request::is('login') || Request::is('register') ? 'fixed-bottom text-white' : 'footer-default'}}">
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="{{Request::is('login') || Request::is('register') ? '/' : '#home'}}">
                        {{ config('app.name') }}
                    </a>
                </li>
                <li>
                    <a href="{{Request::is('login') || Request::is('register') ? '/' : '#about'}}">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{Request::is('login') || Request::is('register') ? '/' : '#services'}}">
                        Services
                    </a>
                </li>
                <li>
                    <a href="{{Request::is('login') || Request::is('register') ? '/' : '#team'}}">
                       Team
                    </a>
                </li>
                <li>
                    <a href="{{Request::is('login') || Request::is('register') ? '/' : '#contact'}}">
                        Contact
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            <a href="#">Rota.com</a>.
        </div>
    </div>
</footer>