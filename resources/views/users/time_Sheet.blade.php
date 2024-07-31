@extends('users.header')



@section('title', 'Users TimeSheet')



@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

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



                    <div class="card-header">Weeks Start</div>

                    <div class="card-body">

                        @if($assignedProjects->isEmpty())

                            <div class="alert alert-warning">

                                You are not assigned to any projects.

                            </div>

                        @else

                            <form id="week-start-form" method="post" action="{{ route('user.enterDateInProject') }}">

                                @csrf

                                <div class="form-group">

                                    <label for="week-start-date">Select Week Start Date (Monday of the month only):</label>

                                    <input type="date" id="week-start-date" name="week_start_date" class="form-control"

                                           min="{{ $minDate }}" max="{{ $maxDate }}">

                                    <br>

                                </div>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>



    <script>

        var today = new Date();

        var twoWeeksAgo = new Date(today);

        twoWeeksAgo.setDate(today.getDate() - 20);

        var twoWeeksAgoFormatted = twoWeeksAgo.toISOString().split('T')[0];

        document.getElementById('week-start-date').setAttribute('min', twoWeeksAgoFormatted);

        var maxDate = today.toISOString().split('T')[0];

        document.getElementById('week-start-date').setAttribute('max', maxDate);



        function handleDateSelection() {

            var selectedDate = new Date(document.getElementById('week-start-date').value);

            var selectedDay = selectedDate.getDay();



            if (selectedDay !== 1) {

                alert('Please select only the Monday of the week.');

                document.getElementById('week-start-date').value = '';

                return;

            }



            var assignedProjects = {!! json_encode($assignedProjects) !!};

            var validSelection = false;



            assignedProjects.forEach(function(project) {

                var projectStartDate = new Date(project.startdate);

                var projectEndDate = new Date(project.enddate);



                if (selectedDate >= projectStartDate && selectedDate <= projectEndDate) {

                    validSelection = true;

                }

            });



            if (!validSelection) {

                alert('You are not assigned to any projects during this period. Please select a date between your assigned project Start Date and end Dates.');

                document.getElementById('week-start-date').value = '';

                return;

            }



            localStorage.setItem('selectedDate', document.getElementById('week-start-date').value);

            document.getElementById('week-start-form').submit();

        }



        document.getElementById('week-start-date').addEventListener('change', function() {

            handleDateSelection();

        });

    </script>



@endsection

