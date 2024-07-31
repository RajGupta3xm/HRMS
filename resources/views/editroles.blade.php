@extends('header')

@section('title', 'Edit Role - ' . $role->name)

@section('content')



<div class="main-content-inner">

    <div class="row">

        <div class="col-12 mt-5">

            <div class="card">

                <div class="card-body">

                    <h4 class="header-title">Edit Role - {{ $role->name }}</h4>

                    <form action="{{ url('/roles/update/' . $role->name) }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label for="role">Role Name</label>

                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">

                        </div>

                        <div class="form-group">

                            <label for="permissions">Permissions</label>

                            @foreach ($permissions as $permission)

                            <span class="badge badge-info mr-12">{{ $permission }}</span>

                            @endforeach

                        </div>

                        <div class="form-group">

                            <label for="name">Permissions</label>

                            <div class="form-check">

                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">

                                <label class="form-check-label" for="checkPermissionAll">All</label>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="1Management" value="user" name="groupname[]" onclick="checkPermissionByGroup('user', this)">

                                        <label class="form-check-label" for="checkPermission">user</label>

                                    </div>

                                </div>

                                <div class="col-9 user">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission8" value="user.create">

                                        <label class="form-check-label" for="checkPermission8">user.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission9" value="user.view">

                                        <label class="form-check-label" for="checkPermission9">user.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission10" value="user.edit">

                                        <label class="form-check-label" for="checkPermission10">user.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission11" value="user.delete">

                                        <label class="form-check-label" for="checkPermission11">user.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission12" value="user.approve">

                                        <label class="form-check-label" for="checkPermission12">user.approve</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="2Management" value="project" name="groupname[]" onclick="checkPermissionByGroup('project', this)">

                                        <label class="form-check-label" for="checkPermission">project</label>

                                    </div>

                                </div>

                                <div class="col-9 project">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission3" value="project.create">

                                        <label class="form-check-label" for="checkPermission3">project.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission4" value="project.view">

                                        <label class="form-check-label" for="checkPermission4">project.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission5" value="project.edit">

                                        <label class="form-check-label" for="checkPermission5">project.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission6" value="project.delete">

                                        <label class="form-check-label" for="checkPermission6">project.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission7" value="project.approve">

                                        <label class="form-check-label" for="checkPermission7">project.approve</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission8" value="project.invoice.create">

                                        <label class="form-check-label" for="checkPermission8">invoice.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission9" value="project.invoice.view">

                                        <label class="form-check-label" for="checkPermission9">invoice.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission10" value="project.invoice.edit">

                                        <label class="form-check-label" for="checkPermission10">invoice.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission11" value="project.invoice.delete">

                                        <label class="form-check-label" for="checkPermission11">invoice.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission12" value="project.invoice.approve">

                                        <label class="form-check-label" for="checkPermission12">invoice.approve</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission13" value="project.milestone.create">

                                        <label class="form-check-label" for="checkPermission13">Milestone.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission14" value="project.milestone.view">

                                        <label class="form-check-label" for="checkPermission14">Milestone.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission15" value="project.milestone.edit">

                                        <label class="form-check-label" for="checkPermission15">Milestone.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission16" value="project.milestone.delete">

                                        <label class="form-check-label" for="checkPermission16">Milestone.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission17" value="project.milestone.approve">

                                        <label class="form-check-label" for="checkPermission17">Milestone.approve</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission18" value="project.addTeamMember.create">

                                        <label class="form-check-label" for="checkPermission18">AddTeamMember.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission19" value="project.addTeamMember.view">

                                        <label class="form-check-label" for="checkPermission19">AddTeamMember.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission20" value="project.addTeamMember.edit">

                                        <label class="form-check-label" for="checkPermission20">AddTeamMember.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission21" value="project.addTeamMember.delete">

                                        <label class="form-check-label" for="checkPermission21">AddTeamMember.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission22" value="project.addTeamMember.approve">

                                        <label class="form-check-label" for="checkPermission22">AddTeamMember.approve</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="3Management" value="dashboard" name="groupname[]" onclick="checkPermissionByGroup('dashboard', this)">

                                        <label class="form-check-label" for="checkPermission">dashboard</label>

                                    </div>

                                </div>

                                <div class="col-9 dashboard">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission1" value="dashboard.view">

                                        <label class="form-check-label" for="checkPermission1">dashboard.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission2" value="dashboard.edit">

                                        <label class="form-check-label" for="checkPermission2">dashboard.edit</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="4Management" value="profile" name="groupname[]" onclick="checkPermissionByGroup('profile', this)">

                                        <label class="form-check-label" for="checkPermission">profile</label>

                                    </div>

                                </div>

                                <div class="col-9 profile">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission18" value="profile.view">

                                        <label class="form-check-label" for="checkPermission18">profile.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission19" value="profile.edit">

                                        <label class="form-check-label" for="checkPermission19">profile.edit</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="5Management" value="role" name="groupname[]" onclick="checkPermissionByGroup('role', this)">

                                        <label class="form-check-label" for="checkPermission">role</label>

                                    </div>

                                </div>

                                <div class="col-9 role">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission13" value="role.create">

                                        <label class="form-check-label" for="checkPermission13">role.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission14" value="role.view">

                                        <label class="form-check-label" for="checkPermission14">role.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission15" value="role.edit">

                                        <label class="form-check-label" for="checkPermission15">role.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission16" value="role.delete">

                                        <label class="form-check-label" for="checkPermission16">role.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission17" value="role.approve">

                                        <label class="form-check-label" for="checkPermission17">role.approve</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="7Management" value="employeeView" name="groupname[]" onclick="checkPermissionByGroup('employee', this)">

                                        <label class="form-check-label" for="checkPermission">Employee Management

                                        </label>

                                    </div>

                                </div>

                                <div class="col-9 employee">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission21" value="employeeView.create">

                                        <label class="form-check-label" for="checkPermission21">employee.create</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission21" value="employeeView.edit">

                                        <label class="form-check-label" for="checkPermission21">employee.edit</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission22" value="employeeView.view">

                                        <label class="form-check-label" for="checkPermission22">employee.view</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission23" value="employeeView.import">

                                        <label class="form-check-label" for="checkPermission23">employee.import</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission24" value="employeeView.export">

                                        <label class="form-check-label" for="checkPermission24">employee.export</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission25" value="employeeView.delete">

                                        <label class="form-check-label" for="checkPermission25">employee.delete</label>

                                    </div>

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission26" value="employeeView.search">

                                        <label class="form-check-label" for="checkPermission26">employee.search</label>

                                    </div>

                                    <br>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" id="8Management" value="find" name="groupname[]" onclick="checkPermissionByGroup('find', this)">

                                        <label class="form-check-label" for="checkPermission">find</label>

                                    </div>

                                </div>

                                <div class="col-9 find">

                                    <div class="form-check">

                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission21" value="find.view">

                                        <label class="form-check-label" for="checkPermission21">find.view</label>

                                    </div>

                                    <br>

                                </div>

                                <div class="row">

                                    <div class="col-3">

                                        <div class="form-check">

                                            <input type="checkbox" class="form-check-input" id="9Management" value="timesheet" name="groupname[]" onclick="checkPermissionByGroup('timesheet', this)">

                                            <label class="form-check-label" for="checkPermission">timeshhet</label>

                                        </div>

                                    </div>

                                    <div class="col-9 find">

                                        <div class="form-check">

                                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission28" value="timesheet.view">

                                            <label class="form-check-label" for="checkPermission21">timesheet.view</label>

                                        </div>

                                        <br>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    $("#checkPermissionAll").click(function() {

        if ($(this).is(':checked')) {

            $('input[type=checkbox]').prop('checked', true);

        } else {

            $('input[type=checkbox]').prop('checked', false);

        }

    });



    function checkPermissionByGroup(className, checkThis) {

        const groupIdName = $("#" + checkThis.id);

        const classCheckBox = $('.' + className + ' input');

        console.log(className);

        console.log("Group Name:", className);



        if (groupIdName.is(':checked')) {

            classCheckBox.prop('checked', true);

        } else {

            classCheckBox.prop('checked', false);

        }

        implementAllChecked();

    }





    function checkSinglePermission(groupClassName, groupID, countTotalPermission) {

        const classCheckbox = $('.' + groupClassName + ' input');

        const groupIDCheckBox = $("#" + groupID);



        if ($('.' + groupClassName + ' input:checked').length == countTotalPermission) {

            groupIDCheckBox.prop('checked', true);

        } else {

            groupIDCheckBox.prop('checked', false);

        }

        implementAllChecked();

    }



    function implementAllChecked() {

        const countPermissions = 29;

        const countPermissionGroups = 9;





        if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)) {

            $("#checkPermissionAll").prop('checked', true);

        } else {

            $("#checkPermissionAll").prop('checked', false);

        }

    }



    // var permissionsData = {
    //     !!json_encode($permissions) !!
    // };
    var permissionsData = {!! json_encode($permissions) !!};




    permissionsData.forEach(function(permission) {

        var groupName = permission.split('.')[0];



        var checkboxes = document.querySelectorAll('input[name="groupname[]"][value="' + groupName + '"]');



        checkboxes.forEach(function(checkbox) {

            checkbox.checked = true;

        });



        var permissionCheckbox = document.querySelector('input[name="permissions[]"][value="' + permission +

            '"]');

        if (permissionCheckbox) {

            permissionCheckbox.checked = true;

        }

    });
</script>

@endsection