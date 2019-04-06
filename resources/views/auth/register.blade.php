@extends('auth.auth')

@section('content')
    <div class="container all-g-centered-md" style="min-height: 60vh">


        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label for="name" class="g-col-md-4 col-form-label">{{ __('Name') }}</label>

                        <div class="g-col-md-6">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="g-col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="g-col-md-6">
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="g-col-md-4 col-form-label">{{ __('Password') }}</label>

                        <div class="g-col-md-6">
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="g-col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="g-col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="g-col-md-6 f-row justify-content-around">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            <br>
                            @include('forms.buttons.fb-btn')

                        </div>

                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
@push('styles')
    <style>
        .row{
            display: flex;
            flex-flow: column;
            flex-wrap: wrap;
        }
        .card{
            min-width: 50vw;
        }
    </style>
@endpush