@extends('users.header')
@section('title', 'Team Mate Sheet')

@section('content')
<div class="admin_main">

    @if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @else
    <div class="row comman_design">
        <div class="row align-items-center">
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label for="Start Date">Start Date</label>
                    <input type="date" class="form-control" name="startDate" id="startDate">
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label for="End Date">End Date</label>
                    <input type="date" class="form-control" name="endDate" id="endDate">
                </div>
            </div>
            <div class="col-md-4 mt-2">

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
                        <h2>Assign Projects </h2>
                    </div>
                </div>
                <!-- <div class="col-12 col-md-3 mt-2 mt-md-0">
                    <div class="searchh_box position-relative">
                        <input class="form-control" type="search" placeholder="Search">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </div>
            <div class="row comman_table px-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="text-align: center;">

                                    <th>S.No.</th>
                                    <th>Project Name</th>
                                    <th>Project Start Date</th>
                                    <th>Project End Date</th>

                                    <th>Hours</th>


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
                                        <span style="font-size: 18px;">
                                            {{ $projectData['name'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size: 18px;">
                                            {{ $projectData['projectStartDate'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size: 18px;">
                                            {{ $projectData['projectEndDate'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size: 18px;">
                                            <a href="{{ route('teamMateSheet.Hour', ['id' => $projectId]) }}">
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
    @endif


</div>

@endsection