@extends('users.header')
@section('title', 'Employee Hours')

@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Employee Hours</h3>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Employee Total Hours</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>S.No</th>
                                        <th>Employee Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Submitted TimeSheets</th>
                                        <th>Pending TimeSheets</th>
                                        <th>Total Hours Worked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $iterations = 1;
                                    @endphp
                                    @foreach ($employeeTotalHours as $employeeId => $employeeData)
                                        <tr style="text-align: center;">
                                            <td>{{ $iterations++ }}</td>
                                            <td>
                                                <span class="badge-primary" style="font-size: 18px;">{{ $employeeData['name'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge-info" style="font-size: 18px;">{{ $employeeData['startDate'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge-info" style="font-size: 18px;">{{ $employeeData['endDate'] }}</span>
                                            </td>
                                            <td>
                                                    {{ $employeeData['submittedTimesheetsCount'] }}
                                            </td>
                                            <td>
                                                    {{ $employeeData['pendingTimesheetsCount'] }}<br>
                                                    @foreach($employeeData['pendingTimesheetDates'] as $pending)
                                                    {{ $pending }},
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge-success" style="font-size: 18px;">{{ $employeeData['total_hours'] }} Hours</span>
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
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6 text-center">
                <button onclick="goBack()" class="btn btn-primary">Back</button>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
