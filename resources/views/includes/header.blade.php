    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Pioneer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                {{-- Left --}}
                <ul class="navbar-nav me-auto">
                    @auth
                        @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pages.orderRequested') }}">Requested Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pages.orderAssigned') }}">Assigned Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pages.orderCompleted') }}">Completed Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">Role&Permission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('calendar.index') }}">View Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.create') }}">Service Request Form</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pages.loginHistory') }}">Login History</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.create') }}">Service Request Form</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.index') }}">Request History</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                {{-- Right --}}
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.show', auth()->user()) }}">
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
