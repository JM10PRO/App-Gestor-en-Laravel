<x-layouts.app
    title="Register"
    meta-description="Register meta description"
>
    <h1 class="">Register</h1>

    <form class="" action="{{ route('register') }}" method="POST">
        @csrf

        <div class="">
            <label class="">
                <span class="">
                    Name
                </span>
                <input class=""
                       autofocus="autofocus"
                       name="name"
                       type="text"
                       value="{{ old('name') }}"
                >
                @error('name')
                <small class="">{{ $message }}</small>
                @enderror
            </label>
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
                <span class="">
                    Password Confirmation
                </span>
                <input class=""
                       name="password_confirmation"
                       type="password"
                >
                @error('password_confirmation')
                <small class="">{{ $message }}</small>
                @enderror
            </label>
        </div>

        <div class="">
            <a class="" href="{{ route('login') }}">
                Login
            </a>

            <button class="" type="submit">
                Register
            </button>
        </div>
    </form>

</x-layouts.app>
