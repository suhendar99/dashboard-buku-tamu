<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
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

        <li class="nav-item
         {{ Request::is('buku-tamu/pegawai*') ? 'active' : false }}
         {{ Request::is('buku-tamu/pengunjungBackend*') ? 'active' : false }}
         ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-table"></i>
            <span>Data Master</span>
            </a>
            <div id="collapseUtilities1" class="collapse
            {{ Request::is('buku-tamu/pegawai*') ? 'show' : false }}
            {{ Request::is('buku-tamu/pengunjungBackend*') ? 'show' : false }}
            " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('buku-tamu/pegawai*') ? 'active' : false }}" href="{{ route('pegawai.index') }}">Data Pegawai</a>
                <a class="collapse-item {{ Request::is('buku-tamu/pengunjungBackend*') ? 'active' : false }}" href="{{ route('pengunjungBackend.index') }}">Data Pengunjung</a>
            </div>
            </div>
        </li>
        @if (Auth::user()->level == 1)
            <li class="nav-item  {{ Request::is('buku-tamu/log*') ? 'active' : false }}">
            <a class="nav-link" href="{{ route('log.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Log Aktivitas</span></a>
            </li>
        @endif
         <!-- Nav Item - Utilities Collapse Menu -->
         <li class="nav-item
         {{ Request::is('buku-tamu/setapp*') ? 'active' : false }}
         {{ Request::is('buku-tamu/setlap*') ? 'active' : false }}
         @if (Auth::user()->level == 1)
         {{ Request::is('buku-tamu/user*') ? 'active' : false }}
         @endif
         ">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Setting</span>
              </a>
              <div id="collapseUtilities" class="collapse
                {{ Request::is('buku-tamu/setapp*') ? 'show' : false }}
                {{ Request::is('buku-tamu/setlap*') ? 'show' : false }}
                @if (Auth::user()->level == 1)
                {{ Request::is('buku-tamu/user*') ? 'show' : false }}
                @endif
              " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item {{ Request::is('buku-tamu/setapp*') ? 'active' : false }}" href="{{ route('setapp.update',1) }}">App</a>
                  <a class="collapse-item {{ Request::is('buku-tamu/setlap*') ? 'active' : false }}" href="{{ route('setlap.update',1) }}">Report</a>
                  @if (Auth::user()->level == 1)
                  <a class="collapse-item {{ Request::is('buku-tamu/user*') ? 'active' : false }}" href="{{ route('user.index') }}">Add User</a>
                  @endif
                </div>
              </div>
            </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

      </ul>
      <!-- End of Sidebar -->
