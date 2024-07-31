@extends('users.header')

@section('title', 'Approval Timesheet')

@section('content')
@if(isset($error))
<div class="alert alert-danger">
    {{ $error }}
</div>
@else
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
                        <option>Select Project</option>
                        @php
                        $uniqueProjects = collect($TotalSubmitedData)->unique('projectId')->toArray();
                        @endphp
                        <option value="">All Projects</option>

                        @foreach ($uniqueProjects as $timeEntry)
                        <option value="{{ $timeEntry['projectId'] }}">{{ $timeEntry['projectName'] }}</option>
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

        <div class="col-12">

            <div class="row align-items-center justify-content-between py-4 px-3">

                <!-- <div class="col-3">
                    <div class="searchh_box position-relative">
                        <input class="form-control" type="search" placeholder="Search">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div> -->

            </div>

            <div class="row comman_table px-3">

                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Weeks Of</th>
                                    <th>Submited By</th>
                                    <th>Project</th>
                                    <th>Hours</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="projectDataBody">
                                @php
                                $serialNumber = 1;
                                @endphp


                                @foreach ($TotalSubmitedData as $timeEntry)
                                
                                <tr>
                                    <td>{{ $serialNumber++ }}</td>
                                    <td>{{ $timeEntry['date'] }}</td>
                                    <td>{{$timeEntry['employeeName']}}</td>
                                    <td>{{ $timeEntry['projectName'] }}</td>
                                    <td>{{ $timeEntry['total_hours'] }}</td>
                                    <td>
                                        @if($timeEntry['status'] == 1)
                                        <button id="status-toggle" class="btn btn-sm btn-success" type="submit" value="0">
                                            Approved
                                        </button>
                                        @elseif($timeEntry['status'] == 0)
                                        <button id="status-toggle" class="btn btn-sm btn-warning" type="submit" value="1">
                                            Pending
                                        </button>
                                        @elseif($timeEntry['status'] == 2)
                                        <button id="status-toggle" class="btn btn-sm btn-danger" type="submit" value="1">
                                            Rejected
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($timeEntry['status'] == 1 || $timeEntry['status'] == 2)
                                        <button id="reject-button-{{ $timeEntry['timesheetId'] }}" class="btn btn-sm btn-danger reject-button" type="button" data-timeentry-id="{{ $timeEntry['timesheetId'] }}" disabled>
                                            Reject
                                        </button>
                                            <button class="btn btn-sm btn-success" type="submit" name="status" value="1" disabled>
                                                <input type="hidden" name="timeSheet_Id" value="{{$timeEntry['timesheetId']}}">
                                                Approve
                                            </button>
                                        @elseif($timeEntry['projectManagerStatus'] == 0)
                                        <form id="approval-form-{{ $timeEntry['timesheetId'] }}" method="POST" action="{{ route('update-status', ['timeSheet_Id' => $timeEntry['timesheetId']]) }}">
                                            @csrf
                                            @method('PUT')

                                            <button id="reject-button-{{ $timeEntry['timesheetId'] }}" class="btn btn-sm btn-danger reject-button" type="button" data-timeentry-id="{{ $timeEntry['timesheetId'] }}" data-rejected-employee-id="{{ $timeEntry['approvedBy'] }}">
                                                Reject
                                            </button>

                                            <button class="btn btn-sm btn-success" type="submit" name="status" value="1">
                                                <input type="hidden" name="timeSheet_Id" value="{{$timeEntry['timesheetId']}}">
                                                <input type="hidden" name="approvedBy" value="{{$timeEntry['approvedBy']}}">

                                                Approve
                                            </button>
                                        </form>
                                        @else
                                        <form id="approval-form-{{ $timeEntry['timesheetId'] }}" method="POST" action="{{ route('update-status', ['timeSheet_Id' => $timeEntry['timesheetId']]) }}">
                                            @csrf
                                            @method('PUT')

                                            <button id="reject-button-{{ $timeEntry['timesheetId'] }}" class="btn btn-sm btn-danger reject-button" type="button" data-timeentry-id="{{ $timeEntry['timesheetId'] }}" data-rejected-employee-id="{{ $timeEntry['approvedBy'] }}" disabled>
                                                Reject
                                            </button>

                                            <button class="btn btn-sm btn-success" type="submit" name="status" value="1" disabled>
                                                <input type="hidden" name="timeSheet_Id" value="{{$timeEntry['timesheetId']}}">
                                                <input type="hidden" name="approvedBy" value="{{$timeEntry['approvedBy']}}">

                                                Approve
                                            </button>
                                        </form>
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
@endif

<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Time Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="reject-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="reject-reason">Reason for Rejection</label>
                        <textarea id="reject-reason" name="reason" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="reject-timeSheetId" name="timeSheet_Id" value="">
                    <input type="hidden" name="status" value="2">
                    <input type="hidden" id="reject-rejectedEmployeeId" name="approvedBy" value="">



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() {
        $('button.reject-button').on('click', function() {
            var timeSheetId = $(this).data('timeentry-id');
            var rejectedEmployeeId = $(this).data('rejected-employee-id');

            $('#reject-timeSheetId').val(timeSheetId);
            $('#reject-rejectedEmployeeId').val(rejectedEmployeeId);

            var actionUrl = "{{ route('update-status', ['timeSheet_Id' => ':id']) }}".replace(':id', timeSheetId);
            $('#reject-form').attr('action', actionUrl);

            $('#rejectModal').modal('show');
        });

        $('#getProjectData').on('click', function() {
            var projectId = $('#projects').val();
            $.ajax({
                url: '/HRMS2/public/get-project-data_by-projectmanager',
                type: 'GET',
                data: {
                    projectId: projectId
                },
                success: function(data) {
                    console.log(data);
                    $('#projectDataBody').empty();
                    $.each(data, function(index, entry) {
                        var statusText, statusClass, buttonText;

                        if (entry.status == 1) {
                            statusText = 'Approved';
                            statusClass = 'success';
                            buttonText = 'Approved';
                        } else if (entry.status == 0) {
                            statusText = 'Pending';
                            statusClass = 'warning';
                            buttonText = 'Pending';
                        } else {
                            statusText = 'Rejected';
                            statusClass = 'danger';
                            buttonText = 'Rejected';
                        }

                        var button = '<button class="btn btn-sm btn-' + statusClass + '" type="submit" value="' + (entry.status == 1 ? 0 : 1) + '">' + buttonText + '</button>';

                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + entry.date + '</td>' +
                            '<td>' + entry.employee.name + '</td>' +
                            '<td>' + entry.project.projectname + '</td>' +
                            '<td>' + entry.total_hours + '</td>' +
                            '<td>' + button + '</td>' +
                            '</tr>';
                        $('#projectDataBody').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching project data:", error);
                }
            });
        });
    });
</script>

@endsection