import HomeComponent from "./components/HomeComponent.vue"
import OxymeterComponent from "./components/OxymeterComponent.vue"
import OxygenComponent from "./components/OxygenComponent"
import KonsultasiComponent from "./components/KonsultasiComponent"
import DonorPlasmaComponent from "./components/DonorPlasmaComponent"
import AboutComponent from "./components/AboutComponent"
import PasienComponent from "./components/PasienComponent.vue"
import BeritaDetailComponent from "./components/BeritaDetailComponent.vue"

//admin component
import AdminComponent from "./components/admin/AdminComponent"
import AdminKonsultasiComponent from "./components/admin/AdminKonsultasiComponent"
import AdminPasienComponent from "./components/admin/AdminPasienComponent"
import AdminObatComponent from "./components/admin/AdminObatComponent"
import AdminDokterComponent from "./components/admin/AdminDokterComponent"
import AdminOxyComponent from "./components/admin/AdminOxyComponent"
import AdminPinjamOxyComponent from "./components/admin/AdminPinjamOxyComponent"
import AdminBeritaComponent from "./components/admin/AdminBeritaComponent"
import AdminTambahBeritaComponent from "./components/admin/AdminTambahBerita"
import AdminEditBeritaComponent from "./components/admin/AdminEditBerita"
import AdminDonorPlasmaComponent from "./components/admin/AdminDonorPlasma"
//dokter component
import DokterKonsulComponent from "./components/dokter/KonsultasiComponent"
export default{
    mode:'history',
    routes:[
        {
            name:"home",
            path:"/",
            component: HomeComponent
        }
        ,
        {
            name:"oxymeter",
            path:"/oxymeter",
            component: OxymeterComponent
        },
        {
            name:"oxygen",
            path:"/oxygen",
            component: OxygenComponent
        },
        {
            name:"konsultasi",
            path:"/konsultasi",
            component: KonsultasiComponent
        },
        {
            name:"donorplasma",
            path:"/donorplasma",
            component: DonorPlasmaComponent
        },
        {
            name:"about",
            path:"/berita",
            component: AboutComponent
        },
        {
            name:"detailBerita",
            path:"/berita/:id",
            component: BeritaDetailComponent
        },
        {
            name:"pasien",
            path:"/pasien",
            component: PasienComponent
        },
        {
            name:"AdminDashboard",
            path:"/admin",
            component: AdminComponent
        },
        {
            name:"AdminKonsultasi",
            path:"/admin/konsultasi",
            component: AdminKonsultasiComponent
        },
        {
            name:"AdminDonorPlasma",
            path:"/admin/donorplasma",
            component: AdminDonorPlasmaComponent
        },
        {
            name:"AdminPasien",
            path:"/admin/pasien",
            component: AdminPasienComponent
        },
        {
            name:"AdminObat",
            path:"/admin/obat",
            component: AdminObatComponent
        },
        {
            name:"AdminDokter",
            path:"/admin/dokter",
            component: AdminDokterComponent
        },
        {
            name:"AdminOxy",
            path:"/admin/oxy",
            component: AdminOxyComponent
        },
        {
            name:"AdminPinjamOxy",
            path:"/admin/pinjamoxy",
            component: AdminPinjamOxyComponent
        },
        {
            name:"AdminBerita",
            path:"/admin/berita",
            component: AdminBeritaComponent 
        },
        {
            name:"AdminEditBerita",
            path:"/admin/berita/:id",
            component: AdminEditBeritaComponent 
        },
        {
            name:"Admintambahberita",
            path:"/admin/tambahberita",
            component: AdminTambahBeritaComponent 
        },
        {
            name:"KonsulDokter",
            path:"/dokter",
            component: DokterKonsulComponent
        }
    ]
}