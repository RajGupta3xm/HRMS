@extends('header')

@section('title', 'Total Logs Hours')



@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-6">

            <h3 class="text-center">Employees</h3>

        </div>

    </div>



    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">

                <h3 class="text-center"><b>Total Logs Hour</b></h3>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>S.No.</th>

                                    <th>Project Name</th>
                                    <th>Project Manager</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Working Hours</th>

                                </tr>

                            </thead>

                            <tbody>

                                @php

                                $iteration = 1;

                                @endphp

                                @foreach ($projectHours as $projectId => $projectData)

                                <tr style="text-align: center;">

                                    <td>{{ $iteration++ }}</td>

                                    <td>

                                        <span class="badge badge-success" style="font-size: 18px;">

                                            {{ $projectData['name'] }}

                                        </span>



                                    </td>
                                    <td>

                                        <span class="badge badge-primary" style="font-size: 18px;">

                                            {{ $projectData['project_manager'] }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge badge-info" style="font-size: 18px;">

                                            {{ $projectData['startDate'] }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge badge-primary" style="font-size: 18px;">

                                            {{ $projectData['endDate'] }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge badge-white" style="font-size: 18px;">

                                            <a href="{{ route('employee.hours', ['id' => $projectData['projectId']]) }}">

                                                {{ $projectData['total_hours'] }} Hours

                                            </a>

                                        </span>

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

 {!! $allProjects->withQueryString()->links('pagination::bootstrap-5') !!}




<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection