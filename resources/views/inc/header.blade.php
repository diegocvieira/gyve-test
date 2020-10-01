<header style="margin-bottom: 50px;">
    <nav class="teal darken-3" style="padding: 0px 10px;">
        <div class="nav-wrapper">
            <a href="{{ route('home') }}" class="brand-logo">Gyve test</a>

            <a href="#" class="sidenav-trigger" data-target="mobile-nav">
                <i class="material-icons">menu</i>
            </a>

            <ul class="right hide-on-med-and-down">
                <li><a href="{{ route('home') }}">Orders</a></li>
                @if (Auth::user()->is_admin)
                    <li><a href="{{ route('user.index') }}">Users</a></li>
                @endif
                <li><a href="{{ route('user.edit') }}">Config</a></li>
                <li><a href="{{ route('user.logout') }}">Logout</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-nav">
        <li><a href="{{ route('home') }}">Orders</a></li>
        @if (Auth::user()->is_admin)
            <li><a href="{{ route('user.index') }}">Users</a></li>
        @endif
        <li><a href="{{ route('user.edit') }}">Config</a></li>
        <li><a href="{{ route('user.logout') }}">Logout</a></li>
    </ul>
</header>
