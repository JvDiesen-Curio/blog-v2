<nav class="w-screen flex justify-evenly p-3 shadow-md h-14">
    <div></div>
    <div>

    </div>
    <div class=" inline-flex justify-evenly items-center w-full">
        @if (Auth::check())
            <div>
                Hallo {{ Auth::user()->name }}
            </div>
            <a class="text-white bg-blue-400 rounded-md p-2 text-lg font-semibold" href="{{ route('logout') }}">Logout</a>
        @else
            <a class="text-white bg-blue-400 rounded-md p-2 text-lg font-semibold" href="{{ route('login') }}">Login</a>
            <a class="text-white bg-blue-400 rounded-md p-2 text-lg font-semibold"
                href="{{ route('signUp') }}">Sign-up</a>
        @endif
    </div>
</nav>
