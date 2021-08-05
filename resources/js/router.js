import HomeComponent from "./components/HomeComponent.vue"
import OxymeterComponent from "./components/OxymeterComponent.vue"
import OxygenComponent from "./components/OxygenComponent"
import KonsultasiComponent from "./components/KonsultasiComponent"
import DonorPlasmaComponent from "./components/DonorPlasmaComponent"
import AboutComponent from "./components/AboutComponent"
import PasienComponent from "./components/PasienComponent.vue"
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
            path:"/about",
            component: AboutComponent
        },
        {
            name:"pasien",
            path:"/pasien",
            component: PasienComponent
        }
    ]
}