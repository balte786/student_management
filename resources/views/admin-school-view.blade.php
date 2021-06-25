@extends('layouts.main')

@section('content')

    <?php   use \App\Http\Controllers\SchoolController; ?>
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">View School</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--begin::form-->

                <div class="card-body">
                    <div class="card-title mb-3">View School Details</div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="firstName1"><strong>School Name</strong></label>
                                <p>{{$edit_school->school_name}}</p>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="lastName1"><strong>School Code</strong></label>
                                <p>{{$edit_school->school_code}}</p>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="picker1"><strong>School Location</strong></label>
                                <p>{{ SchoolController::fetchFeilds('states','state_name',$edit_school['state_id']); }}</p>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="picker1"><strong>School Type</strong></label>
                                <p>{{ SchoolController::fetchFeilds('school_categories','category_name',$edit_school['category_id']); }}</p>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="picker1"><strong>Status</strong></label>

                                @if($edit_school->status=="1")
                                    <p><span class="badge badge-success">ACTIVE</span></p>
                                @elseif($edit_school->status=="0")
                                    <p><span class="badge badge-danger">DISABLED</span></p>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <a href="{{url('edit-school',[$edit_school->id])}}" class="btn btn-primary">Edit</a>
                                <a onclick="confirm('Are you sure you want to delete this school?')" href="{{url('delete-school',[$edit_school->id])}}" class="btn btn-danger">Delete</a>
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
