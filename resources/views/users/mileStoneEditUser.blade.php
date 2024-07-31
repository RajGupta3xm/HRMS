@extends('users.header')

@section('title', 'Edit Milestone')



@section('content')

    <style>

        .top-right-element {

            position: absolute;

            top: 0;

            right: 0;

        }

    </style>

    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <section class="vh-100" style="background-color: #eee;">

                <div class="container h-100">

                    <div class="row d-flex justify-content-center align-items-center h-100">

                        <div class="col-lg-12 col-xl-11">

                            <div class="card text-black" style="border-radius: 25px;">

                                <div class="card-body p-md-12">

                                    <div class="row justify-content-center">

                                        <div class="col-md-12 col-lg-6 col-xl-5 order-2 order-lg-1">

                                            <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit MileStone

                                            </p>

                                            @if (session('status'))

                                                <h6 class="alert alert-success">{{ session('status') }}</h6>

                                            @endif

                                            <form class="mx-1 mx-md-4" method="POST"

                                                action="{{ route('mileStoneEditStore') }}">

                                                @csrf

                                                <div class="d-flex flex-row align-items-center mb-4">

                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>

                                                    <div class="form-outline flex-fill mb-0">

                                                        <label class="form-label" for="form3Example1c"> MileStone

                                                            Name</label>

                                                        <input type="text" id="form3Example1c" class="form-control"

                                                            name="name"

                                                            value="{{ old('name', $mileStoneDetails ? $mileStoneDetails->name : '') }}" />

                                                        @error('Name')

                                                            <div class="alert alert-danger">{{ $message }}</div>

                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">

                                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>

                                                    <div class="form-outline flex-fill mb-0">

                                                        <label for="inputState"

                                                            class="form-label">TargetComplectionDate</label>

                                                        <input type="text" class="form-control"

                                                            name="targetComplectionDate"

                                                            value="{{ $mileStoneDetails ? $mileStoneDetails->targetComplectionDate : '' }}" />

                                                        @error('targetComplectionDate')

                                                            <div class="alert alert-danger">{{ $message }}</div>

                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="d-flex flex-row align-items-center mb-4">

                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>

                                                    <div class="form-outline flex-fill mb-0">

                                                        <label class="form-label" for="form3ExampleStartDate">Milestone

                                                            Start Date</label>

                                                        <input type="date" id="form3ExampleStartDate"

                                                            class="form-control" name="StartDate"

                                                            value="{{ $mileStoneDetails ? $mileStoneDetails->StartDate : '' }}" />

                                                    </div>

                                                </div>

                                                @error('StartDate')

                                                    <div class="alert alert-danger">{{ $message }}</div>

                                                @enderror

                                                <div class="d-flex flex-row align-items-center mb-4">

                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>

                                                    <div class="form-outline flex-fill mb-0">

                                                        <label class="form-label" for="form3Example4c">Estimated Time (in

                                                            hours)</label>

                                                        <input type="text" id="form3Example4c" class="form-control"

                                                            name="hours" placeholder="Estimated Time (in hours)"

                                                            value="{{ old('hours', $mileStoneDetails ? $mileStoneDetails->hours : '') }}" />

                                                    </div>

                                                </div>

                                                @error('time')

                                                    <div class="alert alert-danger">{{ $message }}</div>

                                                @enderror

                                                <div class="d-flex flex-row align-items-center mb-4">

                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>

                                                    <div class="form-outline flex-fill mb-0">

                                                        <label for="exampleFormControlTextarea1">Description</label>

                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description', $mileStoneDetails ? $mileStoneDetails->description : '') }}</textarea>

                                                    </div>

                                                </div>

                                                @error('description')

                                                    <div class="alert alert-danger">{{ $message }}</div>

                                                @enderror

                                                <input type="hidden" name="milestoneId"

                                                    value="{{ $mileStoneDetails->id }}" />

                                                <input type="hidden" name="project_id"

                                                    value="{{ $mileStoneDetails->project_id }}" />

                                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">

                                                    <button type="submit" class="btn btn-primary btn-lg"

                                                        name="Register">Update</button>

                                                </div>

                                            </form>

                                        </div>

                                        <div class="col-md-10">

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

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        @endsection

