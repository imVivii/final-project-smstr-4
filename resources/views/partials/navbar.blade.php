<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- Add other navbar items here -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" id="datetime"></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            
        @endguest
    </ul>
</nav>

<script>
    function updateDateTime() {
        const options = { weekday: 'long', year: 'numeric', day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const now = new Date().toLocaleDateString('en-US', options);
        document.getElementById('datetime').innerText = now;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime(); // initial call to set the datetime immediately
</script>
