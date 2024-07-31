@extends('users.header')

@section('title', 'Users Profile')

@section('content')

<div class="admin_main">
    <div class="container-fluid">
        @if(session('update_image'))
        <script>
            window.onload = function() {
                alert('Please upload your image.');
            };
        </script>
        @endif

        <div class="row comman_design px-4 bg-transparent mt-4 border-0">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(auth()->user()->isProjectManager())
            <div class="row">
                <div class="middle-content container-xxl p-0">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 col-md-12 col-12 layout-spacing">
                            <div class="widget widget-card-four shadow-custom">
                                <div class="widget-content">
                                   
                                    <form id="fetchDataForm" action="{{ route('fetch.dataByPm') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="employeeid" value="{{ Auth::user()->employee_Id }}">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 col-12 mt-4 mt-md-0">
                                                <div class="">
                                                    <label for="start_date" class="fs-6 fw-light mb-1">Start Date</label>
                                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-12 mt-4 mt-md-0">
                                                <div class="">
                                                    <label for="end_date" class="fs-6 fw-light mb-1">End Date</label>
                                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <button type="submit" class="btn btn-primary mt-4 mb-0">Get Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four shadow-custom">
                                <div class="widget-content">
                                    <div class="w-header">
                                        <div class="w-info">
                                            <h6 class="value">Approved Timesheet</h6>
                                        </div>
                                    </div>
                                    <div class="w-content p-0 mt-2">
                                        <div class="w-info p-0">
                                            <div class="d-flex align-items-baseline gap-2">
                                                <p class="value mb-0 mt-0 p-0">
                                                    <a href="{{ route('approvedDataByPm') }}" id="approvedCountLink">
                                                        <span class="text-warning fs-4 fw-semibold" id="approvedCount">{{ $approvedCount }}</span>
                                                    </a>
                                                </p>
                                                @if($approvedCount <= 10) <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                                    @else
                                                    <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-progress-stats mt-1">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $approvedCount }}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four shadow-custom">
                                <div class="widget-content">
                                    <div class="w-header">
                                        <div class="w-info">
                                            <h6 class="value">Pending Timesheet</h6>
                                        </div>
                                    </div>
                                    <div class="w-content p-0 mt-2">
                                        <div class="w-info p-0">
                                            <div class="d-flex align-items-baseline gap-2">
                                                <p class="value mb-0 mt-0 p-0">
                                                    <a href="{{ route('pendingDataByPm') }}" id="pendingCount">
                                                        <span class="text-warning fs-4 fw-semibold" id="pendingCount">{{ $pendingCount }}</span>
                                                    </a>
                                                </p>
                                                @if($pendingCount <= 10) <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                                    @else
                                                    <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-progress-stats mt-1">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $pendingCount }}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four shadow-custom">
                                <div class="widget-content">
                                    <div class="w-header">
                                        <div class="w-info">
                                            <h6 class="value">Rejected Timesheet</h6>
                                        </div>
                                    </div>
                                    <div class="w-content p-0 mt-2">
                                        <div class="w-info p-0">
                                            <div class="d-flex align-items-baseline gap-2">
                                                <p class="value mb-0 mt-0 p-0">
                                                    <a href="{{ route('rejectedDataByPm') }}" id="rejectedCount">
                                                        <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $rejectedCount }}</span>
                                                    </a>
                                                </p>
                                                @if($rejectedCount <= 10) <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                                    @else
                                                    <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-progress-stats mt-1">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $rejectedCount }}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="bg-white rounded-3 shadow pt-3 pb-4 px-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-5 mt-2">
                            <div class="form-group">
                                <label for="Start Date">Start Date</label>
                                <input type="date" class="form-control" name="startDate" id="startDate">
                            </div>
                        </div>
                        <div class="col-md-5 mt-2">
                            <div class="form-group">
                                <label for="End Date">End Date</label>
                                <input type="date" class="form-control" name="endDate" id="endDate">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="d-inline-flex p-2">
                                <div class="form-group">
                                    <label for="End Date"></label>
                                    <button type="button" class="form-control btn btn-success" id="getProjectData">Get Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row align-items-center justify-content-between py-4 px-3">
                            <div class="col-auto">
                                <div class="headleft">
                                    <h2>Assign Projects</h2>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="searchh_box position-relative">
                                    <input class="form-control" type="search" placeholder="Search">
                                    <button><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row comman_table px-3">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Project Name</th>
                                                <th>Project Manager</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Allocation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $serialNumber = 1;
                                            @endphp
                                            @foreach ($usersDetailsGet as $projects)
                                
                                            <tr>
                                                <td>{{ $serialNumber++ }}</td>
                                                   <td>{{ $projects->project['projectname'] }}</td>


                                                <td>
                                                    @if (isset($projectManagersName[$projects->project_id]))
                                                    {{ $projectManagersName[$projects->project_id] }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>{{ $projects['startdate'] }}</td>
                                                <td>{{ $projects['enddate'] }}</td>
                                                <td>{{ $projects['allocationpercentage'] }} %</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Content for non-Project Managers -->
            <div class="bg-white rounded-3 shadow pt-3 pb-4 px-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-5 mt-2">
                        <div class="form-group">
                            <label for="Start Date">Start Date</label>
                            <input type="date" class="form-control" name="startDate" id="startDate">
                        </div>
                    </div>
                    <div class="col-md-5 mt-2">
                        <div class="form-group">
                            <label for="End Date">End Date</label>
                            <input type="date" class="form-control" name="endDate" id="endDate">
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="d-inline-flex p-2">
                            <div class="form-group">
                                <label for="End Date"></label>
                                <button type="button" class="form-control btn btn-success" id="getProjectData">Get Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row align-items-center justify-content-between py-4 px-3">
                        <div class="col-auto">
                            <div class="headleft">
                                <h2>Assign Projects</h2>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="searchh_box position-relative">
                                <input class="form-control" type="search" placeholder="Search">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row comman_table px-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Project Name</th>
                                            <th>Project Manager</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Allocation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $serialNumber = 1;
                                        @endphp
                                        @foreach ($usersDetailsGet as $projects)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $projects->project['projectname'] }}</td>
                                            <td>
                                                @if (isset($projectManagersName[$projects->project_id]))
                                                {{ $projectManagersName[$projects->project_id] }}
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>{{ $projects['startdate'] }}</td>
                                            <td>{{ $projects['enddate'] }}</td>
                                            <td>{{ $projects['allocationpercentage'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {!! $usersDetailsGet->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fetchDataForm').submit(function(event) {
            event.preventDefault(); // Prevent normal form submission

            // Retrieve the employee ID from a hidden input field or other accessible location
            var employeeid = '{{ Auth::user()->employee_Id }}'; // Replace with how you retrieve employeeid
            console.log(employeeid);
            var formData = $(this).serialize(); // Serialize form data
            formData += '&employeeid=' + employeeid; // Append employeeid to form data

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Update counts in HTML
                    $('#approvedCount').text(response.approvedCount);
                    $('#pendingCount').text(response.pendingCount);
                    $('#rejectedCount').text(response.rejectedCount);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>



@endsection