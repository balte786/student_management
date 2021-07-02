@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}" />
    <?php   use \App\Http\Controllers\SchoolController; ?>
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">{{$school_name}}</h1>
            <ul>
                <li><a href="">Approved Index Numbers</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <!--table start-->
                <div class="card text-left">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Approved Index Numbers for {{$index_year}}</h4>


                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Index #</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>State</th>

                                    <th>Documents</th>
                                    <th>Student Picture</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1;?>
                                @foreach($approved_students as $student)


                                    <?php
                                    $status =   'Approved';
                                    $badge  =   'badge-success';
                                    if($student->status=='0'){
                                        $status =   'Not Approved';
                                        $badge  =   'badge-warning';
                                    }
                                    ?>

                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$student['index_number']}}</td>
                                    <td>{{$student['first_name']}} {{$student['middle_name']}} {{$student['last_name']}}</td>
                                    <td>{{$student['gender']}}</td>
                                    <td>{{date('d-m-Y',strtotime($student['date_of_birth']))}}</td>
                                    <td>{{$student['state_of_origin']}}</td>

                                    <td>

                                        <?php

                                            //echo "i am student=".$student['id'];
                                            $filename = SchoolController::fetchFeildsFiles2($student['id']);
                                            $imagename = SchoolController::fetchFeildsPic2($student['id']);


                                        $schoolCode    = SchoolController::fetchFeildsGeric('schools','school_code','id',$student['school_id']);
                                        $year    = SchoolController::fetchFeildsGeric('index_managements','year','id',$student['index_id']);
                                        ?>

                                        @if($filename)

                                        <a target="_blank" href="{{ asset('student_approved_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$filename.'') }}" class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOWNLOAD DOCUMENTS</span></a>

                                        @else

                                            <button class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOWNLOAD NOT FOUND</span></button>

                                        @endif

                                    </td>
                                    <td>

                                        @if($imagename)

                                            <a target="_blank" href="{{ asset('student_approved_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$imagename.'') }}"> <img src="{{ asset('student_approved_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$imagename.'') }}" width="80" height="80"></a>

                                        @else

                                            <p>N/A</p>
                                        @endif


                                    </td>

                                </tr>
                                  <?php $i++; ?>
                                 @endforeach

                                </tbody>

                            </table>
                            <div class="col-lg-12 col-md-12">

                                <a href="{{ url('/admin/approved-index-export/'.$index_id)}}"><button class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOWNLOAD APPROVED INDEX NUMBERS (EXCEL)</span></button></a>
                            </div>
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
    </div>
    </div>

@endsection
