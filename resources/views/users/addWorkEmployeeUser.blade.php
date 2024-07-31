@extends('users.header')

@section('title', 'Add Team Works')

@section('content')

<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="row">

                <div class="col">

                    <div class="widget-heading mb-3">

                        <h5 class="">Insert Employee</h5>

                    </div>

                </div>

            </div>

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

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-table-one">

                    <div class="widget-heading">

                        <form method="POST" action="{{ route('add-workesEmployeeStore') }}">

                            @csrf

                            <h5 style="text-align: center;">Employee Details</h5>

                            <div class="form-group">

                                <label for="name" class="form-label">Department</label>

                                <select name="userDepartment" class="form-select" id="userDepartment">

                                    <option value="" selected>Selected Department</option>

                                    <option value="0">Delivery</option>

                                    <!-- <option value="1">Marketing</option>

                                        <option value="2">Admin</option>

                                        <option value="3">HR</option>

                                        <option value="4">Business</option>

                                                                                <option value="5">Business Admin</option>  -->



                                </select><br>

                            </div>

                            <div class="form-group">

                                <label for="name" class="form-label">Designation</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">

                                    <option value="" selected>Select User Designation</option>

                                </select><br>

                            </div>

                            <div class="form-group">

                                <label for="employee_Id">Employee Name</label>

                                <select name="employee_Id" class="form-select" id="employee_Id">

                                    <option value="" selected>Select User</option>

                                </select>

                            </div>

                            <!-- <div class="form-group">

                                <label for="percentage">Allocation Percentage</label>

                                <input class="form-control" data-qa="input-number" type="number" pattern="[0-9]*" id="answer" min="1" max="100" name="allocationpercentage" value="" oninput="checkValue(this)">

                                <abbr title="Percentage" class="input-type__type">%</abbr>

                            </div> -->
                            <div class="form-group">
        <label for="allocationpercentage">Allocation Percentage</label>
        <input class="form-control" type="number" name="allocationpercentage" id="allocationpercentage" min="1" max="100" oninput="checkAllocationPercentage()" required>
        <span id="allocation-error" class="text-danger"></span> <!-- Error message container -->
    </div>



                            <div class="row">

                                <!-- <div class="col-sm-6">

                                    <label for="">StartDate</label>

                                    <input type="date" class="form-control" name="startdate" placeholder="StartDate">

                                    @error('startdate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div> -->
                                <div class="col-sm-6">
                                    <label for="startdate">Start Date</label>
                                    <input type="date" class="form-control" name="startdate" id="startdate" placeholder="Start Date" min="{{ $projectData['projectstartdate'] }}" max="{{ $projectData['projectenddate'] }}">
                                    <span id="startdate-error" class="text-danger"></span> <!-- Error message container -->
                                    @error('startdate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- <div class="col-sm-6">

                                    <label for="">EndDate</label>

                                    <input type="date" class="form-control" name="enddate" placeholder="EndDate">

                                    @error('enddate')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div> -->
                                <div class="col-sm-6">
                                    <label for="enddate">End Date</label>
                                    <input type="date" class="form-control" name="enddate" id="enddate" placeholder="End Date">
                                    <span id="enddate-error" class="text-danger"></span> <!-- Error message container -->
                                    @error('enddate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <input type="hidden" name="projectId" value=" {{ $projectData['id'] }}">

                            <div class="text-center">

                                <button type="submit" class="btn btn-success" name="submit">Save</button>

                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <div class="col-xl-8 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-table-two p-4">

                    @if (Session::has('success'))

                    <div class="alert alert-success">

                        {{ Session::get('success') }}

                    </div>

                    @endif

                    @if (Session::has('error'))

                    <div class="alert alert-danger">

                        {{ Session::get('error') }}

                    </div>

                    @endif

                    <div class="widget-content">

                        <div class="table-responsive">

                            <table class="table Common_table text-center">

                                <thead>

                                    <tr>

                                        <th>

                                            <div class="th-content">#</div>

                                        </th>

                                        <th>

                                            <div class="th-content">Name</div>

                                        </th>
                                        <th>

                                            <div class="th-content">Designation</div>

                                        </th>

                                        <th>

                                            <div class="th-content">Start Date</div>

                                        </th>

                                        <th>

                                            <div class="th-content th-heading">End Date</div>

                                        </th>



                                        <th>

                                            <div class="th-content">Allocation Percentage</div>

                                        </th>



                                        <th>

                                            <div class="th-content">Actions</div>

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @php $sn = 1; @endphp

                                    @foreach ($addworkesEmployees as $addworkesEmployee)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $usersDetails[$addworkesEmployee->employee_Id] }}</td>

                                        <td>{{$addworkesEmployee->userDesignation}}</td>
                                        <td>{{ $addworkesEmployee->startdate }}</td>
                                        <td>{{ $addworkesEmployee->enddate }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ $addworkesEmployee->allocationpercentage }} %</span>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('deleteEmployee', ['id' => $addworkesEmployee->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="confirmDelete()">
                                                    <i class="fa fa-trash text-primary p-1"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('editEmployee', ['id' => $addworkesEmployee->id]) }}">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>



                            </table>

                        </div>
                        {!! $addworkesEmployees->withQueryString()->links('pagination::bootstrap-5') !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Function to handle allocation percentage validation and AJAX call
    function checkAllocationPercentage() {
        var allocationPercentage = document.getElementById('allocationpercentage').value;
        var employeeId = document.getElementById('employee_Id').value; // Assuming you have an employee ID available
        if (allocationPercentage > 100) {
            document.getElementById('allocation-error').textContent = "Allocation percentage cannot be more than 100%";
            return;
        } else {
            document.getElementById('allocation-error').textContent = ""; // Clear error message if valid
        }
        
        // AJAX call to check total allocation percentage
        $.ajax({
            url: '{{route('check-allocation')}}', 
            type: 'POST',
            data: {
                employee_id: employeeId,
                allocation_percentage: allocationPercentage,
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function(response) {
                if (response.error) {
                    document.getElementById('allocation-error').textContent = response.message;
                } else {
                    document.getElementById('allocation-error').textContent = ""; // Clear error message if valid
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Event listener for allocation percentage input
    $(document).ready(function() {
        $('#allocationpercentage').on('input', function() {
            checkAllocationPercentage();
        });
    });
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

<script>
    $(document).ready(function() {

        $("#userDesignation").on('change', function() {

            var userDesignation = $(this).val();

            if (userDesignation !== '') {

                $.ajax({

                    url: '/TMS/public/fetch-users/' + userDesignation,

                    type: 'GET',

                    success: function(data) {

                        var employee_IdDropdown = $('#employee_Id');

                        employee_IdDropdown.empty();

                        employee_IdDropdown.append(

                            '<option value="" selected>Select User</option>');

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var projectStartDate = '{{ $projectData["projectstartdate"] }}';
        var projectEndDate = '{{ $projectData["projectenddate"] }}';

        document.getElementById('enddate').setAttribute('min', projectStartDate);
        document.getElementById('enddate').setAttribute('max', projectEndDate);
    });
</script>



@endsection