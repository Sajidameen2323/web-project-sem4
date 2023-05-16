<x-guestlayout>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        <button type="submit">{{ __('Send Password Reset Link') }}</button>
        @if ($errors->has('email'))
        <p class="text-red-500 text-xs italic mt-1">
            {{ $errors->first('email') }}
        </p>
        @endif
    </form>

</x-guestlayout>