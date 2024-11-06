<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/fav.png') }}">
    <title>
        CRS | Login
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />

</head>

<body class="bg-gradient-white">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-3 bg-gradient-light shadow">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="font-weight-bolder text-info text-gradient">Welcome back !</h3>

                                        <div class="form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" id="themeMode">
                                        </div>
                                    </div>
                                    <p class="mb-0">Enter your email and password to login</p>
                                </div>
                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="alert alert-warning rounded-3 text-light border-0 shadow">
                                            <span><i class="fas fa-exclamation-triangle text-md"></i> <strong>Warning!</strong></span>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-sm mb-1">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form role="form" method="POST" action="{{ route('postLogin') }}">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-gradient-info w-50 mt-3 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Forget password?
                                        <a href="javascript:;"
                                            class="text-info text-gradient font-weight-normal"><small>click
                                                here.</small></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeMode');

            // Apply the saved theme preference
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('bg-gradient-dark');
                document.body.classList.remove('bg-gradient-white');
                themeToggle.checked = true;
            } else {
                document.body.classList.add('bg-gradient-white');
                document.body.classList.remove('bg-gradient-dark');
            }

            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.body.classList.add('bg-gradient-dark');
                    document.body.classList.remove('bg-gradient-white');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.body.classList.add('bg-gradient-white');
                    document.body.classList.remove('bg-gradient-dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        });

    </script>
</body>
</html>

