@extends('site.layouts.app')

@section('content')
    <div class="forgot-password block-style">
        <div class="forgot-content">
            <span class="title-usual">
                {{ __('frontend.login.Forgot your password?') }}
            </span>
            <span class="description-usual">
                {{ __('frontend.login.Forgot password text') }}
            </span>
        </div>

        <form class="forgot-password-form w-100 d-flex flex-column align-items-center"
              action="{{ route('password.email') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <input class="input-default"
                   type="email"
                   name="email"
                   required
                   value="{{ old('email') }}"
                   placeholder="{{ __('frontend.login.Email') }}">
            @if($errors->has('email'))
                <span class="input-alert">{{ $errors->first('email') }}</span>
            @endif
            <div class="d-flex justify-content-between align-items-center forgot-password-btn-group">
                <button type="submit" class="button-orange">
                    {{ __('frontend.login.Submit') }}
                </button>
                <button type="reset" class="button-orange button-orange-cancel">
                    {{ __('frontend.login.Cancel') }}
                </button>
            </div>
        </form>
    </div>
@endsection
