@extends('users.header')



@section('title', 'Add Milestone')



@section('content')



    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <section class="vh-100" style="background-color: #eee;">

                <div class="container h-100">

                    <div class="row justify-content-center align-items-center h-100">

                        <div class="col-lg-8">

                            <div class="card border-0 shadow-lg">

                                <div class="card-body p-5">

                                    @if (session('status'))

                                        <div class="alert alert-success">{{ session('status') }}</div>

                                    @endif



                                    <h2 class="text-center mb-4">Add Milestone</h2>



                                    <form class="mx-auto" style="max-width: 400px;" method="POST"

                                        action="{{ route('add_mileStone') }}">

                                        @csrf

                                        <div class="mb-3">

                                            <label for="milestoneName" class="form-label">Milestone Name</label>

                                            <input type="text" id="milestoneName" class="form-control" name="Name"

                                                placeholder="Enter milestone name" />

                                            @error('Name')

                                                <div class="alert alert-danger mt-2">{{ $message }}</div>

                                            @enderror

                                        </div>







                                        <div class="mb-3">

                                            <label for="milestoneStartDate" class="form-label">Milestone Start Date</label>

                                            <input type="date" id="milestoneStartDate" class="form-control"

                                                name="StartDate" />

                                            @error('StartDate')

                                                <div class="alert alert-danger mt-2">{{ $message }}</div>

                                            @enderror

                                        </div>

                                        <div class="mb-3">

                                            <label for="Target Complection Date" class="form-label">Target Complection

                                                Date</label>

                                            <input type="date" class="form-control" name="targetComplectionDate">

                                            @error('targetComplectionDate')

                                                <div class="alert alert-danger mt-2">{{ $message }}</div>

                                            @enderror

                                        </div>



                                        <div class="mb-3">

                                            <label for="estimatedTime" class="form-label">Estimated Time (in hours)</label>

                                            <input type="text" id="estimatedTime" class="form-control" name="time"

                                                placeholder="Enter estimated time" />

                                            @error('time')

                                                <div class="alert alert-danger mt-2">{{ $message }}</div>

                                            @enderror

                                        </div>



                                        <div class="mb-3">

                                            <label for="description" class="form-label">Description</label>

                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>

                                            @error('description')

                                                <div class="alert alert-danger mt-2">{{ $message }}</div>

                                            @enderror

                                        </div>



                                        <input type="hidden" name="projectId" value="{{ $projectData['id'] }}">



                                        <div class="text-center">

                                            <button type="submit" class="btn btn-primary btn-lg"

                                                name="Register">Save</button>

                                            <button type="button" class="btn btn-danger btn-lg"

                                                onclick="goBack()">Cancel</button>

                                        </div>







                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>

    <script>

        function goBack() {

            window.history.back();

        }

    </script>



@endsection

