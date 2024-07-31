@extends('users.header')
@section('title', 'Dashboard')

@section('content')
<style>
    .btnprimary {
        display: inline;
        text-align: center;
        margin-top: 21px;
    }
</style>
<div class="layout-px-spacing">
    <div class="container">
        <h2 class="mt-4">Approved Data</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Employee Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No.</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Date Of Weeks</th>
                                        <th class="text-center">Project Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($approvedData as $index => $entry)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $entry['employeeName'] }}</td>
                                        <td class="text-center">{{ $entry['weeksDate'] }}</td>
                                        <td class="text-center">{{ $entry['projectName'] }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 btnprimary">
                <button type="button" class="btn btn-primary" onclick="goBack()">Go Back</button>

            </div>
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back()
    }
</script>
@endsection