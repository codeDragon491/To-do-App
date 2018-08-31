@extends('layouts.app')

@section('content')
<div class="text-center">
            <div class="mt-8">
                <div class="text-xl">{{ __('Login') }}</div>

                <div class="pt-6">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                            <div class="pt-3 pb-3 pt-3">
                                <input id="email" type="email" class="w-1/4 border-solid border p-3{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="element-block pt-3 text-red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>


                            <div class="pt-3 pb-3 pt-3">
                                <input id="password" type="password" class="w-1/4 border-solid border p-3{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"  required>

                                @if ($errors->has('password'))
                                    <span class="element-block" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                        <div class="pt-3 pb-3 pt-3">

                                <div class="form-check">
                                    <input class="p-3" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="pt-3 pb-3 pt-3">
                                <button type="submit" class="bg-orange text-white w-1/6 p-3">
                                    {{ __('Login') }}
                                </button>

                                <a class="element-block p-3 text-orange no-underline" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
