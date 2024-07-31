@extends('header')
@section('title', 'All Employees')
@section('content')
    <div class="container-fluid">
        <div class="row mt-4 mb-3">
            <div class="col-md-6">
                <h3>Employees</h3>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-6 text-end">
                <form action="{{ route('employeeSearch') }}" method="GET" class="d-inline">
                    @csrf
                    @if (isset($modules[4]['employeeView.search']) && $modules[4]['employeeView.search'] == 1)
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="search"
                                aria-label="Search" aria-describedby="searchIcon">
                            <button class="btn btn-outline-secondary" type="submit" id="searchIcon">Search</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Employee Actions</h5>
                            <div class="d-flex">
                                @if (isset($modules[3]['employeeView.export']) && $modules[3]['employeeView.export'] == 1)
                                    <a href="{{ route('employeeExportCSV') }}" class="btn btn-light mr-2">Export CSV</a>
                                @endif
                                @if (isset($modules[3]['employeeView.import']) && $modules[3]['employeeView.import'] == 1)
                                    <button type="button" class="btn btn-light mr-2" data-bs-toggle="modal"
                                        data-bs-target="#importCSVModal">Import CSV</button>
                                @endif
                                @if (isset($modules[3]['employeeView.create']) && $modules[3]['employeeView.create'] == 1)
                                    <a href="{{ route('employeeManagement') }}" class="btn btn-light mr-2">Add Employee</a>
                                @endif
                                <button class="btn btn-danger" onclick="confirmDelete()">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllCheckbox"></th>
                                        <th>S.No.</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Reporting Manager</th>
                                        <th>Official Email</th>
                                        <th>Personal Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeeData as $data)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox_id"
                                                    value="{{ $data['id'] }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['empId'] }}</td>
                                            <td>{{ $data['name'] }}</td>
                                            <td>{{ $data->getDepartmentName() }}</td>
                                            <td>{{ $data['designation'] }}</td>
                                            <td>{{ $data['reportingmanager'] }}</td>
                                            <td>{{ $data['officialemail'] }}</td>
                                            <td>{{ $data['personalemail'] }}</td>
                                            <td>
                                                @if (isset($modules[3]['employeeView.edit']) && $modules[3]['employeeView.edit'] == 1)
                                                    <a href="{{ route('employeeupdate', $data->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
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
        
        <form id="deleteForm" action="{{ route('employee.deleteSelected') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="selectedEmployeeIds" id="selectedEmployeeIds">
        </form>

        <div class="modal fade" id="importCSVModal" tabindex="-1" aria-labelledby="importCSVModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importCSVModalLabel">Import CSV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employeeimportCSV') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="csvFile">Choose CSV File:</label>
                                <input type="file" class="form-control" id="csvFile" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                {{ $employeeData->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete selected employees?')) {
                var checkboxes = document.querySelectorAll('.checkbox_id');
                var selectedEmployeeIds = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedEmployeeIds.push(checkbox.value);
                    }
                });
                if (selectedEmployeeIds.length > 0) {
                    document.getElementById('selectedEmployeeIds').value = selectedEmployeeIds.join(',');
                    document.getElementById('deleteForm').submit();
                } else {
                    alert('Please select at least one employee to delete.');
                }
            }
        }

        document.getElementById('selectAllCheckbox').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.checkbox_id');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAllCheckbox').checked;
            });
        });

    </script>
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
