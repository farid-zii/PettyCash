<style>
    .dropdown-container {
        display: none;
        /* background-color:rgba(199, 199, 199, 0.2); */
        padding-left: 8px;

    }

    .dropdown-container a {
        color: white;
        text-decoration: none;
    }

    .inDrop {
        list-style-type: none;
        background-color: rgba(199, 199, 199, 0.2);
        border-radius: 0px 0px 10px 10px;
        padding-bottom: 8px;
        padding-top: 8px;
    }

    li a:hover {
        text-decoration: none;
        color: white;
    }

</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-success">
    <div class="bg-light"  style="border: 1px solid black">
        <img class="mx-auto d-block pt-2" style="width: 70%;" src="{{asset('img/logo-petty.png')}}">
        {{-- <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i> --}}
            {{-- <img src="https://jasamedika.co.id/wp-content/uploads/2020/03/Logo-Jasamedika.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <div class="font-weight-bold text-dark fs-5 text-center" style="font-family: Verdana, Geneva, Tahoma, sans-serif">Petty-Cash</div>
        </a>
    </div>

    <div class="collapse navbar-collapse mt-2" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='Profile') ? 'active bg-gradient-info' : '' }}"
                    href="/hrd/profile">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='Dashboard') ? 'active bg-gradient-info' : '' }}"
                    href="/hrd/dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='Saldo') ? 'active bg-gradient-info' : '' }}"
                    href="/hrd/saldo">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-bill-wave" style="color: #ffffff;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Saldo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='Pengajuan') ? 'active bg-gradient-info' : '' }}"
                    href="/hrd/pengajuan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-paper-plane" style="color: #ffffff;"></i>
                    </div>
                    @php
                    $pengajuan = App\Models\Pengajuan::all();
                    $a=$pengajuan->where('approve','=','Ditolak')
                                ->count();
                    $b=$pengajuan->Where('approve','=','Setuju')
                                ->count();

                    $c=$a+$b;
                    @endphp
                    <div class="nav-link-text ms-1">Pengajuan</div>
                    @if ($c!=0)
                    <div class="ms-7 position-relative" style="background: red;padding: 5px;border-radius: 1px">
                        {{$c}}</div>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white d-flex {{ ($active=='Realisasi') ? 'active bg-gradient-info' : '' }}"
                    href="/hrd/realisasi">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-hand-holding-dollar" style="color: #ffffff;"></i>
                    </div>
                    @php
                    $pengajuan = App\Models\Pengajuan::all();
                    $a=$pengajuan->where('approve','=','Dicairkan')->where('bukti','=',null)->count();
                    @endphp
                    <div class="nav-link-text ms-1 ps-2">Realisasi
                    </div>
                    @if ($a!=0)
                    <div class="ms-7 position-relative" style="background: red;padding: 5px;border-radius: 1px">
                        {{$a}}</div>
                    @endif


                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='Pegawai') ? 'active bg-gradient-info' : '' }} "
                    href="/hrd/pegawai">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pegawai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ ($active=='History') ? 'active bg-gradient-info' : '' }} "
                    href="/hrd/history">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-clock-history" style="color: #ffffff;"></i>
                    </div>
                    <span class="nav-link-text ms-1">History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="dropdown-btn nav-link text-white {{ ($active=='Jabatan') ? 'active bg-gradient-info' : '' }} "
                    href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-regular fa-list-dropdown" style="color: #ffffff;"></i>
                        <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data </span>
                    <div class="ms-8 position-relative end-0"><i class="fa fa-caret-down"></i></div>
                </a>
                <div class="dropdown-container">
                    <ul style="" class="inDrop ms-2 me-3">
                        <li class="mt-2"><a class="ms-3" href="/hrd/departemen">Departemen</a></li>
                        <li class="mt-2"><a class="ms-3" href="/hrd/bank">Bank</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white bg-danger " href="/logout">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right" style="color: #ffffff;"></i>
                        {{-- <i class=""></i> --}}
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>


<!-- Navbar -->
