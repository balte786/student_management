@extends('layouts.main')

@section('content')

    <?php   use \App\Http\Controllers\SchoolController; ?>
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}" />
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Schools</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--table start-->


                <div class="card text-left">
                    <div class="card-body">
                        <!--<h4 class="card-title mb-3">Admin Users</h4>-->

                        <a href="{{ url('add-school') }}"><button class="btn btn-primary" type="button">ADD SCHOOL</button></a>
                        <hr>

                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                                <thead>
                                <tr>

                                    <th>School Name</th>
                                    <th>School Code</th>
                                    <th>School Type</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($schools as $school)

                                <tr>
                                    <td>{{$school['school_name']}}</td>
                                    <td>{{$school['school_code']}}</td>
                                    <td>{{ SchoolController::fetchFeilds('school_categories','category_name',$school['category_id']); }}</td>

                                    <td>{{ SchoolController::fetchFeilds('states','state_name',$school['state_id']); }}</td>
                                    <td>

                                        @if($school['status'] == "1")
                                            <span class="badge badge-success">ACTIVE</span>
                                        @elseif($school['status'] == "0")
                                            <span class="badge badge-warning">DISABLED</span>
                                        @endif

                                    </td>
                                    <td><a href="{{ url('admin-school-view',[$school['id']])}}"><button class="btn btn-info" type="button">VIEW</button></a></td>
                                </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


                <!--table end-->
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
