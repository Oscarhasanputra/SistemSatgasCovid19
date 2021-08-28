<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        
    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="icon-group_work"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</sup></div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::guard("admin")->check())

    <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Komponen Master:</h6>
                {{-- <router-link to="/pasien" class="collapse-item">Master Pasien</router-link> --}}
                
                    <router-link to="/admin" class="collapse-item" >Master Admin</router-link>
                    <router-link to="/admin/pasien" class="collapse-item">Master Pasien</router-link>
                    <router-link to="/admin/obat" class="collapse-item" >Master Obat</router-link>
                    <router-link to="/admin/dokter" class="collapse-item">Master Dokter</router-link>
                    <router-link to="/admin/oxy" class="collapse-item">Master Oxy</router-link>
                
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <router-link
         class="nav-link" to="/admin/konsultasi">
            <i class="icon-ring_volume"></i>
            <span>Konsultasi</span>
        </router-link
        >
    </li>

    <li class="nav-item">
        <router-link to="/admin/pinjamoxy" class="nav-link" >
            <i class="icon-room_service"></i>
            <span>Peminjaman Oxy</span></router-link>
    </li>

    <li class="nav-item">
        <router-link to="/donorplasma" class="nav-link">
            <i class="icon-heartbeat"></i>
            <span>Donor Plasma</span></router-link>
    </li>
    @elseif (Auth::guard("doctor")->check())
    <li class="nav-item">
        <router-link
         class="nav-link" to="/dokter">
            <i class="icon-room_service"></i>
            <span>Konsultasi</span>
        </router-link
        >
    </li>
    @endif
</ul>