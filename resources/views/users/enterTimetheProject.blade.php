@extends('users.header')



@section('title', 'Users TimeSheet')



@section('content')

<div class="container-fluid">

    @if (session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

    @endif

    @if ($errors->any())

    <div class="alert alert-danger">

        <ul>

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form id="week-start-form" method="post" action="{{ route('user.enterTimeInProject') }}" onsubmit="return validateTotalHours()">

        @csrf

        <div class="row">

            <div class="col-md-4">

                <div class="py-6">

                    <div class="card-body">

                        <div class="card-body">

                            <!-- <div class="form-group">

                                <label for="selected-date">Selected Date:</label>

                                <input type="date" id="selected-date" name="selected_date" class="form-control" onchange="updateFormAction()">

                            </div> -->
                            <!-- HTML -->
<div class="form-group">
    <label for="selected-date">Selected Date:</label>
    <input type="date" id="selected-date" name="selected_date" class="form-control" onchange="updateFormAction()">
</div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="draw_box my-4"></div>

        <div class="main">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-12">

                        <div class="d-flex justify-content-between align-items-center pt-5">

                            <div class="box_same">

                                <h6>Project Name</h6>

                            </div>

                            <div class="box_same">

                                <h6>Time Type</h6>

                            </div>

                            @foreach ($datesAndDays as $item)

                            <div class="box_same">

                                <h6>{{ $item['date'] }}</h6>

                            </div>

                            @endforeach

                            <div class="box_same">

                                <h6>Total</h6>

                            </div>

                            <div class="box_same">

                                <h6>Status</h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="d-flex justify-content-between align-items-center pt-1">

                            <div class="box_same">

                                <h6></h6>

                            </div>

                            <div class="box_same">

                                <h6></h6>

                            </div>

                            @foreach ($datesAndDays as $item)

                            <div class="box_same">

                                <h6>{{ $item['day'] }}</h6>

                            </div>

                            @endforeach

                            <div class="box_same">

                                <h6></h6>

                            </div>

                            <div class="box_same">

                                <h6></h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="d-flex justify-content-between align-items-center py-1">

                            <div class="box_same2">

                                <h6>Total</h6>

                            </div>

                            <div class="box_same2">

                                <p></p>

                            </div>

                            <div class="box_same2 monday-field" id="totalMondayHours">

                                <p>{{ $totalTime['monday_hours'] }} </p>

                            </div>

                            <div class="box_same2 tuesday-field" id="totalTuesdayHours">

                                <p>{{ $totalTime['tuesday_hours'] }}</p>

                            </div>

                            <div class="box_same2 wednesday-field" id="totalWednesdayHours">

                                <p>{{ $totalTime['wednesday_hours'] }}</p>

                            </div>

                            <div class="box_same2 thursday-field" id="totalThursdayHours">

                                <p>{{ $totalTime['thursday_hours'] }}</p>

                            </div>

                            <div class="box_same2 friday-field" id="totalFridayHours">

                                <p>{{ $totalTime['friday_hours'] }}</p>

                            </div>

                            <div class="box_same2 saturday-field" id="totalSaturdayHours">

                                <p>{{ $totalTime['saturday_hours'] }}</p>

                            </div>

                            <div class="box_same2" id="totalSundayHours">

                                <p>{{ $totalTime['sunday_hours'] }}</p>

                            </div>

                            <div class="box_same2 total-field" id="totalHours">

                                <p>{{ $totalTime['sunday_hours'] +

                                        $totalTime['monday_hours'] +

                                        $totalTime['tuesday_hours'] +

                                        $totalTime['wednesday_hours'] +

                                        $totalTime['thursday_hours'] +

                                        $totalTime['friday_hours'] +

                                        $totalTime['saturday_hours'] }}

                                </p>

                            </div>

                            <div class="box_same2">

                                <p></p>

                            </div>

                        </div>

                    </div>



                    @if (!empty($timeEntries))

                    @foreach ($timeEntries as $key => $time)
                <div class="row">
                    <div class="col-md-12">

                        <div class="d-flex justify-content-between align-items-center py-1">

                            <div class="box_same3">

                                <div class="dropdown">

                                    <select class="form-select" id="selectedProjectId_{{ $time['id'] }}" name="selected_project_id[]" onchange="selectProject(this)">

                                        <option value="">Select Project</option>

                                        @foreach ($projects as $projectId => $projectName)

                                        <option value="{{ $projectId }}" {{ $time['project_id'] == $projectId ? 'selected' : '' }}>

                                            {{ $projectName }}
                                        </option>

                                        @endforeach

                                    </select>

                                    <input type="hidden" id="" name="selected_id[]" value="{{ $time['id'] }}">

                                </div>





                            </div>

                            <div class="box_same3">

                                <ul class="dropdown-menu">

                                    <li><a class="dropdown-item" href="#">Billable</a></li>

                                    <li><a class="dropdown-item" href="#">Non-Billable</a></li>

                                </ul>



                            </div>



                            <div class="box_same3">

                                <input type="text" value="{{ $time['monday_hours'] }}" name="monday[]" id="monday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                            </div>

                            <div class="box_same3">

                                <input type="text" value="{{ $time['tuesday_hours'] }}" name="tuesday[]" id="tuesday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                            </div>

                            <div class="box_same3">

                                <input type="text" value="{{ $time['wednesday_hours'] }}" name="wednesday[]" id="wednesday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">



                            </div>

                            <div class="box_same3">

                                <input type="text" value="{{ $time['thursday_hours'] }}" name="thursday[]" id="thursday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">



                            </div>

                            <div class="box_same3">

                                <input type="text" value="{{ $time['friday_hours'] }}" name="friday[]" id="friday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">



                            </div>



                            <div class="box_same3">

                                <input type="text" value="{{ $time['saturday_hours'] }}" name="saturday[]" id="saturday_{{ $key + 1 }}" maxlength="4" size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">



                            </div>

                            <div class="box_same3">

                                <input type="text" name="" id="" maxlength="4" size="4" disabled>

                            </div>

                            <div class="box_same3">

                                {{-- <input type="text" value="{{ $time['total_hours'] }}" name="total_Hours[]" id="total_Hours_${index}" maxlength="4" size="4"> --}}

                                <input type="text" value="{{ $time['total_hours'] }}" name="total_Hours[]" id="total_Hours_{{ $key + 1 }}" maxlength="4" size="4">



                            </div>

                            <div class="box_same3_plusicon">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="d-flex align-items-center py-3 description_main">

                            <div class="manage_description">

                                <h6 class="fw-bold ps-3">Description</h6>

                            </div>

                            <input type="text" value="{{ $time['descriptions'] }}" name="description[]" id="description1" class="manage_description_input form-control" placeholder="Description">

                            <i class="fa-solid fa-upload fs-5 ms-4"></i>

                        </div>

                    </div>
                </div>
                    @endforeach

                    @else
                    <div class="row">

                        <div class="col-md-12">

                            <div class="d-flex justify-content-between align-items-center py-1">

                                <div class="box_same3">

                                    <!-- <div class="dropdown">

                                        <button class="btn btn-info dropdown-toggle" type="button" id="selectedProjectButton_1" data-bs-toggle="dropdown" aria-expanded="true" required>

                                            Select Project

                                        </button>

                                        <ul class="dropdown-menu" id="dropdownMenu_1">
                                        <select>
                                            @foreach ($projects as $projectId => $projectName)

                                            <li>

                                                            <a class="dropdown-item" href="#"

                                                                data-project-id="{{ $projectId }}"

                                                                onclick="selectProject(this, 1)">{{ $projectName }}</a>

                                                        </li>

                                            <option value="{{$projectId}}">{{$projectName}}</option>




                                            @endforeach
                                        </select>
                                        </ul>

                                        <input type="hidden" id="selectedProjectId_1" name="selected_project_id[]">



                                    </div>  -->
                                    <div class="dropdown">


                                        <select id="selectedProjectButton_1" class="form-control" aria-label="Default select example" onchange="selectProject(this, 1)">
                                            <option selected>Select Project</option>
                                            @foreach ($projects as $projectId => $projectName)
                                            <option value="{{$projectId}}" data-project-id="{{$projectId}}">{{$projectName}}</option>
                                            @endforeach
                                        </select>



                                        <input type="hidden" id="selectedProjectId_1" name="selected_project_id[]">
                                    </div>


                                </div>

                                <div class="box_same3">

                                    <div class="dropdown">

                                        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                            Billable

                                        </button>

                                        <ul class="dropdown-menu">

                                            <li><a class="dropdown-item" href="#">Billable</a></li>

                                            <li><a class="dropdown-item" href="#">Non-Billable</a></li>

                                        </ul>

                                    </div>

                                </div>





                                <div class="box_same3">

                                    <input type="text" name="monday[]" id="monday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="tuesday[]" id="tuesday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="wednesday[]" id="wednesday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="thursday[]" id="thursday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="friday[]" id="friday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>



                                <div class="box_same3">

                                    <input type="text" name="saturday[]" id="saturday_1" maxlength="4" size="4" oninput="calculateTotalHours(1)">

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="" id="" maxlength="4" size="4" disabled>

                                </div>

                                <div class="box_same3">

                                    <input type="text" name="total_Hours[]" id="totalHours_1" maxlength="4" size="4">

                                </div>

                                <div class="box_same3_plusicon"> 

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="d-flex align-items-center py-3 description_main">

                                <div class="manage_description">

                                    <h6 class="fw-bold ps-3">Description</h6>

                                </div>

                                <input type="text" name="description[]" id="description1" class="manage_description_input form-control" placeholder="Description" required>

                                <i class="fa-solid fa-upload fs-5 ms-4"></i>

                            </div>

                        </div>
                    </div>
                    @endif

                </div>

            </div>

        </div>

        <div class="col-md-2">

            <div class="d-flex justify-content-between">

                <button type="button" class="btn btn-primary" id="addRowBtn">Add</button>



                <button class="btn btn-primary" type="button" onclick="saveFormData()">Save</button>



                <button class="btn btn-primary" type="submit">Submit</button>

            </div>

        </div>

    </form>

</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function validateFormFields() {
        let isSelectedProject = true;

        let isSelectedDiscription = true;

        $(`input[name="selected_project_id[]"]`).each(function() {

            if (!$(this).val()) {

                isSelectedProject = false

            }

        });



        $(`input[name="description[]"]`).each(function() {

            if (!$(this).val()) {

                isSelectedDiscription = false

            }

        });



        if (!isSelectedProject) {

            alert('Please select project')

            return false;

        }



        if (!isSelectedDiscription) {

            alert('Please fill description')

            return false;

        }



        return true;

    }

    function saveFormData() {

        var isFormValid = validateFormFields();

        if (isFormValid) {

            var baseUrl = "{{ url('/') }}";

            var selectedDate = document.getElementById("selected-date").value;



            var routeUrl = baseUrl + "/user/user.enterDateInProjectTempSave?selected_date=" + selectedDate;

            document.getElementById("week-start-form").action = routeUrl;

            document.getElementById("week-start-form").submit();

        }

    }
</script>

<script>
    // function updateFormAction() {

    //     var selectedDate = document.getElementById("selected-date").value;
    //     console.log('hlw');

    //     var selectedDateObj = new Date(selectedDate);

    //     var today = new Date();



    //     if (selectedDateObj.getDay() !== 1) {

    //         alert('Please select only Mondays Of Weeks.');

    //         return;

    //     }



    //     if (selectedDateObj > today) {

    //         alert('Please select a date on or before today.');

    //         document.getElementById('selected-date').value = localStorage.getItem('selectedDate');

    //         return;

    //     }


    //     var assignedProjects = {!! json_encode($assignedProjects) !!};

    //     // var assignedProjects = {
    //     //     !!json_encode($assignedProjects) !!
    //     // };

    //     var validSelection = false;



    //     assignedProjects.forEach(function(project) {

    //         var projectStartDate = new Date(project.startdate);

    //         var projectEndDate = new Date(project.enddate);



    //         if (selectedDateObj >= projectStartDate && selectedDateObj <= projectEndDate) {

    //             validSelection = true;

    //             return;

    //         }

    //     });



    //     if (!validSelection) {

    //         alert(

    //             'You are not assigned to any projects during this period. Please select a date between your assigned project start and end dates.'

    //         );

    //         document.getElementById('selected-date').value = '';

    //         return;

    //     }



    //     var fourteenDaysAgo = new Date(today);

    //     fourteenDaysAgo.setDate(today.getDate() - 20);



    //     if (selectedDateObj < fourteenDaysAgo) {

    //         alert('Please select a date within the past 2 weeks.');

    //         return;

    //     }



    //     $.ajax({

    //         url: "{{ route('check.data.exists') }}",

    //         type: "GET",

    //         data: {

    //             selected_date: selectedDate

    //         },

    //         success: function(response) {

    //             if (response.exists) {

    //                 alert('Timesheet already submitted for this date.');

    //             } else {

    //                 var baseUrl = "{{ url('') }}";

    //                 var routeUrl = baseUrl + "/user/user.enterDateInProjectUpdate?selected_date=" +

    //                     selectedDate;

    //                 window.location.href = routeUrl;

    //             }

    //         },

    //         error: function(xhr, status, error) {

    //             console.error(error);

    //             alert('An error occurred while checking data existence.');

    //         },

    //         complete: function() {

    //             localStorage.setItem('selectedDate', selectedDate);

    //         }

    //     });

    // }
    // JavaScript
function updateFormAction() {
    var selectedDate = document.getElementById("selected-date").value;
    var selectedDateObj = new Date(selectedDate);
    var today = new Date();

    if (selectedDateObj.getDay() !== 1) {
        alert('Please select only Mondays Of Weeks.');
        return;
    }

    if (selectedDateObj > today) {
        alert('Please select a date on or before today.');
        document.getElementById('selected-date').value = localStorage.getItem('selectedDate');
        return;
    }

    var assignedProjects = {!! json_encode($assignedProjects) !!};
    var validSelection = false;

    assignedProjects.forEach(function(project) {
        var projectStartDate = new Date(project.startdate);
        var projectEndDate = new Date(project.enddate);

        if (selectedDateObj >= projectStartDate && selectedDateObj <= projectEndDate) {
            validSelection = true;
            return;
        }
    });

    if (!validSelection) {
        alert('You are not assigned to any projects during this period. Please select a date between your assigned project start and end dates.');
        document.getElementById('selected-date').value = '';
        return;
    }

    var fourteenDaysAgo = new Date(today);
    fourteenDaysAgo.setDate(today.getDate() - 20);

    if (selectedDateObj < fourteenDaysAgo) {
        alert('Please select a date within the past 2 weeks.');
        return;
    }

    $.ajax({
        url: "{{ route('check.data.exists') }}",
        type: "GET",
        data: {
            selected_date: selectedDate
        },
        success: function(response) {
            if (response.exists) {
                alert('Timesheet already submitted for this date.');
            } else {
                var baseUrl = "{{ url('') }}";
                var routeUrl = baseUrl + "/user/user.enterDateInProjectUpdate?selected_date=" + selectedDate;
                window.location.href = routeUrl;
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('An error occurred while checking data existence.');
        },
        complete: function() {
            localStorage.setItem('selectedDate', selectedDate);
        }
    });
}

</script>

<script>
    $(document).ready(function() {

        $(document).on('input', '[id^="monday_"]', function() {

            calculateTotalHours('monday');

        });



        $(document).on('input', '[id^="tuesday_"]', function() {

            calculateTotalHours('tuesday');

        });



        $(document).on('input', '[id^="wednesday_"]', function() {

            calculateTotalHours('wednesday');

        });



        $(document).on('input', '[id^="thursday_"]', function() {

            calculateTotalHours('thursday');

        });



        $(document).on('input', '[id^="friday_"]', function() {

            calculateTotalHours('friday');

        });



        $(document).on('input', '[id^="saturday_"]', function() {

            calculateTotalHours('saturday');

        });



        $(document).on('input', '[id^="sunday_"]', function() {

            calculateTotalHours('sunday');

        });







        function calculateTotalHours(day) {



            let totalHours = 0;

            $(`input[name="${day}[]"]`).each(function() {

                totalHours += parseFloat($(this).val()) || 0;

            });

            $(`#total${day.charAt(0).toUpperCase() + day.slice(1)}Hours`).text(totalHours.toFixed(2));



            let finalHours = 0;

            $(`input[name="total_Hours[]"]`).each(function() {

                finalHours += parseFloat($(this).val()) || 0;

            });

            let fixedValue = finalHours.toFixed(2);



            let finalHoursHtml = `<p>${fixedValue}</p>`

            $("#totalHours").html(finalHours)



        }

    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {

        var selectedDate = localStorage.getItem('selectedDate');



        if (selectedDate) {

            document.getElementById('selected-date').value = selectedDate;

        }

    });





    $(document).ready(function() {

        var uniqueId = Math.floor(Math.random() * 1000);



        $("#addRowBtn").unbind('click').click(function() {

            var newRow =

                `<div class="row">

                    <div class="col-md-12">

                        <div class="d-flex justify-content-between align-items-center py-1">

                            <div class="box_same3">

                               
                            <div class="dropdown">
                            <select id="selectedProjectButton_${uniqueId}" class="form-control" aria-label="Default select example" onchange="selectProject(this, ${uniqueId})">
                                <option selected>Select Project</option>
                                @foreach ($projects as $projectId => $projectName)
                                <option value="{{$projectId}}" data-project-id="{{$projectId}}">{{$projectName}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="selectedProjectId_${uniqueId}" name="selected_project_id[]">
                        </div>




                            </div>

                            <div class="box_same3">

                                <div class="dropdown">

                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                        Billable

                                    </button>

                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="#">Action</a></li>

                                        <li><a class="dropdown-item" href="#">Another action</a></li>

                                        <li><a class="dropdown-item" href="#">Something else here</a></li>

                                    </ul>

                                </div>

                            </div>

                            <div class="box_same3">

                                <input type="text" name="monday[]" id="monday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">

                            </div>

                            <div class="box_same3">

                                <input type="text" name="tuesday[]" id="tuesday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">

                            </div>

                            <div class="box_same3">

                                <input type="text" name="wednesday[]" id="wednesday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">

                            </div>

                            <div class="box_same3">

                                <input type="text" name="thursday[]" id="thursday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">

                            </div>

                            <div class="box_same3">

                                <input type="text" name="friday[]" id="friday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">

                            </div>

                            <div class="box_same3">

                                <input type="text" name="saturday[]" id="saturday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})" >

                            </div>

                            <div class="box_same3">

                                <input type="text" name="" id="total_${uniqueId}" maxlength="4" size="4" disabled>

                            </div>

                            <div class="box_same3">

                                <input type="text" name="total_Hours[]" id="totalHours_${uniqueId}" maxlength="4" size="4">

                            </div>

                            <div class="box_same3_plusicon">
                                <button class="btn btn-danger removeRowBtn">Cancel</button>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="d-flex align-items-center py-3 description_main">

                            <div class="manage_description">

                                <h6 class="fw-bold ps-3">Description</h6>

                            </div>

                            <input type="text" name="description[]" id="description_${uniqueId}" class="manage_description_input form-control" placeholder="Description">

                            <i class="fa-solid fa-upload fs-5 ms-4"></i>

                        </div>

                    </div>
                </div>`;



            $(".main").append(newRow);

            uniqueId++;

        });



        $(document).on("click", ".removeRowBtn", function()
         {

        $(this).closest(".row").remove(); 

        });




        $(document).on("click", ".btn-info.dropdown-toggle", function() {

            $(this).siblings('.dropdown-menu').toggleClass('show');

        });

    });




    function selectProject(element, uniqueId) {
        var projectId = element.value;

        var projectName = element.options[element.selectedIndex].text;

        var selectedProjectId = document.getElementById('selectedProjectId_' + uniqueId);

        if (selectedProjectId) {
            selectedProjectId.value = projectId;
        }
    }




    function calculateTotalHours(uniqueId) {

        var mondayValue = parseFloat(document.getElementById(`monday_${uniqueId}`).value) || 0;

        var tuesdayValue = parseFloat(document.getElementById(`tuesday_${uniqueId}`).value) || 0;

        var wednesdayValue = parseFloat(document.getElementById(`wednesday_${uniqueId}`).value) || 0;

        var thursdayValue = parseFloat(document.getElementById(`thursday_${uniqueId}`).value) || 0;

        var fridayValue = parseFloat(document.getElementById(`friday_${uniqueId}`).value) || 0;

        var saturdayValue = parseFloat(document.getElementById(`saturday_${uniqueId}`).value) || 0;

        var total = mondayValue + tuesdayValue + wednesdayValue + thursdayValue + fridayValue + saturdayValue;



        document.getElementById(`totalHours_${uniqueId}`).value = total.toFixed(2);

    }





    function calculateTotalHoursstaticWithoutData() {

        var mondayValue1 = parseFloat(document.getElementById('monday_1').value) || 0;

        var tuesdayValue1 = parseFloat(document.getElementById('tuesday_1').value) || 0;

        var wednesdayValue1 = parseFloat(document.getElementById('wednesday_1').value) || 0;

        var thursdayValue1 = parseFloat(document.getElementById('thursday_1').value) || 0;

        var fridayValue1 = parseFloat(document.getElementById('friday_1').value) || 0;

        var saturdayValue1 = parseFloat(document.getElementById('saturday_1').value) || 0;



        let totalField = document.querySelector('.total-field p');

        let totalFieldHour = document.getElementById('total_Hours_1');



        var total = mondayValue1 + tuesdayValue1 + wednesdayValue1 + thursdayValue1 + fridayValue1 + saturdayValue1;

        totalField.textContent = total.toFixed(2);

        totalFieldHour.value = total.toFixed(2);





    }



    function calculateTotalHoursstatic(index) {

        var mondayValue = parseFloat(document.getElementById(`monday_${index}`).value) || 0;

        var tuesdayValue = parseFloat(document.getElementById(`tuesday_${index}`).value) || 0;

        var wednesdayValue = parseFloat(document.getElementById(`wednesday_${index}`).value) || 0;

        var thursdayValue = parseFloat(document.getElementById(`thursday_${index}`).value) || 0;

        var fridayValue = parseFloat(document.getElementById(`friday_${index}`).value) || 0;

        var saturdayValue = parseFloat(document.getElementById(`saturday_${index}`).value) || 0;



        var total = mondayValue + tuesdayValue + wednesdayValue + thursdayValue + fridayValue + saturdayValue;

        document.getElementById(`total_Hours_${index}`).value = total.toFixed(2);

    }
</script>

<script>
    function validateTotalHours() {

        var totalHoursInputs = document.getElementsByName('total_Hours[]');

        var totalHours = 0;

        for (var i = 0; i < totalHoursInputs.length; i++) {

            totalHours += parseFloat(totalHoursInputs[i].value) || 0;

        }

        if (totalHours < 40) {

            alert('Your total working hours are less than 40 hours.');

            return false;

        }

        return true;

    }

    document.addEventListener('DOMContentLoaded', function() {

        var submitButton = document.querySelector('[type="submit"]');

        if (submitButton) {

            submitButton.addEventListener('click', function(event) {

                var isConfirmed = confirm("Are you sure you want to submit this form?");

                if (!isConfirmed) {

                    event.preventDefault();

                }

            });

        }

    });



    function validateDescription() {

        var descriptionInputs = document.getElementsByName('description[]');

        for (var i = 0; i < descriptionInputs.length; i++) {

            if (descriptionInputs[i].value.trim() === '') {

                alert('Please enter a description for all entries.');

                return false;

            }

        }

        return true;

    }







    document.addEventListener('DOMContentLoaded', function() {

        var submitButton = document.querySelector('[type="submit"]');

        if (submitButton) {

            submitButton.addEventListener('click', function(event) {

                var isDescriptionValid = validateDescription();

                if (!isDescriptionValid) {

                    event.preventDefault();

                }

            });

        }

    });
</script>



<script>
    function validateProjectSelection() {

        var projectDropdown = document.getElementById('dropdownMenu_1');

        var selectedProjectId = projectDropdown.getAttribute('data-selected-project-id');



        if (!selectedProjectId) {

            alert("Please select a project.");

            return false;

        }

        return true;

    }



    function validateDescriptionInput() {

        var descriptionInput = document.getElementById('description1');

        var descriptionValue = descriptionInput.value.trim();



        if (descriptionValue === "") {

            alert("Please enter a description.");

            return false;

        }

        return true;

    }



    function validateForm() {

        var isProjectValid = validateProjectSelection();

        var isDescriptionValid = validateDescriptionInput();



        return isProjectValid && isDescriptionValid;

    }



    document.getElementById('week-start-form').addEventListener('submit', function(event) {

        if (!validateForm()) {

            event.preventDefault();

        }

    });
</script>

@endsection