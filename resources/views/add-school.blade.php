@extends('layouts.main')

@section('content')


    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Schools</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--begin::form-->

                <div class="card-body">
                    <div class="card-title mb-3">Add New School</div>
                    <form method="post" action="{{url('save-school')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName1">School Name</label>
                                <input class="form-control" id="firstName1" name="school_name" type="text" placeholder="Enter School Name" required />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName1">School Code</label>
                                <input class="form-control" id="lastName1" name="school_code" type="text" placeholder="Enter School Code. UNN, UNIBEN etc" required />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">School Location</label>
                                <select class="form-control" name="state_id" required>

                                    @foreach($states as $state)

                                    <option value="{{$state->id}}">{{$state->state_name}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">School Type</label>
                                <select class="form-control" name="category_id" required>

                                    @foreach($school_categories as $school_category)

                                    <option value="{{$school_category->id}}">{{$school_category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
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
