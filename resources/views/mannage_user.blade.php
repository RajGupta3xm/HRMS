@extends('header')
@section('title', 'Manage User')
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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                @if (isset($modules[2]['user.create']) && $modules[2]['user.create'] == 1)
                                    <h4 class="header-title">User's List</h4>
                                @endif
                            </div>
                            <div class="btn-group" role="group" aria-label="User Actions">
                                {{-- <a href="{{ route('projectallocations') }}" class="btn btn-success text-white">User's
                                    Allocation</a> --}}
                                <a href="{{ route('addUsers') }}" class="btn btn-primary text-white">Add Users</a>
                                {{-- <a href="{{ route('userAllocationList') }}" class="btn btn-warning text-white">All Users
                                    Allocation</a> --}}
                            </div>
                        </div>

                        <div class="data-tables">
                            <table id="dataTable" class="table text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="10%">S.N</th>
                                        <th width="30%">Name</th>
                                        <th width="30%">Email</th>
                                        <th width="30%">Permissions</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($allUsers as $user)
                                        <tr role="row" class="odd">
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td><span class="badge bg-success">{{ $user['role_id'] }}</span></td>
                                            <td>
                                                @if (isset($modules[2]['user.edit']) && $modules[2]['user.edit'] == 1)
                                                    <a href="{{ route('users.edit', ['userId' => $user->id]) }}"
                                                        class="btn btn-edit">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a>
                                                @endif
                                                @if (isset($modules[2]['user.delete']) && $modules[2]['user.delete'] == 1)
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                        <i class="fa fa-trash text-primary"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('deleteUser', ['id' => $user->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
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
    {!! $allUsers->withQueryString()->links('pagination::bootstrap-5') !!}
@endsection
