<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" type="text/css" href="img/profits.png">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/../css/nucleo-icons.css" rel="stylesheet" />
    <link href="/../css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/../css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    {{-- Ajax --}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/../css/style.css" rel="stylesheet">
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
        .timeout{
            animation-name: timeout;
            animation-duration: 5s;
        }

        @keyframes timeout{
            0%{

            }
            100%{
                display: hidden;
            }
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-300">

    @include('admin.layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
         @include('admin.layouts.navbar')

         <div>
            @yield('isi')
         </div>

    </main>
    <div class="js">
        <script src="/./js/core/popper.min.js"></script>
        <script src="/./js/core/bootstrap.min.js"></script>
        <script src="/./js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/./js/plugins/smooth-scrollbar.min.js"></script>
        <script src="/../js/plugins/chartjs.min.js"></script>
        <script src="/../main/main.js"></script>
        <link href="/./css/bootstrap.min.css" rel="stylesheet">
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="/../js/material-dashboard.min.js?v=3.0.4"></script>
        <script src="/../js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>
