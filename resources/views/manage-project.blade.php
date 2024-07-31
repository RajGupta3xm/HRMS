@extends('header')

@section('title', 'Manage Project')

@section('content')

<div class="layout-px-spacing">
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Manage Projects</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-lg-4">
                    @if (isset($modules[1]['project.create']) && $modules[1]['project.create'] == 1)
                        <a href="{{ route('add_projects') }}">
                            <button type="submit" class="btn btn-success _effect--ripple waves-effect waves-light common_btn2">
                                <i class="fa fa-plus p-1"></i>Add Project
                            </button>
                        </a>
                    @endif
                </div>
            </div>

            <div class="container">
                <div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="container-fluid">
                                <div id="style-2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
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
                                    <div class="table-responsive">
                                        @if ($users->count() > 0)
                                            <table id="style-2" class="table style-2 dt-table-hover dataTable no-footer" role="grid" aria-describedby="style-2_info">
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
                                                            <td class="text-center"><span class="shadow-none badge badge-primary">{{ $user['csm'] }}</span></td>
                                                            <td class="text-center"><span class="shadow-none badge badge-secondary">{{ $user['projecttype'] }}</span></td>
                                                            <td class="text-center">{{ $user['tags'] }}</td>
                                                            <td class="text-center"><span class="shadow-none badge badge-primary">{{ $user['status'] }}</span></td>
                                                            <td class="text-center">{{ $user['projectstartdate'] }}</td>
                                                            <td class="text-center">
                                                                @if (isset($modules[1]['project.edit']) && $modules[1]['project.edit'] == 1)
                                                                    <a href="{{ route('project.edit', ['id' => $user['id']]) }}"><i class="fa fa-edit btn btn-info p-1"></i></a>
                                                                @endif
                                                                @if (isset($modules[1]['project.view']) && $modules[1]['project.view'] == 1)
                                                                    <a href="{{ route('project.detail', ['id' => $user['id']]) }}"><i class="fa fa-eye btn btn-success p-1"></i></a>
                                                                @endif
                                                                <a href="{{ route('projectsUploadFile', ['id' => $user['id']]) }}"><i class="fa fa-upload btn btn-warning p-1"></i></a>
                                                                @if (isset($modules[1]['project.delete']) && $modules[1]['project.delete'] == 1)
                                                                    <form method="POST" action="{{ route('deleteProject', ['id' => $user->id]) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger p-1">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                                        @else
                                            <div class="alert alert-info">No projects available.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
