@extends('users.header')

@section('title', 'Edit Employee')

@section('content')

<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        @if (isset($status))

        <div class="alert alert-success">

            {{ $status }}

        </div>

        @endif



        @if ($errors->has('allocationpercentage'))

        <div class="alert alert-danger">

            {{ $errors->first('allocationpercentage') }}

        </div>

        @endif



        <div class="row layout-top-spacing">

            <div class="row">

                <div class="col">

                    <div class="widget-heading mb-3">

                        <h5 class="">Edit Employee</h5>

                    </div>

                </div>

            </div>



            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-table-one">

                    <div class="widget-heading">

                        <form method="POST" action="{{ route('add-workesEmployeeStore') }}">

                            @csrf

                            @method('PATCH')



                            <div class="form-group">

                                <label for="userDepartment" class="form-label">Department</label>

                                <select name="userDepartment" class="form-select" id="userDepartment">

                                    <option value="" selected>Select Department</option>

                                    <option value="0" {{ $employee->userDepartment == 0 ? 'selected' : '' }}>Delivery</option>

                                    <!-- <option value="1" {{ $employee->userDepartment == 1 ? 'selected' : '' }}>Marketing</option>

                                    <option value="2" {{ $employee->userDepartment == 2 ? 'selected' : '' }}>Admin</option>

                                    <option value="3" {{ $employee->userDepartment == 3 ? 'selected' : '' }}>HR</option>

                                    <option value="4" {{ $employee->userDepartment == 4 ? 'selected' : '' }}>Business</option>

                                    <option value="5" {{ $employee->userDepartment == 5 ? 'selected' : '' }}>Business Admin</option> -->

                                </select>
                            </div>




                            <!-- <div class="form-group">

                                <label for="name" class="form-label">Designation</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">

                                    <option value="" selected>Select User Designation</option>

                                </select><br>

                            </div> -->
                            <div class="form-group">

                                <label for="name" class="form-label">Designation</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">


                                    <option value="" selected>Select User Designation</option>

                                    @if($employee->userDepartment == 0)
                                    <option value="Project Manager" {{ $employee->userDesignation == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                    <option value="Delivery Head" {{ $employee->userDesignation == 'Delivery Head' ? 'selected' : '' }}>Delivery Head</option>
                                    <option value="Program Manager" {{ $employee->userDesignation == 'Program Manager' ? 'selected' : '' }}>Program Manager</option>
                                    <option value="Technical Architect" {{ $employee->userDesignation == 'Technical Architect' ? 'selected' : '' }}>Technical Architect</option>
                                    <option value="Solution Architect" {{ $employee->userDesignation == 'Solution Architect' ? 'selected' : '' }}>Solution Architect</option>
                                    <option value="Project Coordinator" {{ $employee->userDesignation == 'Project Coordinator' ? 'selected' : '' }}>Project Coordinator</option>
                                    <option value="Junior Software Engineer" {{ $employee->userDesignation == 'Junior Software Engineer' ? 'selected' : '' }}>Junior Software Engineer</option>
                                    <option value="Software Engineer" {{ $employee->userDesignation == 'Software Engineer' ? 'selected' : '' }}>Software Engineer</option>
                                    <option value="Product Manager" {{ $employee->userDesignation == 'Product Manager' ? 'selected' : '' }}>Product Manager</option>
                                    <option value="Senior Software Engineer" {{ $employee->userDesignation == 'Senior Software Engineer' ? 'selected' : '' }}>Senior Software Engineer</option>
                                    <option value="Business Analyst" {{ $employee->userDesignation == 'Business Analyst' ? 'selected' : '' }}>Business Analyst</option>
                                    <option value="Senior Business Analyst" {{ $employee->userDesignation == 'Senior Business Analyst' ? 'selected' : '' }}>Senior Business Analyst</option>
                                    <option value="Software Engineer Trainee" {{ $employee->userDesignation == 'Software Engineer Trainee' ? 'selected' : '' }}>Software Engineer Trainee</option>
                                    <option value="Software Test Engineer" {{ $employee->userDesignation == 'Software Test Engineer' ? 'selected' : '' }}>Software Test Engineer</option>
                                    <option value="Senior Software Test Engineer" {{ $employee->userDesignation == 'Senior Software Test Engineer' ? 'selected' : '' }}>Senior Software Test Engineer</option>
                                    <option value="UI/UX Designer" {{ $employee->userDesignation == 'UX Designer' ? 'selected' : '' }}>UX Designer</option>
                                    <option value="Web Designer" {{ $employee->userDesignation == 'Web Designer' ? 'selected' : '' }}>Web Designer</option>
                                    <option value="Devops Engineer" {{ $employee->userDesignation == 'Devops Engineer' ? 'selected' : '' }}>Devops Engineer</option>

                                    @endif

                                </select><br>

                            </div>

                            <div class="form-group">

                                <label for="employee_Id">Employee Name</label>

                                <select name="employee_Id" class="form-select" id="employee_Id">

                                    <option value="" selected>Select Employee Name</option>

                                </select>

                            </div>



                            <div class="form-group">

                                <label for="percentage">Allocation Percentage</label>

                                <input type="number" name="allocationpercentage" class="form-control" value="{{ $employee->allocationpercentage }}">

                            </div>

                            <div class="row">

                                <div class="col-sm-6">

                                    <label for="">StartDate</label>

                                    <input type="date" class="form-control" name="startdate" value="{{ $employee->startdate }}" placeholder="StartDate">

                                    @error('startdate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>



                                <div class="col-sm-6">

                                    <label for="">EndDate</label>

                                    <input type="date" class="form-control" name="enddate" value="{{ $employee->enddate }}" placeholder="EndDate">

                                    @error('enddate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                            </div>

                            <input type="hidden" name="projectId" value="{{ $employee->project_id }}">

                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">


                            <div class="form-group container">


                                <button type="submit" class="btn btn-success">Update</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        fetchEmployeeName();

        function fetchEmployeeName() {
            var employeeId = "{{ $employee->employee_Id }}";

            if (employeeId !== '') {
                $.ajax({
                    url: '/TMS/public' + '/fetch-employee-name/' + employeeId,
                    type: 'GET',
                    success: function(data) {
                        $('#employee_Id').append('<option value="' + data.id + '" selected>' + data.name + '</option>');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    });
</script>





<script>
    function checkValue(input) {

        if (input.value > 100) {

            input.value = 100;

        }

    }
</script>

<script>
    $(document).ready(function() {

        $("#userDepartment").on('change', function() {

            var userDepartment = $(this).val();

            if (userDepartment !== '') {



                let options = []

                if (userDepartment == 0) {

                    options = ["Select Departments", "Delivery Head", "Program Manager", "Project Manager", "Technical Architect", "Solution Architect", "Project Coordinator", "Junior Software Engineer", "Software Engineer", "Senior Software Engineer", "Business Analyst", "Product Manager", "Senior Business Analyst", "Software Engineer Trainee", "Software Test Engineer", "Senior Software Test Engineer", "UI/UX Designer", "Web Designer", "Devops Engineer"

                    ];
                }
                // } else if (userDepartment == 1) {

                //     options = ["select Designation", "Content Writer", "Seo Executive"];

                // } else if (userDepartment == 2) {

                //     options = ["select Designation", "Account executive"];

                // } else if (userDepartment == 3) {

                //     options = ["select Designation", "HR"];

                // } else if (userDepartment == 4) {

                //     options = ["Business Development Executive"];

                // } else if (userDepartment == 5) {

                //     options = ["select Designation", "CEO", "COO", "Director", "Delivery Head"]

                // }





                let selectOptions = '';

                for (let i = 0; i < options.length; i++) {

                    selectOptions += `<option value="${options[i]}">${options[i]}</option>`

                }



                $("#userDesignation").html(selectOptions)



            } else {

                $('#userDesignation').empty().append('<option value="" selected>Select Employee Name</option>');

            }

        });

    });
</script>

<script>
    $(document).ready(function() {

        $("#userDesignation").on('change', function() {

            var userDesignation = $(this).val();

            if (userDesignation !== '') {

                $.ajax({

                    url: '/TMS/public' + '/fetch-users/' + userDesignation,

                    type: 'GET',

                    success: function(data) {

                        var employee_IdDropdown = $('#employee_Id');

                        employee_IdDropdown.empty();

                        employee_IdDropdown.append(

                            '<option value="" selected>Select Employee Name</option>');

                        $.each(data, function(key, value) {

                            employee_IdDropdown.append('<option value="' + value

                                .id + '">' + value.name + '</option>');

                        });

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            }

        });

    });
</script>



<script>
    function confirmDelete() {

        if (confirm("Are you sure you want to delete this  Team Member Details?")) {

            document.getElementById('deleteForm').submit();

        }

    }
</script>

@endsection