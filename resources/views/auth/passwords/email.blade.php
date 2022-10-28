@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header default_bg text-white">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ session('status') }} --}}
                           <p>
                            Please check your email for password retrieval 
                           </p>
                            <p>
                                Note* sometimes it might be in your spam folder
                            </p>
                        </div>  
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 d-none d-md-block">
                                <img class="img-fluid" src="{{ asset('img/auth/mail.svg') }}" alt="password_reset.svg">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>

                                <button type="submit" class="btn btn_secondary_bg">
                                    {{ __('Send Password Reset Link') }}
                                </button>
        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
