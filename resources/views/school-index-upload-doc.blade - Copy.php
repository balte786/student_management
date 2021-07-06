@extends('layouts.main')

@section('content')
    <?php   use \App\Http\Controllers\SchoolController;

    ?>
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
                        <h4 class="card-title mb-3">Application for Index Numbers for {{@$quota_data['year']}}</h4>


                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>State</th>
                                    <th>Upload PDF Documents (2MB each) </th>
                                    <th>Upload Student Picture </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1;?>
                                @foreach($students_list as $student)

                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$student['first_name']}} {{$student['middle_name']}} {{$student['last_name']}}</td>
                                    <td>{{$student['gender']}}</td>
                                    <td><?php echo date('d-m-Y',strtotime($student['date_of_birth']));?></td>
                                    <td>{{$student['state_of_origin']}}</td>
                                    <td>
                                        <form name="std_doc_form_{{$i}}" id="std_doc_form_{{$i}}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-12 form-group mb-3 input-group">

                                                    <div class="custom-file">

                                                        <input class="custom-file-input" name="student_doc" id="inputGroupFile_{{$i}}" type="file" />
                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <input type="hidden" value="{{$student['id']}}" name="student_id">
                                                        <input type="hidden" value="{{$student['index_id']}}" name="index_id">
                                                        <input type="hidden" value="{{$student['school_id']}}" name="school_id">
                                                    </div>

                                                    <div class="input-group-append"><button onclick="return uploadStudentFiles({{$student['id']}},{{$i}})" class="input-group-text" name="upload_btn_{{$i}}" id="upload_btn_{{$i}}">Upload</button></div>

                                                </div>
                                                <p style="padding-left:17px;" id="msg_container_{{$i}}">

                                                <?php $filename     = SchoolController::fetchFeildsGeric('hold_student_files','file_name','student_id',$student['id']); ?>

                                                 @if($filename)

                                                 {{$filename}}

                                                 @endif

                                                </p>

                                            </div>
                                        </form>
                                    </td>


                                    <td>
                                        <form name="std_pic_form_{{$i}}" id="std_pic_form_{{$i}}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-12 form-group mb-3 input-group">

                                                    <div class="custom-file">

                                                        <input class="custom-file-input" name="student_pic" id="picture_{{$i}}" type="file" />
                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <input type="hidden" value="{{$student['id']}}" name="student_id">
                                                        <input type="hidden" value="{{$student['index_id']}}" name="index_id">
                                                        <input type="hidden" value="{{$student['school_id']}}" name="school_id">
                                                    </div>

                                                    <div class="input-group-append"><button onclick="return uploadStudentPicture({{$student['id']}},{{$i}})" class="input-group-text" name="upload_picture_{{$i}}" id="upload_picture_{{$i}}">Upload</button></div>

                                                </div>
                                                <p style="padding-left:17px;" id="msg_container_pic_{{$i}}">

                                                    <?php $filenameimg     = SchoolController::fetchFeildsGeric('hold_student_pictures','file_name','student_id',$student['id']); ?>

                                                    @if($filenameimg)

                                                        {{$filenameimg}}

                                                    @endif

                                                </p>

                                            </div>
                                        </form>
                                    </td>

                                </tr>
                                <?php $i++; ?>
                                    @endforeach

                                </tbody>

                            </table>
                            <div class="col-lg-12 col-md-12">

                                <a href="{{url('school-index-submission',[$index_id])}}" class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__text">SUBMIT INDEXING APPLICATION</span></a>
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


    <script>

        function uploadStudentFiles(studet_id,loop_id) {


            event.preventDefault();

            var myform  = $('#std_doc_form_'+loop_id);

            var formData = new FormData(myform[0]);
            $.ajax({
                url: '{{ url('/upload-students-docs-ajax') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result)
                {
                    //alert(result.success);

                    if(result.success=='0'){

                        $('#msg_container_'+loop_id).html('<span style="color:red;">Please Check The Doc Formate OR Select File</span>');
                    }else if(result.success=='1'){

                        $('#msg_container_'+loop_id).html('<span style="color:green;">'+result.message+'</span>');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                }
            });



            return false;
        }


        function uploadStudentPicture(studet_id,loop_id) {


            event.preventDefault();

            var myform  = $('#std_pic_form_'+loop_id);

            var formData = new FormData(myform[0]);
            $.ajax({
                url: '{{ url('/upload-picture-ajax') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result)
                {
                    //alert(result.success);

                    if(result.success=='0'){

                        $('#msg_container_pic_'+loop_id).html('<span style="color:red;">Please Check The picture formate OR Select picture</span>');
                    }else if(result.success=='1'){

                        $('#msg_container_pic_'+loop_id).html('<span style="color:green;">'+result.message+'</span>');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                }
            });



            return false;
        }

    </script>
@endsection
