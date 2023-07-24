<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PettyCash || </title>
    <link rel="shortcut icon" type="text/css" href="img/profits.png">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/../css/nucleo-icons.css" rel="stylesheet" />
    <link href="/../css/nucleo-svg.css" rel="stylesheet" />

    {{--  --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

    {{-- date pickter --}}
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>



    {{-- toas --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/../css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    <link id="pagestyle" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    {{-- Ajax --}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/../css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('datatable/datatables.min.css')}}">


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="/../css/style.css" rel="stylesheet">
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TypeAhead --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    <style>
        * {
            margin: 0px;
            font-family: 'Times New Roman', Times, serif;
        }

        #passwordMessage {
            margin-top: 5px;
        }

        /* custom-suggestion {
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        background-color: #fff;
        position: absolute;
        z-index: 999;
        width: 96%;
    } */

        .custom-suggestion {
            padding: 10px;
            cursor: pointer;
            width: 200%;
        }

        .custom-suggestion:hover {
            background-color: #c3bdbd;
        }


        #myTable {
            border-collapse: collapse;
            width: 100%;
        }

        #myTable th,
        #myTable td {

            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;

            /* overflow: hidden;
  text-overflow: ellipsis; */
        }

        #searchResult li {
            padding: 10px;
            cursor: pointer;
        }

        #searchResult li:hover {
            background-color: #f5f5f5;
        }

    </style>
</head>

<body class="g-sidenav-show  bg-gray-300">

    @include('Finance.layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('Finance.layouts.navbar')

        <div>
            @yield('isi')
        </div>
    </main>
    {{-- <footer>
        <div class="footer bg-primary">
            <h1>Footer</h1>
        </div>
    </footer> --}}
    <div class="js">
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        {{-- <script src="{{asset('datatable/datatables.min.js')}}"></script> --}}
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


        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <script>
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }

        </script>
    </div>
</body>

</html>
