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
    <nav class="mt-2" onclick="activeNavLink()">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" onclick="activeNavLink()">
        <li class="nav-item active">
          <a href="/bagian" class="nav-link">
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
          <a href="/pelapor/addkeluhan" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Lapor</p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="#" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Laporan</p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/karyawan/laporan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Baru</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="/karyawan/laporan2" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Laporan Diproses
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/karyawan/laporan3" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Ditangani</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<script>
  function activeNavLink() {
    $(".nav .nav-item a").on("click", function(){
      $(this).closest('.nav-item').siblings().removeClass("active");
      $(this).closest('.nav-item').addClass("active");
    });
  }
</script>
