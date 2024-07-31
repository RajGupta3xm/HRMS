@extends('header')

@section('title', 'Edit Users')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container register">

    @if (session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

    @endif


    <form method="POST" action="{{ route('addUsersUpdateStore', ['id' => $user->id]) }}">

        @csrf

        <div class="row">

            <div class="col-md-3 register-left">

                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />

                <h3>Welcome</h3>

                <p>You are 30 seconds away from earning your own money!</p>

            </div>

            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <h3 class="register-heading">Edit Employee</h3>

                        <div class="row register-form">

                            <div class="col-md-6">

                                <div class="conatainer">

                                    <label for="name" class="form-label">Department</label>

                                    <select name="userDepartment" class="form-select" id="userDepartment">

                                        <option value="" {{ $user->userDepartment == "" ? 'selected' : '' }}>Select Department</option>

                                        <option value="0" {{ $user->userDepartment == "Delivery" ? 'selected' : '' }}>Delivery</option>




                                    </select><br>

                                </div>

                                <div class="form-group">

                                    <label for="userName">Employee Name</label>

                                    <select name="name" class="form-select" id="userName">

                                        <option value="" selected>Select User</option>

                                        <option value="{{ $user->name }}" selected>{{ $user->name }}</option>

                                    </select>

                                </div>

                                @error('name')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                                <div class="form-group">

                                    <input type="password" class="form-control" placeholder="Password *" name="password" />

                                    @error('password')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label for="name" class="form-label">{{$user->userDesignation}}</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">

                                @if($user->userDepartment == "Delivery")
                                            <option value="Delivery Head" {{ $user->userDesignation == 'Delivery Head' ? 'selected' : '' }}>Delivery Head</option>
                                            <option value="Program Manager" {{ $user->userDesignation == 'Program Manager' ? 'selected' : '' }}>Program Manager</option>
                                            <option value="Project Manager" {{ $user->userDesignation == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                            <option value="Technical Architect" {{ $user->userDesignation == 'Technical Architect' ? 'selected' : '' }}>Technical Architect</option>
                                            <option value="Solution Architect" {{ $user->userDesignation == 'Solution Architect' ? 'selected' : '' }}>Solution Architect</option>
                                            <option value="Project Coordinator" {{ $user->userDesignation == 'Project Coordinator' ? 'selected' : '' }}>Project Coordinator</option>
                                            <option value="Junior Software Engineer" {{ $user->userDesignation == 'Junior Software Engineer' ? 'selected' : '' }}>Junior Software Engineer</option>
                                            <option value="Software Engineer" {{ $user->userDesignation == 'Software Engineer' ? 'selected' : '' }}>Software Engineer</option>
                                            <option value="Senior Software Engineer" {{ $user->userDesignation == 'Senior Software Engineer' ? 'selected' : '' }}>Senior Software Engineer</option>
                                            <option value="Business Analyst" {{ $user->userDesignation == 'Business Analyst' ? 'selected' : '' }}>Business Analyst</option>
                                            <option value="Product Manager" {{ $user->userDesignation == 'Product Manager' ? 'selected' : '' }}>Product Manager</option>
                                            <option value="Senior Business Analyst" {{ $user->userDesignation == 'Senior Business Analyst' ? 'selected' : '' }}>Senior Business Analyst</option>
                                            <option value="Software Test Engineer" {{ $user->userDesignation == 'Software Test Engineer' ? 'selected' : '' }}>Software Test Engineer</option>
                                            <option value="Senior Software Test Engineer" {{ $user->userDesignation == 'Senior Software Test Engineer' ? 'selected' : '' }}>Senior Software Test Engineer</option>
                                            <option value="UI/UX Designer" {{ $user->userDesignation == 'UX Designer' ? 'selected' : '' }}>UX Designer</option>
                                            <option value="Web Designer" {{ $user->userDesignation == 'Web Designer' ? 'selected' : '' }}>Web Designer</option>
                                            <option value="Devops Engineer" {{ $user->userDesignation == 'Devops Engineer' ? 'selected' : '' }}>Devops Engineer</option>
                                            <option value="Intern-Graphic Designer" {{ $user->userDesignation == 'Intern-Graphic Designer' ? 'selected' : '' }}>Intern-Graphic Designer</option>
                                            <option value="AWS Engineer" {{ $user->userDesignation == 'AWS Engineer' ? 'selected' : '' }}>AWS Engineer</option>
                                            <option value="Intern- Software Engineer" {{ $user->userDesignation == 'Intern- Software Engineer' ? 'selected' : '' }}>Intern- Software Engineer</option>
                                            <option value="Intern- Web Designer" {{ $user->userDesignation == 'Intern- Web Designer' ? 'selected' : '' }}>Intern- Web Designer</option>
                                            <option value="Intern- Software Engineer" {{ $user->userDesignation == 'Intern- Software Engineer' ? 'selected' : '' }}>Intern- Software Engineer</option>
                                            <option value="Intern- Ui/UX designer" {{ $user->userDesignation == 'Intern- Ui/UX designer' ? 'selected' : '' }}>Intern- Ui/UX designer</option>
                                            <option value="Intern- Business Analyst" {{ $user->userDesignation == 'Intern- Business Analyst' ? 'selected' : '' }}>Intern- Business Analyst</option>
                                           
                                     @endif
                                     


                                </select><br>

                                <div class="form-group">

                                    <label for="name" class="form-label">Assign Role</label>

                                    <select id="inputState" class="form-select" name="role_id">

                                        <option class="form-select" value="" selected>Assign Roles</option>

                                        @foreach ($processedData as $userName => $userData)

                                        <option value="{{ $userName }}" {{ $userName == $user->role_id ? 'selected' : '' }}>{{ $userName }}

                                        </option>

                                        @endforeach

                                    </select>

                                    @error('role_id')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <input type="hidden" name="employeeId" id="employeeId" value="{{ $user->id }}">

                                <div class="form-group">

                                    <input type="email" class="form-control" placeholder=" Email *" name="email" id="email" value="{{ $user->email }}" />

                                </div>

                                @error('email')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                                <div class="form-group">

                                    <select class="form-control" name="userstatus">

                                        <option class="hidden" selected value="">User Status</option>

                                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Admin

                                        </option>

                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>User</option>

                                    </select>

                                    @error('userstatus')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <input type="submit" class="btnRegister" value="Update" />



                            </div>

                        </div>

                    </div>



                </div>

            </div>



        </div>

    </form>

</div>



</section>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


@endsection