
<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-item">
                <h2>{{ config('app.name') }}</h2>
            </a>
        </div>
        <div class="nav-right nav-menu">

                <a href="{{ route('cart.show') }}" class="navbar-link">Cart: <span class="badge">0</span> </a>

            <!-- Authentication Links -->
                @if (Auth::guest())
                    <a class="nav-item is-tab" href="{{ route('login') }}">Login</a>
                    <a class="nav-item is-tab" href="{{ route('register') }}">Register</a>
                @else
                    <a class="nav-item is-tab">
                        <figure class="image is-16x16" style="margin-right: 8px;">
                            <img src="http://bulma.io/images/jgthms.png">
                        </figure>
                        {{ Auth::user()->name }}
                    </a>
                    <a class="nav-item is-tab" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif

        </div>
    </div>
</nav>
