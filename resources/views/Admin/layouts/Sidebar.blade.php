<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-success" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        {{-- <img src="https://jasamedika.co.id/wp-content/uploads/2020/03/Logo-Jasamedika.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <span class="ms-1 font-weight-bold text-white fs-2 text-center">PettyCash</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Dashboard') ? 'active bg-gradient-info' : '' }}" href="/admin/dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Pangkat') ? 'active bg-gradient-info' : '' }}" href="/admin/pangkat">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-ranking-star" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Pangkat</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('pegawai') ? 'active bg-gradient-info' : '' }} " href="/admin/pegawai">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Pegawai</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('Pengajuan') ? 'active bg-gradient-info' : '' }}" href="../pages/billing.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-sharp fa-solid fa-paper-plane" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Pengajuan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Pengembalian') ? 'active bg-gradient-info' : '' }}" href="../pages/billing.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-sharp fa-solid fa-hand-holding-dollar" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Pengembalian</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Saldo') ? 'active bg-gradient-info' : '' }}" href="/admin/saldo">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-money-bill-wave" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Saldo</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Departemen') ? 'active bg-gradient-info' : '' }}" href="/admin/departemen">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-building" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Departement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='Jabatan') ? 'active bg-gradient-info' : '' }}" href="/admin/jabatan">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-handshake" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Jabatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active=='User') ? 'active bg-gradient-info' : '' }} " href="/admin/user">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">User</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('category') ? 'active bg-gradient-info' : '' }} " href="../pages/sign-in.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>
            </div>
            <span class="nav-link-text ms-1">Category</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>


    <!-- Navbar -->

