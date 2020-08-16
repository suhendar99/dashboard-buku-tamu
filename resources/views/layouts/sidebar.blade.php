<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="{{ $data->icon_app }}"></i>
          </div>
          <div class="sidebar-brand-text mx-3">{{ $data->name_app }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Interface
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item  {{ Request::is('buku-tamu/pegawai*') ? 'active' : false }}">
          <a class="nav-link" href="{{ route('pegawai.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Pegawai</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item  {{ Request::is('buku-tamu/pengunjungBackend*') ? 'active' : false }}">
          <a class="nav-link" href="{{ route('pengunjungBackend.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Pengunjung</span></a>
        </li>
         <!-- Nav Item - Utilities Collapse Menu -->
         <li class="nav-item
         {{ Request::is('buku-tamu/setapp*') ? 'active' : false }}
         {{ Request::is('buku-tamu/setlap*') ? 'active' : false }}
         ">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Setting</span>
              </a>
              <div id="collapseUtilities" class="collapse
                {{ Request::is('buku-tamu/setapp*') ? 'show' : false }}
                {{ Request::is('buku-tamu/setlap*') ? 'show' : false }}
              " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item {{ Request::is('buku-tamu/setapp*') ? 'active' : false }}" href="{{ route('setapp.update',1) }}">App</a>
                  <a class="collapse-item {{ Request::is('buku-tamu/setlap*') ? 'active' : false }}" href="{{ route('setlap.update',1) }}">Report</a>
                </div>
              </div>
            </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

      </ul>
      <!-- End of Sidebar -->
