@extends('header')

@section('title', 'Add Users')

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

    <form method="POST" action="{{ url('addUsersStore') }}">

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

                        <h3 class="register-heading">Add a Employee</h3>

                        <div class="row register-form">

                            <div class="col-md-6">

                                <div class="conatainer">

                                    <label for="name" class="form-label">Department</label>





                                    <select name="userDepartment" class="form-select" id="userDepartment">

                                        <option value="" selected>Select Department</option>

                                        <option value="0">Delivery</option>

                                        <!-- <option value="1">Marketing</option>

                                        <option value="2">Admin</option>

                                        <option value="3">HR</option>

                                        <option value="4">Business</option>

                                        <option value="5">Business Admin</option> -->

                                    </select><br>

                                </div>

                                <div class="form-group">

                                    <label for="userName">Employee Name</label>

                                    <select name="name" class="form-select" id="userName">

                                        <option value="" selected>Select User</option>

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



                                <label for="name" class="form-label">Designation</label>

                                <select name="userDesignation" class="form-select" id="userDesignation">

                                    <option value="" selected>Select User</option>

                                </select><br>

                                <div class="form-group">

                                    <label for="name" class="form-label">Assign Role</label>



                                    <select id="inputState" class="form-select" name="role_id">

                                        <option class="form-select" selected value="">Assign Roles</option>

                                        @foreach ($processedData as $userName => $userData)

                                        <option value="{{ $userName }}">{{ $userName }}</option>

                                        @endforeach

                                    </select>

                                    @error('role_id')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                                <input type="hidden" name="employeeId" id="employeeId">

                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder=" Email *" name="email" id="email" />
                                </div>

                                @error('email')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                                <div class="form-group">

                                    <select class="form-control" name="userstatus">

                                        <option class="hidden" selected value="">User Status</option>

                                        <option value="0">Admin</option>

                                        <option value="1">User</option>

                                    </select>

                                    @error('userstatus')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>



                                <input type="submit" class="btn btn-secondary _effect--ripple waves-effect waves-light common_btn1 btn_one" value="Register">

                                <a href="#" onclick="history.back()" class="btn btn-secondary _effect--ripple waves-effect waves-light common_btn1 btn_one">Go

                                    Back</a>



                            </div>

                        </div>

                    </div>



                </div>

            </div>



        </div>

    </form>

</div>



<script>
    $(document).ready(function() {

        $("#userDepartment").on('change', function() {

            var userDepartment = $(this).val();

            if (userDepartment !== '') {



                let options = []

                if (userDepartment == 0) {

                    options = ["Select Departments", "Delivery Head", "Program Manager", "Project Manager", "Technical Architect", "Solution Architect", "Project Coordinator", "Junior Software Engineer", "Software Engineer", "Senior Software Engineer", "Business Analyst", "Product Manager", "Senior Business Analyst", "Software Engineer Trainee", "Software Test Engineer", "Senior Software Test Engineer", "UX Designer", "Web Designer", "Devops Engineer","Intern-Graphic Designer","AWS Engineer","Intern- Software Engineer","Intern- Web Designer","Intern- Software Engineer","Intern- Ui/UX designer","Intern- Business Analyst"

                    ];

                } 





                let selectOptions = '';

                for (let i = 0; i < options.length; i++) {

                    selectOptions += `<option value="${options[i]}">${options[i]}</option>`

                }



                $("#userDesignation").html(selectOptions)



            } else {

                $('#userDesignation').empty().append('<option value="" selected>Select User</option>');

            }

        });

    });
</script>

<script>
    $(document).ready(function() {

        $("#userDesignation").on('change', function() {

            var userDesignation = $(this).val();

            if (userDesignation !== '') {

                $.ajax({

                    url: '/TMS/public/fetch-users/' + userDesignation,

                    type: 'GET',

                    success: function(data) {

                        var userNameDropdown = $('#userName');

                        userNameDropdown.empty();

                        userNameDropdown.append(

                            '<option value="" selected>Select User</option>');

                        $.each(data, function(key, value) {

                            userNameDropdown.append('<option value="' + value.name +

                                '">' + value.name + '</option>');

                        });

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            }

        });

    });
</script>

<script>
    $(document).ready(function() {

        $("#userName").on('change', function() {

            var employeeName = $(this).val();

            if (employeeName !== '') {

                $.ajax({

                    url: '/TMS/public/fetch-employee-details/' + employeeName,

                    type: 'GET',

                    success: function(data) {

                        $("#email").val(data.officialemail);

                        $("#employeeId").val(data.id);



                        console.log(data.id);

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            }

        });

    });
</script>

</section>

@endsection