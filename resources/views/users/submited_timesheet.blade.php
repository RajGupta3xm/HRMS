@extends('users.header')

@section('title', 'Users Profile')

@section('content')

<div class="admin_main">

    <div class="row comman_design">

        <div class="row align-items-center">

            <div class="col-md-3 mt-2">

                <div class="form-group">
                    <label for="Start Date">Start Date</label>
                    <input type="date" class="form-control" name="startDate" id="startDate">
                </div>

            </div>

            <div class="col-md-3 mt-2">

                <div class="form-group">
                    <label for="End Date">End Date</label>
                    <input type="date" class="form-control" name="endDate" id="endDate">
                </div>

            </div>

            <div class="col-md-3 mt-2">
                <div class="form-group">
                    <label for="projects">Choose a project:</label>
                    <select name="projects" id="projects" class="form-control">
                    

                        <option value="">All Projects</option>
                        @foreach ($submitedProjects->unique('project.id') as $timeEntry)
                        
                        <option value="{{ $timeEntry->project->id }}">{{ $timeEntry->project->projectname }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="col-md-3 mt-2">
                <div class="d-inline-flex p-2">
                    <div class="form-group">
                        <label for="End Date"></label>
                        <button type="button" class="form-control btn btn-success" id="getProjectData">Get Data</button>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-3">
            @foreach($employeeTotalHours as $employee)
            @if($employee['pendingTimesheetsCount'] > 0)
            <div class="alert alert-danger" role="alert">
                Alert: You have {{ $employee['pendingTimesheetsCount'] }} pending timesheet.
                @foreach($employee['pendingTimesheetDates'] as $pending)
                {{ $pending }},
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
        <div class="col-12">

            <div class="row align-items-center justify-content-between py-4 px-3">

                <div class="col-3">

                    <!-- <div class="searchh_box position-relative">

                        <input class="form-control" type="search" placeholder="Search">

                        <button><i class="fas fa-search"></i></button>
                        
                    </div> -->

                </div>

            </div>

            <div class="row comman_table px-3">

                <div class="col-12">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Weeks Of</th>

                                    <th>Project</th>

                                    <th>Hours</th>
                                    <th>Approved By / Rejected By</th>
                                    <th>Reason</th>
                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody id="projectDataBody">

                                @php

                                $serialNumber = 1;

                                @endphp



                                @foreach ($submitedProjects as $timeEntry)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $timeEntry->date }}</td>
                                    <td>{{ $timeEntry->project->projectname }}</td>
                                    <td>{{ $timeEntry->total_hours }}</td>
                                    <td>
                                        {{$timeEntry->approvedByEmployee->name ?? 'N/A'}}
                                    </td>
                                    <td>{{$timeEntry->rejectionReason ?? 'N/A'}}</td>
                                    <td>
                                        @if($timeEntry->status == 1)
                                        <button class="btn btn-sm btn-success">Approved</button>
                                        @elseif($timeEntry->status == 0)
                                        <button class="btn btn-sm btn-warning">Pending</button>
                                        @elseif($timeEntry->status == 2)
                                        <button class="btn btn-sm btn-danger">Rejected</button>
                                        @endif
                                    </td>

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
{!! $submitedProjects->withQueryString()->links('pagination::bootstrap-5') !!}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
    $(document).ready(function() {
    $('#getProjectData').on('click', function() {
        // var employeeId = $('#employeeIds').val();
        var projectId = $('#projects').val();

        $.ajax({
            url: '/HRMS2/public/get-project-data',
            type: 'GET',
            data: {
                // employeeId: employeeId,
                projectId: projectId,
            },
            success: function(response) {
                console.log(response);

                $('#projectDataBody').empty();

                if (response.length > 0) {
                    response.forEach(function(timeEntry, index) {
                        var projectName = timeEntry.project.projectname;
                        var approvedEmployeeNames = timeEntry.approved_by_employee ? timeEntry.approved_by_employee.name : 'Not Approved';
                        var reason = timeEntry.project?.rejectionReason || 'N/A';

                        var statusLabel = getStatusLabel(timeEntry.status);

                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + timeEntry.date + '</td>' +
                            '<td>' + projectName + '</td>' +
                            '<td>' + timeEntry.total_hours + '</td>' +
                            '<td>' + approvedEmployeeNames + '</td>' +
                            '<td>' + reason + '</td>' +

                            '<td>' + statusLabel + '</td>' +
                            '</tr>';

                        $('#projectDataBody').append(row);
                    });
                } else {
                    $('#projectDataBody').append('<tr><td colspan="6">No data available</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching project data:', error);
                $('#projectDataBody').empty().append('<tr><td colspan="6">Error fetching data</td></tr>');
            }
        });
    });

    function getStatusLabel(status) {
        if (status == 1) {
            return '<button class="btn btn-sm btn-success">Approved</button>';
        } else if (status == 0) {
            return '<button class="btn btn-sm btn-warning">Pending</button>';
        } else if (status == 2) {
            return '<button class="btn btn-sm btn-danger">Rejected</button>';
        } else {
            return 'Unknown';
        }
    }
});


</script>
@endsection