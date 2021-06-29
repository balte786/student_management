@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Admin Users</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--begin::form-->

                <div class="card-body">
                    <div class="card-title mb-3">Add New User</div>
                    <form method="post" action="{{ url('admin-users/update') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1">First name</label>
                                <input class="form-control" id="firstName1" name="first_name" value="{{$user->first_name}}" type="text" placeholder="Enter your first name" />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName1">Last name</label>
                                <input class="form-control" id="lastName1" name="last_name" value="{{$user->last_name}}" type="text" placeholder="Enter your last name" />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" id="exampleInputEmail1" name="email" value="{{$user->email}}" type="email" placeholder="Enter email" />

                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="phone">Phone</label>
                                <input class="form-control" value="{{$user->phone_number}}" name="phone"  id="phone" placeholder="Enter phone" />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">User Type</label>
                                <select class="form-control" name="category_id">
                                    @foreach($school_types as $school_type)
                                    <option <?php if($school_type->id==$user->category_id){?> selected<?php }?> value="{{$school_type->id}}">{{$school_type->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Status</label>
                                <select class="form-control" name="status">
                                    <option <?php if($user->status=='1'){?> selected<?php }?> value="1">Active</option>
                                    <option <?php if($user->status=='0'){?> selected<?php }?> value="0">Disable</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
    </div>
    </div>
@endsection
