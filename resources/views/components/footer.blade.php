<footer class="footer {{ Request::is('login') || Request::is('register') ? 'fixed-bottom text-white' : 'footer-default'}}">
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="#">
                        Creative Tim
                    </a>
                </li>
                <li>
                    <a href="#">
                        About
                    </a>
                </li>
                <li>
                    <a href="#">
                        Services
                    </a>
                </li>
                <li>
                    <a href="#">
                       Team
                    </a>
                </li>
                <li>
                    <a href="#">
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