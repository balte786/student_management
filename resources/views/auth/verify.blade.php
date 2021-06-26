<!DOCTYPE html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('dist-assets/css/themes/lite-purple.min.css') }}" rel="stylesheet">
    <title>Signin | PCN Premises Registration Portal</title>
</head>



<div class="auth-layout-wrap" style="background-image: url({{ asset('dist-assets/images/photo-wide-44.jpg') }})">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="{{ asset('dist-assets/images/logo.png') }}" alt=""></div>
                        <h1 class="mb-3 text-18">Education Department Portal</h1>


                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
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
