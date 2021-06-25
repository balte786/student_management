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
                    <div class="card-title mb-3">Add New User</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ URL::to('admin-users/store-user') }}">
                    @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1">First name</label>
                                <input name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required id="first_name" type="text" placeholder="Enter your first name" />
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName1">Last name</label>
                                <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required id="last_name" type="text" placeholder="Enter your last name" />
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" class="form-control @error('last_name') is-invalid @enderror" id="email" value="{{ old('last_name') }}" required type="email" placeholder="Enter email" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Phone</label>
                                <input name="phone" class="form-control" id="phone" placeholder="Enter phone" />
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
                                        <option value="{{ $school_type->id }}">{{ $school_type->category_name }}</option>
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
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                                @error('status')
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
