<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>TechGropse</title>

    <!--<link rel="stylesheet" href="\layouts\semi-dark-menu\css\light/style.css">-->

        <link rel="stylesheet" href="/TMS/public/layouts/semi-dark-menu/css/light/style.css">



    

    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"

        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>



<body>

    <form id="loginForm" method="post" action="{{ route('loginpage') }}">

        @csrf

        <section class="h-100 gradient-form" style="background-color: #eee;">

            <div class="container py-5 h-100">

                <div class="row d-flex justify-content-center align-items-center h-100">

                    <div class="col-xl-10">

                        <div class="card rounded-3 text-black">

                            <div class="row g-0">

                                <div class="col-lg-6">

                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">



                                            <img src="{{ asset('src/assets/img/logo.png') }}" style="width: 200px;"

                                                alt="logo">



                                            <h3 class="mt-1 mb-5 pb-2">TMS</h3>

                                        </div>

                                        @if (session('error'))

                                            <div class="alert alert-danger">{{ session('error') }}</div>

                                        @endif

                                        <p>Please login to your account</p>



                                        <div class="form-outline mb-4">

                                            <select id="role" name="role" class="form-control">

                                                <option value="admin">Admin</option>

                                                <option value="user">User</option>

                                            </select>

                                            <label for="role">Select Role:</label>

                                        </div>





                                        <div class="form-outline mb-4">

                                            <input type="email" id="form2Example11" name="email"

                                                class="form-control" placeholder="Phone number or email address" />

                                            <label class="form-label">Username</label>

                                        </div>

                                        <div class="form-outline mb-4">

                                            <input type="password" id="form2Example22" name="password"

                                                class="form-control" />

                                            <label class="form-label">Password</label>

                                        </div>



                                        <input type="hidden" id="selectedRole" name="selectedRole" value="admin">

                                        <div class="text-center pt-1 mb-5 pb-1">

                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"

                                                type="submit">Log in</button>

                                            <a href="{{ route('google.redirect') }}" class="btn btn-primary">Login with

                                                Google</a>



                                        </div>



                                    </div>

                                </div>

                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">

                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">

                                        <h3 class="mb-3">We are more than just a company</h3>

                                        <p class="large mb-0">TechGropse is a global web & mobile app development

                                            company located in India, USA, Singapore, and UAE. We are one of the world's

                                            leading mobility firms, where innovative thinking, a bunch of inspiring

                                            minds, and a passion blends to forge an extraordinary impact.</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </form>

    <script>

        document.getElementById('role').addEventListener('change', function() {

            document.getElementById('selectedRole').value = this.value;

            if (this.value === 'admin') {

                document.getElementById('loginForm').action = "{{ route('admin.login') }}";

            } else if (this.value === 'user') {

                document.getElementById('loginForm').action = "{{ route('user.login') }}";

            }

        });

    </script>

</body>



</html>

