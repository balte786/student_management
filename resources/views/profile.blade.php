@extends('layouts.main')

@section('content')
<?php use \App\Http\Controllers\SchoolController; ?>
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">{{ SchoolController::fetchFeilds('schools','school_name',$user['school_id']); }}</h1>
            <ul>
                <li><a href="">Profile</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{{ URL::to('profile-update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="firstName1">First name</label>
                            <input class="form-control" id="firstName1" type="text" name="first_name" placeholder="Enter your first name" value="{{$user['first_name']}}"  />
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="lastName1">Last name</label>
                            <input class="form-control" id="lastName1" type="text" placeholder="Enter your last name" name="last_name"  value="{{$user['last_name']}}"  />
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="exampleInputEmail1" type="email" placeholder="Enter email" name="email"   value="{{$user['email']}}"  />
                            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="phone">Phone</label>
                            <input class="form-control" id="phone" placeholder="Enter phone" name="phone"  value="{{$user['phone_number']}}"  />
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="credit1">Category</label>
                            <input class="form-control" id="credit1" placeholder="Card" value="{{ SchoolController::fetchFeilds('school_categories','category_name',$user['category_id']); }}" readonly/>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="school">School Name:</label>
                            <input class="form-control" id="school" value="{{ SchoolController::fetchFeilds('schools','school_name',$user['school_id']); }}" readonly />
                        </div>
                        <!--<div class="col-md-6 form-group mb-3">
                            <label for="haddress">Hospital Address:</label>
                            <input class="form-control" id="address" placeholder="Hospital Address" />
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="picker1">State</label>
                            <select class="form-control">
                                <option selected>Select State</option>
                                                    <option value="Abia">Abia</option>
<option value="Adamawa">Adamawa</option>
<option value="Anambra">Anambra</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Enugu">Enugu</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nasarawa">Nasarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>
<option value="FCT Abuja">FCT Abuja</option>
                            </select>
                        </div>


                        <div class="col-md-6 form-group mb-3">
                            <label for="picker1">LGA</label>
                            <select class="form-control">
                            <option selected>Select LGA</option>
                                                    <option value="Alimosho">Alimosho</option>
                                                    <option value="Agege">Agege</option>
                                                    <option value="Ajeromi Ifelodun">Ajeromi Ifelodun</option>
                                                    <option value="Apapa">Apapa</option>
                                                    <option value="Amuwo Odofin">Amuwo Odofin</option>
                                                    <option value="Badagry">Badagry</option>
                                                    <option value="Epe">Epe</option>
                                                    <option value="Eti Osa">Eti Osa</option>
                                                    <option value="Ibeju-Lekki">Ibeju-Lekki</option>
                                                    <option value="Ifako Ijaiye">Ifako Ijaiye</option>
                                                    <option value="Ikeja">Ikeja</option>
                                                    <option value="Ikorodu">Ikorodu</option>
                                                    <option value="Kosofe">Kosofe</option>
                                                    <option value="Lagos Island">Lagos Island</option>
                                                    <option value="Lagos Mainland">Lagos Mainland</option>
                                                    <option value="Mushin">Mushin</option>
                                                    <option value="Ojo">Ojo</option>
                                                    <option value="Oshodi/Isolo">Oshodi/Isolo</option>
                                                    <option value="Shomolu">Shomolu</option>
                                                    <option value="Surulere">Surulere</option>
                            </select>
                        </div>-->

                        <div class="col-md-12">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
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
