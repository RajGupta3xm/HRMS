<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('/vendor/font-awesome-4.7/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/addProject.css') }}">

    <link rel="stylesheet" href="{{ asset('/src/assets/css/dark/elements/custom-typography.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <link rel="stylesheet"

        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0/css/bootstrap-select.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0/js/bootstrap-select.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="{{ asset('/layouts/semi-dark-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/layouts/semi-dark-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('/layouts/semi-dark-menu/loader.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <link href="{{ asset('/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/layouts/semi-dark-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/layouts/semi-dark-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"

        integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="

        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"

        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

    <link href="{{ asset('/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/src/assets/css/projectManager.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/src/assets/css/premissionDetails.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('/src/assets/js/allRolesDetails.js') }}"></script>

    <style>

        select#currency option[value="AFN"] {

            background-image: url('afn.png');

        }



        select#currency option[value="ALL"] {

            background-image: url('all.png');

        }

    </style>

</head>





<body class="layout-boxed">

    <div id="load_screen">

        <div class="loader">

            <div class="loader-content">

                <div class="spinner-grow align-self-center"></div>

            </div>

        </div>

    </div>



    <div class="header-container container-xxl">

        <header class="header navbar navbar-expand-sm expand-header">



            <a href="javascript:void(0);" class="sidebarCollapse">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"

                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"

                    class="feather feather-menu">

                    <line x1="3" y1="12" x2="21" y2="12"></line>

                    <line x1="3" y1="6" x2="21" y2="6"></line>

                    <line x1="3" y1="18" x2="21" y2="18"></line>

                </svg>

            </a>





            <ul class="navbar-item flex-row ms-lg-auto ms-0">



                <li class="nav-item dropdown language-dropdown">

                    {{-- <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"

                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <img src="https://designreset.com/equation/html/src/assets/img/1x1/us.svg" class="flag-width"

                            alt="flag">

                    </a> --}}

                    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">

                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img

                                src="https://designreset.com/equation/html/src/assets/img/1x1/us.svg"

                                class="flag-width" alt="flag"> <span

                                class="align-self-center">&nbsp;English</span></a>

                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img

                                src="https://designreset.com/equation/html/src/assets/img/1x1/tr.svg"

                                class="flag-width" alt="flag"> <span

                                class="align-self-center">&nbsp;Turkish</span></a>

                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img

                                src="https://designreset.com/equation/html/src/assets/img/1x1/br.svg"

                                class="flag-width" alt="flag"> <span

                                class="align-self-center">&nbsp;Portuguese</span></a>

                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img

                                src="https://designreset.com/equation/html/src/assets/img/1x1/in.svg"

                                class="flag-width" alt="flag"> <span

                                class="align-self-center">&nbsp;Hindi</span></a>

                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img

                                src="https://designreset.com/equation/html/src/assets/img/1x1/de.svg"

                                class="flag-width" alt="flag"> <span

                                class="align-self-center">&nbsp;German</span></a>

                    </div>

                </li>



                <li class="nav-item theme-toggle-item">

                    <a href="javascript:void(0);" class="nav-link theme-toggle">



                    </a>

                </li>



                <li class="nav-item">{{ Auth::user()->name }} </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">

                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"

                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <div class="avatar-container">

                            <div class="avatar avatar-sm avatar-indicators avatar-online">

                                <img alt="avatar" src="{{ asset('/src/assets/img/profile-21.jpg') }}"

                                    class="rounded-circle">

                            </div>



                            <a href="{{ route('loginpage') }}">Logout</a>



                        </div>

                    </a>



                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">

                        <div class="user-profile-section">

                            <div class="media mx-auto">

                                <div class="emoji me-2">

                                    &#x1F44B;

                                </div>

                                <div class="media-body">

                                    <h5>{{ Auth::user()->name }}</h5>

                                </div>

                            </div>

                        </div>

                        <div class="dropdown-item">

                            <a href="#">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"

                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">

                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>

                                    <circle cx="12" cy="7" r="4"></circle>

                                </svg> <span>Profile</span>

                            </a>

                        </div>

                        <div class="dropdown-item">

                            <a href="#">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"

                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">

                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>

                                    <path

                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">

                                    </path>

                                </svg> <span>Inbox</span>

                            </a>

                        </div>

                        <div class="dropdown-item">

                            <a href="#">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"

                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">

                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">

                                    </rect>

                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>

                                </svg> <span>Lock Screen</span>

                            </a>

                        </div>

                        <div class="dropdown-item">

                            <a href="#">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"

                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">

                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>

                                    <polyline points="16 17 21 12 16 7"></polyline>

                                    <line x1="21" y1="12" x2="9" y2="12"></line>

                                </svg> <span>Log Out</span>

                            </a>

                        </div>

                    </div>



                </li>

            </ul>

        </header>

    </div>



    <div class="main-container" id="container">

        <div class="overlay"></div>

        <div class="search-overlay"></div>





        <div class="sidebar-wrapper sidebar-theme">



            <nav id="sidebar">

<!--<img src="{{ asset('src/assets/img/logo.png') }}" class="navbar-logo">-->

                <div class="navbar-nav theme-brand flex-row  text-center">

                    <div class="nav-logo">

                        <div class="nav-item theme-logo">

                            

                            <!--<img src="images/logo.png" class="navbar-logo">-->



                            <a href="{{ route('dashboard') }}">

                              

                              



                            </a>

                        

                                <img src="{{ asset('src/assets/img/logo.png') }}"

                                                alt="logo">

                        </div>

                        <div class="nav-item theme-text">

                             

                            <a href="{{ route('dashboard') }}" class="nav-link"> TechGropse </a>

                            

                        </div>

                    </div>

                    <div class="nav-item sidebar-toggle">

                        <div class="btn-toggle sidebarCollapse">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"

                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">

                                <polyline points="11 17 6 12 11 7"></polyline>

                                <polyline points="18 17 13 12 18 7"></polyline>

                            </svg>

                        </div>

                    </div>

                </div>





                <ul class="list-unstyled menu-categories" id="accordionExample">

                    @foreach ($modules as $module)

                        @if (Auth::user()->status == '0')

                            <li class="menu {{ $_SERVER['REQUEST_URI'] == $module['url'] ? 'active' : '' }}">

                                <a href="/TMS/public{{ $module['url'] }}" aria-expanded="false" class="dropdown-toggle">

                                    <div class="">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"

                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"

                                            class="feather feather-home">

                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>

                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>

                                        </svg>

                                        <span>{{ $module['module_name'] }}</span>

                                    </div>

                                </a>

                            </li>

                        @else

                            <li

                                class="menu {{ isset($module['rolePermission']) && $module['rolePermission'] === 1 ? '' : 'd-none' }}

                            {{ $_SERVER['REQUEST_URI'] == $module['url'] ? 'active' : '' }}">

                                <a href="/TMS/public{{ $module['url'] }}" aria-expanded="false" class="dropdown-toggle">

                                    <div class="">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"

                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"

                                            class="feather feather-home">

                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>

                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>

                                        </svg>

                                        <span>{{ $module['module_name'] }}</span>

                                    </div>

                                </a>

                            </li>

                        @endif

                    @endforeach

                </ul>











            </nav>



        </div>



        <div id="content" class="main-content">

            @yield('content')

        </div>



    </div>

    <script>

        $(document).ready(function() {

            $('#importCSVModal').on('shown.bs.modal', function() {

                $('#csvFile').trigger('focus');

            });

        });

    </script>

</body>



</html>

