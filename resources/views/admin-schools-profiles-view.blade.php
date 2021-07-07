@extends('layouts.main')

@section('content')
    <?php   use \App\Http\Controllers\SchoolController; ?>

    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">School Profile</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--begin::form-->

                <div class="card-body">
                    <div class="card-title mb-3">School Profile Details</div>
                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1"><strong>School Name</strong></label>
                                <p>{{ SchoolController::fetchFeilds('schools','school_name',$user_details['school_id']); }}</p>
                            </div>
                            <div class="col-md-2 form-group mb-3">
                                <label for="lastName1"><strong>School Code</strong></label>
                                <p>{{ SchoolController::fetchFeilds('schools','school_code',$user_details['school_id']); }}</p>
                            </div>
                            <div class="col-md-2 form-group mb-3">
                                <label for="picker1"><strong>School Location</strong></label>
                                <p>{{ SchoolController::fetchFeilds('states','state_name',$user_details['state_id']); }}</p>
                            </div>
                            <div class="col-md-2 form-group mb-3">
                                <label for="picker1"><strong>School Type</strong></label>
                                <p>{{ SchoolController::fetchFeilds('school_categories','category_name',$user_details['category_id']); }}</p>
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <label for="firstName1"><strong>First Name</strong></label>
                                <p>{{$user_details['first_name']}}</p>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="lastName1"><strong>Last Name</strong></label>
                                <p>{{$user_details['last_name']}}</p>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="picker1"><strong>Email</strong></label>
                                <p>{{$user_details['email']}}</p>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="picker1"><strong>Phone</strong></label>
                                <p>{{$user_details['phone_number']}}</p>
                            </div>




                            <div class="col-md-12">

                                @if($user_details['status']=='0' || $user_details['status']=='2')
                                    <a onclick="confirm('Are you sure do you want to activate this user?')" href="{{url('approve-user-profile',[$user_details['id']])}}" class="btn btn-primary">APPROVE</a>
                                @endif

                                <a onclick="confirm('Are you sure do you want to reject this user?')" href="{{url('reject-user-profile',[$user_details['id']])}}" class="btn btn-danger">REJECT</a> Current Status:

                                @if($user_details['status']=='0')

                                    <span class="badge badge-warning">PENDING APPROVAL</span>

                                @elseif($user_details['status']=='1')

                                    <span class="badge badge-success">ACTIVE</span>

                                @elseif($user_details['status']=='2')

                                    <span class="badge badge-danger">REJECTED</span>


                                @endif
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
