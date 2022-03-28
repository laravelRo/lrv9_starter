<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('meta_title')</title>

    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" />
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="{{ asset('faw6/css/all.min.css') }}">
</head>

<body class="bg-form">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-5">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Starter {{ date('Y') }}</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
</body>

</html>
