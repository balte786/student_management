@extends('layouts.main')

@section('content')

    <?php use \App\Http\Controllers\SchoolController; ?>
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">{{ SchoolController::fetchFeilds('schools','school_name',Auth::user()->school_id); }}</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="row">

                @foreach($myquotas as $quota)

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center"><i class="i-Diploma-2"></i>
                                <p class="text-muted mt-2 mb-2">{{$quota->year}} Quota</p>
                                <p class="text-primary text-50 line-height-1 m-0">{{$quota->quota}}</p>
                            </div>
                        </div>
                    </div>

                @endforeach


                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <h5 class="card-title m-0 p-3">Yearly Quota</h5>
                        <div id="echart4" style="height: 300px"></div>
                    </div>
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
