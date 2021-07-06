@extends('layouts.main')

@section('content')

    <?php   use \App\Http\Controllers\IndexManagementController; ?>
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}" />
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">{{ Auth::user()->school->school_name }}</h1>
            <ul>
                <li><a href="">Application for Index Numbers</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--table start-->


                <div class="card text-left">
                    <div class="card-body">
                       
                      
                        <h4 class="card-title mb-3">Application for Index Numbers</h4>

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif

                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Year</th>
                                    <th>School Name</th>
                                    <th>Quota</th>
                                    <th>Applications</th>
                                    <th>Approved</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($index_lists as $list)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td>
                                    <td>{{ $list->year }}</td>
                                    <td>{{ $list->school_name }}</td>
                                    <td>{{ $list->quota }}</td>

                                    @if($list->status==1)

                                    <td><?php echo IndexManagementController::countApplicants($list->id) + IndexManagementController::countHoldApplicants($list->id); ?></td>

                                    @else
                                        <td>{{ IndexManagementController::countHoldApplicants($list->id) }}</td>

                                    @endif

                                    <td>{{ IndexManagementController::countApplicants($list->id) }}</td>

                                    @if($list->status==1)
                                        <td><span class="badge badge-success">APPROVED</span></td>
                                        <td><a href="{{ url('/admin/index-approved',[$list->id])}}"><button class="btn btn-success" type="button"><i class="nav-icon i-Folder-Download"></i></button></a></td>
                                    @else
                                        <td><span class="badge badge-warning">PENDING</span></td>
                                        <td><a href="{{ url('admin-index-pending',[$list->id])}}"><button class="btn btn-warning" type="button"><i class="nav-icon i-Folder-Download"></i></button></a></td>

                                    @endif

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
