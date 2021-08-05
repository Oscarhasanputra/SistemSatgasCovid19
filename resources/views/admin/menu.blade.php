<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Komponen Master:</h6>
                {{-- <router-link to="/pasien" class="collapse-item">Master Pasien</router-link> --}}
                <a class="collapse-item" href="{{url('admin')}}">Master Admin</a>
                <a class="collapse-item" href="{{url('pasien')}}">Master Pasien</a>
                <a class="collapse-item" href="{{url('obat')}}">Master Obat</a>
                <a class="collapse-item" href="{{url('dokter')}}">Master Dokter</a>
                <a class="collapse-item" href="{{url('oxy')}}">Master Oxy</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('konsultasi')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Konsultasi</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('pinjamoxy')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Peminjaman Oxy</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('donorplasma')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Donor Plasma</span></a>
    </li>
</ul>