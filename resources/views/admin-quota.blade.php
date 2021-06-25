@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Admission Quota Management</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class=" mb-6">Admission Quota Management</h2>
                <hr>
                <a href="{{ url('admin/importExportView') }}"><button class="btn btn-primary" type="button">ADD NEW YEARLY QUOTA</button></a>
                <hr>
                <!--begin::form-->
                <div class="row">





                    @foreach($quotas as $quota)
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="card card-icon mb-4">
                            <a href="admin-quota-year.php">
                                <div class="card-body text-center"><i class="i-Students"></i>
                                    <p class="text-muted mt-2 mb-2">{{ $quota->category_name }}</p>
                                    <p class="text-primary text-40 line-height-1 m-0">{{ $quota->year }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>





                <!-- end::form -->





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
