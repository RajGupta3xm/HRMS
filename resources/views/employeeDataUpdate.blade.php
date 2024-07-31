@extends('header')

@section('title', 'Employee Update')



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

                    <h2>Update Employee</h2>

                    <i class="bi bi-x"></i>

                </div>

                @foreach ($employeeData as $data)

                    <form method="POST" action="{{ route('employeeUpdateStore') }}">

                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <input type="hidden" name="id" value="{{ $data['id'] }}">

                                <label for="empId" class="form-label">Emp Id</label>

                                <input type="text" class="form-control" name="empId" placeholder="Emp Id"

                                    value="{{ $data['empId'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="emergencyContact" class="form-label">Emergency Contact</label>

                                <input type="text" class="form-control" name="emergencycontact"

                                    value="{{ $data['emergencycontact'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="panNumber" class="form-label">Pan Number</label>

                                <input type="text" class="form-control" name="pannumber"

                                    value="{{ $data['pannumber'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Name</label>

                                <input type="text" class="form-control" name="name" value="{{ $data['name'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">Current Address</label>

                                <input type="text" class="form-control" name="currentaddress"

                                    value="{{ $data['currentaddress'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="trainingCompletion" class="form-label">Training Completion (if

                                    applicable)</label>

                                <input type="text" class="form-control" name="trainingcompletion"

                                    value="{{ $data['trainingcompletion'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Department</label>

                                <select name="userDepartment" class="form-select" id="userDepartment">

                                    <option value="" {{ $data->department == "" ? 'selected' : '' }}>Select Department</option>

                                    <option value="0" {{ $data->department == "0" ? 'selected' : '' }}>Delivery</option>

                                    <!-- <option value="1" {{ $data->department == "1" ? 'selected' : '' }}>Marketing</option>

                                    <option value="2" {{ $data->department == "2" ? 'selected' : '' }}>Admin</option>

                                    <option value="3" {{ $data->department == "3" ? 'selected' : '' }}>HR</option>

                                    <option value="4" {{ $data->department == "4" ? 'selected' : '' }}>Business</option>

                                                                        <option value="5" {{ $data->department == "5" ? 'selected' : '' }}>Business Admin</option> -->



                                </select>

                            </div>

                            

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">Permanent Address</label>

                                <input type="text" class="form-control" name="permanentaddress"

                                    value="{{ $data['permanentaddress'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="trainingCompletion" class="form-label">Company Experience (1,2,3..)</label>

                                <input type="number" class="form-control" name="comnpanyexperience"

                                    value="{{ $data['comnpanyexperience'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Designation</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">


                                </select>

                            </div>

                            

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">City</label>

                                <input type="text" class="form-control" name="city" value="{{ $data['city'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="trainingCompletion" class="form-label">Employee Status (Active/Inactive)</label>

                                <input type="text" class="form-control" name="employeestatus"

                                    value="{{ $data['employeestatus'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Reporting Manager</label>

                                <input type="text" class="form-control" name="reportingmanager"

                                    value="{{ $data['reportingmanager'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">Date Of Birth</label>

                                <input type="date" class="form-control" name="dob" value="{{ $data['dob'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="trainingCompletion" class="form-label">Last Working Day</label>

                                <input type="date" class="form-control" name="lastworkingday"

                                    value="{{ $data['lastworkingday'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Official Email Id</label>

                                <input type="email" class="form-control" name="officialemail"

                                    value="{{ $data['officialemail'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">Joining Date</label>

                                <input type="date" class="form-control" name="joiningdate"

                                    value="{{ $data['joiningdate'] }}">

                            </div>

                           

                            

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="personalemail" class="form-label">Personal Email Id</label>

                                <input type="email" class="form-control" name="personalemail"

                                    value="{{ $data['personalemail'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="higestqualification" class="form-label">Highest Qualification</label>

                                <input type="text" class="form-control" name="higestqualification"

                                    value="{{ $data['higestqualification'] }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="name" class="form-label">Contact Details</label>

                                <input type="text" class="form-control" name="contactdetails"

                                    value="{{ $data['contactdetails'] }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="currentAddress" class="form-label">Aadhar Number</label>

                                <input type="text" class="form-control" name="aadharnumber"

                                    value="{{ $data['aadharnumber'] }}">

                            </div>

                        </div>

                @endforeach

                <div class="row mt-3">

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-primary">Update</button>

                        <button type="button" class="btn btn-secondary">Cancel</button>

                    </div>

                </div>

                </form>

            </div>

        </div>

    </div>

    <script>
    $(document).ready(function() {
        var userDepartment = "{{ $data->department }}";
        var userDesignation = "{{ $data->designation }}";

        if (userDepartment !== '') {
            // Populate designation based on initial department value
            populateDesignation(userDepartment, userDesignation);
        }

        $("#userDepartment").on('change', function() {
            var selectedDepartment = $(this).val();
            populateDesignation(selectedDepartment, '');
        });

        function populateDesignation(department, selectedDesignation) {
            var designationOptions = [];

            switch (department) {
                case '0': // Delivery
                    designationOptions = ["Delivery Head", "Program Manager", "Project Manager", "Technical Architect", "Solution Architect", "Project Coordinator", "Junior Software Engineer", "Software Engineer", "Senior Software Engineer", "Business Analyst", "Product Manager", "Senior Business Analyst", "Software Engineer Trainee", "Software Test Engineer", "Senior Software Test Engineer", "UX Designer", "Web Designer", "Devops Engineer"];
                    break;

                default:
                    break;
            }

            var selectOptions = '<option value="">Select Designation</option>';

            for (var i = 0; i < designationOptions.length; i++) {
                var isSelected = designationOptions[i] === selectedDesignation ? 'selected' : '';
                selectOptions += '<option value="' + designationOptions[i] + '" ' + isSelected + '>' + designationOptions[i] + '</option>';
            }

            $("#userDesignation").html(selectOptions);
        }
    });
</script>



    

@endsection

