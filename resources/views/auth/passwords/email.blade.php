<!DOCTYPE html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('dist-assets/css/themes/lite-purple.min.css') }}" rel="stylesheet">
    <title>Forget Password | PCN Premises Registration Portal</title>
</head>



<div class="auth-layout-wrap" style="background-image: url({{ asset('dist-assets/images/photo-wide-44.jpg') }})">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="{{ asset('dist-assets/images/logo.png') }}" alt=""></div>
                        <h1 class="mb-3 text-18">Education Department Portal</h1>
                        <h1 class="mb-3 text-18">Forget Password</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn btn-primary btn-block mt-2">{{ __('Send Password Reset Link') }}</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 text-center" style="background-size: cover;background-image: url(../dist-assets/images/photo-long-3.jpg)">
                    <div class="pr-3 auth-right">
                        <h1 class="mb-3 text-18">New Users</h1>
                        <h2 class="mb-3 text-14">You need to register a profile to gain access to this portal</h2>
                        <a class="btn  btn-outline-primary btn-outline-email btn-block btn-icon-text" href="{{ route('register') }}"><i class="i-Mail-with-At-Sign"></i> Register Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>