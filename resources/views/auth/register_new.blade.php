<!DOCTYPE html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('dist-assets/css/themes/lite-purple.min.css') }}" rel="stylesheet">
    <title>Signin | PCN Premises Registration Portal</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>



<div class="auth-layout-wrap" style="background-image: url(../dist-assets/images/photo-wide-44.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6 text-center" style="background-size: cover;background-image: url({{ asset('dist-assets/images/photo-long-3.jpg') }})">
                    <div class="pl-3 auth-right">
                        <div class="auth-logo text-center mt-4"><img src="{{ asset('dist-assets/images/logo.png') }}" alt=""></div>
                        <h1 class="mb-3 text-18">Education Department Portal</h1>
                        <h1 class="mb-3 text-18">Existing Users</h1>
                        <h2 class="mb-3 text-14">If you have created a profile on this portal before now, please login</h2>
                        <div class="flex-grow-1"></div>
                        <div class="w-100 mb-4">

                            <a class="btn btn-outline-primary btn-block btn-icon-text btn" href="{{ route('login') }}"><i class="i-Mail-with-At-Sign"></i> Sign in</a>
                        </div>
                        <div class="flex-grow-1"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif


                        <h1 class="mb-3 text-18">Sign Up</h1>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input name="first_name" class="form-control form-control @error('name') is-invalid @enderror" id="firstname" type="text" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input name="last_name" class="form-control form-control @error('last_name') is-invalid @enderror" id="last_name" type="text" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input name="email" class="form-control form-control @error('email') is-invalid @enderror" id="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" class="form-control form-control @error('phone') is-invalid @enderror" id="phone" type="text" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="picker1">School Type</label>
                                <select  class="form-control @error('school_type') is-invalid @enderror" name="school_type" onChange="loadSchools(this.value)">
                                    <option value="" selected="selected">Select</option>
                                    @foreach ($school_categories as $school_category)
                                        <option value="{{ $school_category->id }}">{{ $school_category->category_name }}</option>
                                    @endforeach

                                </select>
                                @error('school_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="picker1">School Name</label>
                                <select id="school_name" class="form-control" name="school_id">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="repassword">Retype password</label>
                                <input id="password-confirm" type="password" class="form-control form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn mt-3">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadSchools(id){

        $.ajax({
            type:'POST',
            url:'/fetch-schools',
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}",
            },
            success:function(data) {
                $("#school_name").html(data.content);

                // alert(data.content);
            }
        });
    }
</script>