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
        <div class="row"><!-- start of row-->
            <div class="col-lg-12 col-md-12">
                <!--table start-->
                <div class="card text-left">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Adminission Quota Upload</h4>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <p>Download the Quota Template and complete accordingly</p>
                                <button onclick="return validateCatId()" class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-File-Excel"></i></span><span class="ul-btn__text">DOWNLOAD QUOTA TEMPLATE</span></button>
                                {{--<a href="{{ asset('general_formates/quota.xlsx') }}" class="btn btn-primary btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-File-Excel"></i></span><span class="ul-btn__text">DOWNLOAD SCHOOL OF HEALTH TECHNOLOGY QUOTA TEMPLATE</span></a>--}}

                            </div>
                            <div class="col-lg-12 col-md-12">
                                <p>Upload the completed Quota Template and select the year</p>
                                <form action="{{ URL::to('admin/quota-import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3 input-group">

                                            <select name="year" class="form-control" >
                                                <option value="" selected>Select Year</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group mb-3 input-group">

                                            <select name="category_id" id="category_id" class="form-control" >
                                                <option value="" selected>Institution Category</option>
                                                <option value="1">University</option>
                                                <option value="2">School of Health Technology</option>

                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group mb-3 input-group">

                                            <div class="custom-file">
                                                <input class="custom-file-input" name="file" id="inputGroupFile02" type="file" />
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            </div>
                                            {{-- <div class="input-group-append"><span class="input-group-text" id="inputGroupFileAddon02">Upload</span></div>--}}
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-primary">UPLOAD EXCEL TEMPLATE</button>
                                        </div>

                                        {{--<div class="col-md-12">
                                            <a href="school-index-upload-2.php" target="_self" class="btn btn-primary">UPLOAD EXCEL TEMPLATE</a>
                                        </div>--}}
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
            <!--table end-->
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


    <script>

        function validateCatId() {

            category_id=  $("#category_id").val();



            if(category_id!=""){

                window.location = "/admin/quota-template-export/" + category_id;
                return true;
            }else{

                alert('Please select the category first');

                return false;
            }
        }


    </script>
@endsection
