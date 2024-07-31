@extends('header')

@section('title', 'Add Milestone')



@section('content')

    <div class="layout-px-spacing">

        <div class="container">

            <div class="row">



                <div class="col-12">

                    <div class="widget-header">

                        <br>

                        <br>

                        <h4 style="margin-top: 5px;text-align: center;font-size: xxx-large;font-family: ui-sans-serif;">View

                            Milestone</h4>

                        @if (session('status'))

                            <div class="alert alert-success">

                                {{ session('status') }}

                            </div>

                        @endif

                        <div class="mt-3">

                            <button type="button" class="btn btn-primary btn-sm"

                                onclick="window.location='{{ route('addmilestone.idNew', ['id' => $projectId]) }}'">Add

                                Milestone</button>

                            <a href="{{route('manage_project')}}" class="btn btn-danger btn-sm">Go Back</a>



                        </div>

                    </div>

                </div>

            </div>



            @if (session('success'))

                <div class="row">

                    <div class="col-12">

                        <div class="alert alert-success mt-3">

                            {{ session('success') }}

                        </div>

                    </div>

                </div>

            @endif



            @if (session('error'))

                <div class="row">

                    <div class="col-12">

                        <div class="alert alert-danger mt-3">

                            {{ session('error') }}

                        </div>

                    </div>

                </div>

            @endif



            <div class="row mt-3">

                <div class="col-12">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th scope="col">#</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Description</th>

                                    <th scope="col">Target Date</th>

                                    <th scope="col">Estimated Hours</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @php $sn = 1; @endphp

                                @foreach ($data as $milestone)

                                    <tr>

                                        <th>{{ $sn++ }}</th>

                                        <td>{{ $milestone['name'] }}</td>

                                        <td>{{ $milestone['description'] }}</td>

                                        <td>{{ $milestone['targetComplectionDate'] }}</td>

                                        <td>{{ $milestone['hours'] }}</td>

                                        <td>

                                            <form method="POST"

                                                action="{{ route('deleteMilestone', ['id' => $milestone->id]) }}"

                                                class="d-inline">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-link text-danger"

                                                    onclick="confirmDelete()">

                                                    <i class="fa fa-trash fa"></i>

                                                </button>

                                            </form>

                                            <a href="{{ route('addmilestone.Edit', ['id' => $milestone['id']]) }}"

                                                class="ml-2">

                                                <i class="fa fa-edit text-primary"></i>

                                            </a>

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

    <script>

        function confirmDelete() {

            if (confirm("Are you sure you want to delete this MileStone?")) {

                document.getElementById('deleteForm').submit();

            }

        }

    </script>

@endsection

