@extends('header')
@section('title', 'All Roles')
@section('content')



    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h4 class="header-title float-left">Roles List</h4>
                        @if (isset($modules[5]['role.create']) && $modules[5]['role.create'] == 1)
                            <p class="float-right mb-2">
                                <a class="btn btn-primary text-white" href="{{ route('allRolesDetails') }}">Create New
                                    Role</a>
                            </p>
                        @endif
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">S.N</th>
                                        <th width="10%">Name</th>
                                        <th width="60%">description</th>

                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sn = 1; @endphp
                                    @if ($processedData)
                                        @foreach ($processedData as $userName => $userData)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>{{ $userName }}</td>

                                                <td>

                                                    @foreach ($userData['description'] as $description)
                                                        <span class="badge badge-info mr-12">{{ $description }}</span>
                                                    @endforeach

                                                </td>

                                                <td class="text-center">
                                                    @if (isset($modules[5]['role.edit']) && $modules[5]['role.edit'] == 1)
                                                        <a href="{{ url('/roles/' . urlencode($userName) . '/edit') }}"
                                                            class="btn btn-info btn-xs">
                                                            Edit
                                                        </a>
                                                    @endif
                                                    @if (isset($modules[5]['role.delete']) && $modules[5]['role.delete'] == 1)
                                                        <form
                                                            action="{{ route('roles.delete', ['userName' => $userName]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-delete">
                                                                <span class="mdi mdi-delete mdi-px"></span>
                                                                <span class="mdi mdi-delete-empty mdi-px"></span>
                                                                <span>Delete</span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <br>
                                                </td>
                                                </form>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
