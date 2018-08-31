@extends('layouts.app')

@section('content')
    <div class="text-center">
            <div class="mt-8">
                <div class="text-xl">{{ __('Register') }}</div>

                <div class="pt-6">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="pt-3 pb-3 pt-3">

                                <input id="name" type="text" class="w-1/4 border-solid border p-3{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="pt-3 pb-3 pt-3">
                            
                                <input id="email" type="email" class="w-1/4 border-solid border p-3{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="pt-3 pb-3 pt-3">

                                <input id="password" type="password" class="w-1/4 border-solid border p-3{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="pt-3 pb-3 pt-3">
                                <input id="password-confirm" type="password" class="w-1/4 border-solid border p-3" name="password_confirmation" required placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="bg-orange text-white w-1/6 p-3">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
