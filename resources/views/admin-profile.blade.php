@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Admin Users</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--begin::form-->

                <div class="card-body">
                    <div class="card-title mb-3">Profile</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form method="POST" action="{{ URL::to('admin/profile-update') }}">
                    @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1">First name</label>
                                <input name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $user->first_name }}" required id="first_name" type="text" placeholder="Enter your first name" />
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName1">Last name</label>
                                <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $user->last_name }}" required id="last_name" type="text" placeholder="Enter your last name" />
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" class="form-control @error('last_name') is-invalid @enderror" id="email" value="{{ $user->email }}" required type="email" placeholder="Enter email" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Phone</label>
                                <input name="phone" class="form-control" id="phone" value="{{ $user->phone_number }}" placeholder="Enter phone" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">User Type</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($school_types as $school_type)
                                        <option <?php if($school_type->id==$user->category_id){ echo 'selected';}?> value="{{ $school_type->id }}">{{ $school_type->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Status</label>
                                <select name="status" class="form-control @error('category_id') is-invalid @enderror">
                                    <option <?php if($user->approved_at!=''){ echo 'selected';}?> value="1">Active</option>
                                    <option <?php if($user->approved_at==''){ echo 'selected';}?> value="0">Disable</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="" placeholder="Enter Password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control form-control" name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                    <!-- end::form -->

                </div>

            </div>

        </div>
        <!-- end of row-->

        <!-- end of main-content -->
        <!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <div class="app-footer">
            <div class="row">
                <div class="col-md-9">
                    <!--<p><strong>Pharmacists Council of Nigeria</strong></p>
                    <p>The Pharmacists Council of Nigeria (PCN) is a Federal Government parastatal established by Act 91 of 1992 (Cap P17 LFN 2004) charged with the responsibility for regulating and controlling Pharmacy Education, Practice and Training in all aspects and ramifications.
                        <sunt></sunt>
                    </p>-->
                </div>
            </div>
            <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">

                <span class="flex-grow-1"></span>
                <div class="d-flex align-items-center">
                    <img class="logo" src="{{ asset('dist-assets/images/logo.png') }}" alt="">
                    <div>
                        <p class="m-0">&copy; 2021 Pharmacists Council of Nigeria</p>
                        <p class="m-0">All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- fotter end -->
    </div>
@endsection
