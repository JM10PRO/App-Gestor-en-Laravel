<x-layouts.app
    title="Login"
    meta-description="Login meta description"
>
    <h1 class="">Login</h1>

    <form class="" action="{{ route('login') }}" method="POST">
        @csrf

        <div class="">
            <label class="">
                <span class="">
                    Email
                </span>
                <input class=""
                       name="email"
                       type="email"
                       value="{{ old('email') }}"
                >
                @error('email')
                <small class="">{{ $message }}</small>
                @enderror
            </label>
            <label class="">
                <span class="">
                    Password
                </span>
                <input class=""
                       name="password"
                       type="password"
                >
                @error('password')
                <small class="">{{ $message }}</small>
                @enderror
            </label>
            <label class="">
                <input class=""
                       name="remember"
                       type="checkbox"
                >
                <span class="">
                    Recuérdame
                </span>
            </label>
        </div>

        <div class="">
            <a class="" href="{{ route('register') }}">
                Register
            </a>

            <button class="" type="submit">
                Login
            </button>
        </div>
    </form>

</x-layouts.app>
