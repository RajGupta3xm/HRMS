@endphp

@extends('header')

@section('title', 'Add Employee')



@section('content')

<div class="container mt-3">

    <div class="card">

        @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        @if (session('status'))

        <div class="alert alert-success">

            {{ session('status') }}

        </div>

        @endif



        <div class="card-body">

            <div class="d-flex align-items-center justify-content-between">

                <h2>Add Employee</h2>

                <i class="bi bi-x"></i>



            </div>

            <form method="POST" action="{{ route('employeeStore') }}" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="empId" class="form-label">Emp Id</label>

                        <input type="text" class="form-control" name="empId" placeholder="Emp Id">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="emergencyContact" class="form-label">Emergency Contact</label>

                        <input type="number" class="form-control" name="emergencycontact" placeholder="Emergency Contact">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="panNumber" class="form-label">Pan Number</label>

                        <input type="text" class="form-control" name="pannumber" placeholder="Pan Number">

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Name</label>

                        <input type="text" class="form-control" name="name" placeholder="Name">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">Current Address</label>

                        <input type="text" class="form-control" name="currentaddress" placeholder="Current Address">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="trainingCompletion" class="form-label">Training Completion (if applicable)</label>

                        <input type="text" class="form-control" name="trainingcompletion" placeholder="Training Completion">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Department</label>





                        <select name="userDepartment" class="form-select" id="userDepartment">

                            <option value="" selected>Select Department</option>

                            <option value="0">Delivery</option>

                            <!-- <option value="1">Marketing</option>

                            <option value="2">Admin</option>

                            <option value="3">HR</option>

                            <option value="4">Business</option>

                            <option value="5">Business Admin</option> -->

                        </select>



                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">Permanent Address</label>

                        <input type="text" class="form-control" name="permanentaddress" placeholder="Permanent Address">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="trainingCompletion" class="form-label">Company Experience (1,2,3..)</label>

                        <input type="number" class="form-control" name="comnpanyexperience" placeholder="Company Experience">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Designation</label>

                        <select name="userDesignation" class="form-select" id="userDesignation">

                            <option value="" selected>Select Designation</option>

                        </select>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">City</label>

                        <input type="text" class="form-control" name="city" placeholder="City">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="trainingCompletion" class="form-label">Employee Status (Active/Inactive)</label>

                        <input type="text" class="form-control" name="employeestatus" placeholder="Employee Status">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Reporting Manager</label>

                        <input type="text" class="form-control" name="reportingmanager" placeholder="Reporting Manager">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">Date Of Birth</label>

                        <input type="date" class="form-control" name="dob" placeholder="Date Of Birth">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="trainingCompletion" class="form-label">Last Working Day</label>

                        <input type="date" class="form-control" name="lastworkingday" placeholder="Last Working Day">

                    </div>



                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Official Email Id</label>

                        <input type="email" class="form-control" name="officialemail" placeholder="Official Email Id">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">Joining Date</label>

                        <input type="date" class="form-control" name="joiningdate" placeholder="Joining Date">

                    </div>



                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="personalemail" class="form-label">Personal Email Id</label>

                        <input type="email" class="form-control" name="personalemail" placeholder="Personal Email Id">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="higestqualification" class="form-label">Highest Qualification</label>

                        <input type="text" class="form-control" name="higestqualification" placeholder="Highest Qualification">

                    </div>



                </div>



                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label for="name" class="form-label">Contact Details</label>

                        <input type="number" class="form-control" name="contactdetails" placeholder="Contact Details">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label for="currentAddress" class="form-label">Aadhar Number</label>

                        <input type="number" class="form-control" name="aadharnumber" placeholder="Aadhar Number">

                    </div>





                </div>





                <div class="row mt-3">

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-primary">Add</button>

                        <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function goBack() {

        window.history.back();

    }
</script>

<script>
    $(document).ready(function() {

        $("#userDepartment").on('change', function() {

            var userDepartment = $(this).val();

            if (userDepartment !== '') {



                let options = []

                if (userDepartment == 0) {

                    options = ["Select Departments", "Delivery Head", "Program Manager", "Project Manager", "Technical Architect", "Solution Architect", "Project Coordinator", "Junior Software Engineer", "Software Engineer", "Senior Software Engineer", "Business Analyst", "Product Manager", "Senior Business Analyst", "Software Engineer Trainee", "Software Test Engineer", "Senior Software Test Engineer", "UX Designer", "Web Designer", "Devops Engineer"

                    ];
                }

                // } else if (userDepartment == 1) {

                //     options = ["Content Writer", "Seo Executive"];

                // } else if (userDepartment == 2) {

                //     options = ["Account executive", "CEO", "COO", "Director", "Delivery Head"];

                // } else if (userDepartment == 3) {

                //     options = ["HR"];

                // } else if (userDepartment == 4) {

                //     options = ["Business Development Executive"];

                // } else if (userDepartment == 5) {

                //     options = ["CEO", "COO", "Director", "Delivery Head"]

                // }





                let selectOptions = '';

                for (let i = 0; i < options.length; i++) {

                    selectOptions += `<option value="${options[i]}">${options[i]}</option>`

                }



                $("#userDesignation").html(selectOptions)



            } else {

                $('#userDesignation').empty().append('<option value="" selected>Select User</option>');

            }

        });

    });
</script>

@endsection