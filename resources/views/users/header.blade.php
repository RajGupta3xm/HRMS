<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Techgropse</title>

    <meta content="" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="" name="keywords" />

    <title>@yield('title')</title>

    <link href="{{ asset('src/assets/img/logo.png') }}" rel="icon" />



    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <link href="{{ asset('src/assets/img/logo.png') }}" rel="stylesheet" />

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />



    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet" />



    <link href="{{ asset('vendor/owl/owl.carousel.min.css') }}" rel="stylesheet" />



    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" />

    <link href="{{ asset('css/styleusers.css') }}" rel="stylesheet" />



    <link href="{{ asset('css/Timeshhet.css') }}" rel="stylesheet" />





</head>

<style>
    .submenu {

        display: none;

    }
</style>



<body>

    <div class="admin_header">

        <div class="row justify-content-between align-items-center">

            <div class="col-2 text-center">

                <a class="logo" href="{{ route('user.dashboard') }}">

                    <img src="{{ asset('src/assets/img/logo.png') }}" alt="">

                </a>

            </div>

            <div class="col-auto">

                <div class="col-auto d-flex align-items-center">

                    <div class="pe-4 pt-2">

                        {{ Auth::user()->name }}

                    </div>

                    <div class="dropdown Profile_dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(session('usersImage'))
                            <img src="{{ asset('usersImage/' . session('usersImage')) }}" alt="User Image" class="img-thumbnail rounded-circle" height="100" width="100">
                            @else
                            <img src="{{ asset('usersImage/image.jpeg') }}" alt="User Placeholder" class="img-thumbnail rounded-circle" height="100" width="100">
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>


                </div>

            </div>

        </div>

    </div>



    <div class="admin_main">

        <div class="admin_siderbarr">

            <a class="active" href="{{ route('user.dashboard') }}"><span><i class="fas fa-home"></i></span>

                Dashboard</a>
               
                <a href="{{ route('manage_project') }}"><span><i class="fas fa-users"></i></span> Mannage Projects</a>

            <a href="{{ route('user.userView') }}"><span><i class="fas fa-users"></i></span> Users Profile</a>

            <a href="#" id="timeSheetLink"><span><i class="fas fa-users"></i></span> TimeSheet <i class="fas fa-chevron-down"></i></a>

            <div id="timeSheetSubMenu" class="submenu">

                <a href="{{ route('user.timeSheet') }}">Weekly Timesheet </a>
                <a href="{{ route('user.submitedTimesheet') }}">Submited Timesheet</a>
                <a href="{{ route('user.approvalTimesheet') }}">Timesheet Approval</a>
                <a href="{{ route('user.teamMateSheet') }}">Project Timesheet</a>

            </div>
        </div>

        <div class="admin_contentpart">
            @yield('content')
        </div>

    </div>
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('vendor/owl/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script>
        var options = {

            series: [{

                name: 'Posts',

                data: [31, 40, 28, 51, 42, 109, 100]

            }, {

                name: 'Posts',

                data: [11, 32, 45, 32, 34, 52, 41]

            }],

            colors: ["#E51955", "#12102D", "#9C27B0"],

            chart: {

                height: 350,

                type: 'area'

            },

            fill: {

                colors: ['#E51955', '#12102D']

            },

            dataLabels: {

                enabled: false

            },

            stroke: {

                curve: 'smooth',

                colors: ['#E51955', '#12102D']

            },

            xaxis: {

                type: 'datetime',

                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",

                    "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",

                    "2018-09-19T06:30:00.000Z"

                ]

            },

            tooltip: {

                x: {

                    format: 'dd/MM/yy HH:mm'

                },

            },

        };



        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>



    <script>
        var options = {

            series: [{

                    name: "Weekly",

                    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 4, 6, 9, 2, 10, 5]

                },

                {

                    name: "Monthly",

                    data: [5, 8, 4, 5, 7, 11, 3, 4, 6, 4, 7, 9, 12, 9, 4]

                }

            ],

            colors: ["#E51955", "#12102D", "#9C27B0"],

            chart: {

                type: "bar",

                height: 350,

                stacked: true

            },

            plotOptions: {

                bar: {

                    horizontal: false

                }

            },

            dataLabels: {

                enabled: false

            },

            stroke: {

                width: 1,

                colors: ["#fff"]

            },



            xaxis: {

                categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],

                labels: {

                    formatter: function(val) {

                        return "Week " + val;

                    }

                }

            },

            yaxis: {

                title: {

                    text: undefined

                }

            },

            tooltip: {



            },

            fill: {

                opacity: 1

            },

            legend: {

                position: "top",

                offsetX: 40,

                onItemHover: {

                    highlightDataSeries: false

                }

            }

        };



        var chart = new ApexCharts(document.querySelector("#Activity"), options);

        chart.render();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const timeSheetLink = document.getElementById('timeSheetLink');
            const timeSheetSubMenu = document.getElementById('timeSheetSubMenu');
            timeSheetLink.addEventListener('click', function(event) {
                event.preventDefault();
                timeSheetSubMenu.style.display = (timeSheetSubMenu.style.display === 'block') ? 'none' :

                    'block';

            });

        });
    </script>
</body>

</html>