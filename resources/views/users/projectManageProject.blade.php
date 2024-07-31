@extends('users.header')
@section('title', 'Mannage projects User')

@section('content')
<div class="container-fluid">
    <h3 class="text-center">Assigned Project Details</h3>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Assigned Project Details</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Client Name</th>
                                    <th class="text-center">CSM</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Tags</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach ($users as $user)
                                <tr role="row">
                                    <td>{{ $count++ }}</td>
                                    <td class="text-center">{{ $user['projectname'] }}</td>
                                    <td class="text-center">{{ $user['cilentname'] }}</td>
                                    <td class="text-center">{{ $user['csm'] }}</td>
                                    <td class="text-center">{{ $user['projecttype'] }}</td>
                                    <td class="text-center">{{ $user['tags'] }}</td>
                                    <td class="text-center">{{ $user['status'] }}</td>
                                    <td class="text-center">{{ $user['projectstartdate'] }}</td>
                                    <td class="text-center">


                                        <a href="{{ route('project.detail', ['id' => $user['id']]) }}"><i class="fa fa-eye btn btn-success p-1"></i></a>

                                        <!-- <a href="{{ route('projectsUploadFile', ['id' => $user['id']]) }}"><i class="fa fa-upload btn btn-warning p-1"></i></a> -->

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