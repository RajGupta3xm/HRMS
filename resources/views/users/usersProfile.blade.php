@extends('users.header')
@section('title', 'Users Profile')
@section('content')

<div class="admin_main">

    <div class="admin_contentpart">

        <div class="col-12">

            <div class="userdetails row align-items-center">
                <div class="col-12 mt-4">
                    @if($usersImage)
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-6 text-center">
                            <img src="{{ asset('usersImage/' . $usersImage) }}" alt="profile Pic" class="img-thumbnail rounded-circle" height="100" width="100">
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <form method="post" action="{{ route('user.uploadimage') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employeeImage">Upload Your Image</label>
                                        <input type="file" class="form-control-file" id="employeeImage" name="employeeImage">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif

                    <br>
                    <form class="row form-design" action="#" method="POST">

                        @csrf

                        <div class="form-group col-md-6">

                            <label for="full_name">Full Name</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->name }}" name="full_name" id="full_name" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="email">Official Email Address</label>

                            <input type="email" class="form-control" value="{{ $employeeDetails->officialemail }}" name="email" id="email" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="emergencycontact">Emergency Contact</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->emergencycontact }}" name="emergencycontact" id="emergencycontact" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="pannumber">PAN Number</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->pannumber }}" name="pannumber" id="pannumber" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="currentaddress">Current Address</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->currentaddress }}" name="currentaddress" id="currentaddress" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="department">Department</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->getDepartmentName() }}" name="department" id="department" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="permanentaddress">Permanent Address</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->permanentaddress }}" name="permanentaddress" id="permanentaddress" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="companyexperience">Company Experience</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->comnpanyexperience }}" name="companyexperience" id="companyexperience" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="designation">Designation</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->designation }}" name="designation" id="designation" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="reportingmanager">Reporting Manager</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->reportingmanager }}" name="reportingmanager" id="reportingmanager" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="aadharnumber">Aadhar Number</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->aadharnumber }}" name="aadharnumber" id="aadharnumber" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="contactdetails">Contact Details</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->contactdetails }}" name="contactdetails" id="contactdetails" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="highestqualification">Highest Qualification</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->higestqualification }}" name="highestqualification" id="highestqualification" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="dob">Date of Birth</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->dob }}" name="dob" id="dob" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="personalemail">Personal Email</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->personalemail }}" name="personalemail" id="personalemail" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="city">City</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->city }}" name="city" id="city" disabled>

                        </div>

                        <div class="form-group col-md-6">

                            <label for="joiningdate">Joining Date</label>

                            <input type="text" class="form-control" value="{{ $employeeDetails->joiningdate }}" name="joiningdate" id="joiningdate" disabled>

                        </div>



                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection