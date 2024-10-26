<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>IPP Tools</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- Custom CSS for background image -->
    <style>
        .auth {
            background-image: url('{{ asset('assets/images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .auth-form-light {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
    </style>
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/android-chrome-favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h2 class="text-center">IPP Tools</h2>
                            <form class="pt-3" method="POST" action="{{ route('login.post') }}" id="form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="user_id" class="form-control form-control-lg" id="user_id" placeholder="User ID">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button id="btn-submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btn-submit').addEventListener('click', async function (e) {
            e.preventDefault();

            if(document.getElementById('user_id').value == '' || document.getElementById('password').value == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'User ID and Password Harus Terisi!',
                });
            } else {
                document.getElementById('form').submit();
            }
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
