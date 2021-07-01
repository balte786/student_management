@extends('layouts.main')

@section('content')
    <?php   use \App\Http\Controllers\SchoolController; ?>
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}" />
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">PCN Education Department | HQ Abuja</h1>
            <ul>
                <li><a href="">Index Number Management</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top">
        
         @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
        
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

                <!--table start-->
                <div class="card text-left">

                    <div class="card-body">

                        <h2 class="card-title mb-1">2021 Application for Index Numbers</h2>
                        <a href="{{ URL::to('admin/export-index/'.$index_id) }}"><button class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOWNLOAD LIST OF STUDENTS (EXCEL)</span></button></a>
                        
                         <form name="pending_st_form" action="{{url('approve-students')}}" method="post">
                         
                         @csrf
                        <div class="table-responsive">
                        
                       
                        
                            <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>School Name</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <!--<th>DOB</th>
                                    <th>State</th>-->

                                    <th>Documents</th>
                                    <th>Student Picture</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @foreach($student_lists as $student)

                                <tr>
                                    <td><label class="checkbox checkbox-success">
                                    
                                    @if($student['status']=='0')
                                    
                                            <input type="checkbox" name="student_ids[]" value="{{$student['id']}}"  /><span class="checkmark"></span>
                                    @endif     
                                            <input type="hidden" name="index_id" value="{{$student['index_id']}}">
                                            <input type="hidden" name="school_id" value="{{$student['school_id']}}">
                                        </label></td>
                                    <td>{{$i}}</td>
                                    <td>{{ SchoolController::fetchFeilds('schools','school_name',$student['school_id']); }}</td>
                                    <td>{{$student['first_name']}} {{$student['middle_name']}} {{$student['last_name']}}</td>
                                    <td>{{$student['gender']}}</td>

                                    <td>

                                        <?php

                                        $filename = SchoolController::fetchFeildsFiles($student['id']);

                                        $picturename = SchoolController::fetchFeildsPic($student['id']);

                                        $schoolCode    = SchoolController::fetchFeildsGeric('schools','school_code','id',$student['school_id']);
                                        $year    = SchoolController::fetchFeildsGeric('index_managements','year','id',$student['index_id']);



                                        ?>


                                        @if($filename)

                                            <a target="_blank" href="{{ asset('student_upload_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$filename.'') }}" class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOWNLOAD DOCUMENTS</span></a>

                                        @else

                                                <button  class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">DOCUMENTS NOT FOUND</span></button>
                                        @endif



                                    </td>
                                    <td>

                                        @if($picturename)


                                            <a target="_blank" href="{{ asset('student_upload_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$picturename.'') }}"> <img src="{{ asset('student_upload_files/'.$schoolCode.'/'.$year.'/'.$student['id'].'/'.$picturename.'') }}" width="80" height="80"></a>

                                        @else

                                            <p>N/A</p>
                                        @endif


                                    </td>

                                </tr>
                                <?php $i++;?>
                              @endforeach

                                </tbody>

                            </table>

                            <div class="col-lg-12 col-md-12">
				

                                <button class="btn btn-success btn-icon m-1" type="submit"><span class="ul-btn__text">APPROVE SELECTED APPLICATIONS</span></button>


                            </div>
                        </div>
                        
                        </form>
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
