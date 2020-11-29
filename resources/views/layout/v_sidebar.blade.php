<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    {{-- logo --}}
    <a href="/" class="brand-link">
      <img src="{{asset('img')}}/r-logo.jpg"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Report</span>
    </a>

    {{-- view user --}}
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('img')}}/admin.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="/profiladmin" class="d-block">Alexa Pierce</a>
      </div>
    </div>

    {{-- side menu --}}
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item active">
          <a href="{{ url('bagian') }}" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Bagian</p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/jenis-keluhan" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Jenis Keluhan</p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/karyawan-master" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Karyawan</p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/pelapor/addkeluhan" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Lapor</p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/karyawan/laporan" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Laporan</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>