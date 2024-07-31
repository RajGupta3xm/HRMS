@extends('header')

@section('title', 'View Employees')



@section('content')

<div class="container-fluid mt-4">

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



        <div class="card-header">

            <h2 class="text-center">View Employees</h2>

        </div>



        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-striped table-hover mb-0">

                    <thead class="thead-dark">

                        <tr>

                            <th class="text-center">S.No.</th>

                            <th>Emp ID</th>

                            <th>Name</th>

                            <th>Department</th>

                            <th>Designation</th>

                            <th>Reporting Manager</th>

                            <th>Official Email</th>

                            <th>Personal Email</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($employees as $employee)

                        <tr onclick="window.location='{{ route('ViewDetailsEmployee.id', $employee->id) }}';" style="cursor: pointer;">

                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $employee->empId }}</td>

                            <td>{{ $employee->name }}</td>

                            <td>{{ $employee->department }}</td>

                            <td>{{ $employee->designation }}</td>

                            <td>{{ $employee->reportingmanager }}</td>

                            <td>{{ $employee->officialemail }}</td>

                            <td>{{ $employee->personalemail }}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>



        <div class="card-footer">

            <div class="d-flex justify-content-center">

                {{ $employees->withQueryString()->links('pagination::bootstrap-5') }}

            </div>

        </div>

    </div>

</div>

@endsection