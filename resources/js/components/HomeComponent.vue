<template>
  <div>
    <div class="hero-v1">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mr-auto text-center text-lg-left">
            <span class="d-block subheading">Peduli Covid-19</span>
            <h1 class="heading mb-3">
              Satgas Covid-19 Masyarakat Buddhis Banten
            </h1>
            <p class="">
              Ulurkan Tangan, Satukan Hati. 
            </p>
            <p class="mb-5">
              sama-sama kita merangkul seksama yang membutuhkan.
            </p>
            <p class="mb-4">
              <router-link to="/konsultasi" class="btn btn-primary">Yuk Konsul</router-link>
            </p>
          </div>
          <div class="col-lg-6">
            <figure class="illustration">
              <img
                src="images/logo-home.jpeg"
                alt="Image"
                class="img-fluid"
              />
            </figure>
          </div>
          <div class="col-lg-6"></div>
        </div>
      </div>
    </div>

    <!-- MAIN -->

    <div class="site-section stats">
      <div class="container">
        <div class="row mb-3">
          <div class="col-lg-7 text-center mx-auto">
            <h2 class="section-heading">Statistik Virus Corona Indonesia</h2>
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-6 mb-5 mb-lg-0 ">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{covid.positif && covid.positif.toLocaleString()}}</strong>
              <span class="label">Terkonfirmasi</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0 ">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{covid.dirawat && covid.dirawat.toLocaleString()}}</strong>
              <span class="label">Aktif</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0 ">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{covid.sembuh && covid.sembuh.toLocaleString()}}</strong>
              <span class="label">Sembuh</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0 ">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{covid.meninggal && covid.meninggal.toLocaleString()}}</strong>
              <span class="label">Meninggal</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4 section-heading">Berita &amp; Artikel</h2>
           
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_1.jpg" alt="Image" class="img-fluid" />
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_2.jpg" alt="Image" class="img-fluid" />
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_1.jpg" alt="Image" class="img-fluid" />
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"
export default {
  data(){
    return{
      covid:{}
    }
  },
  mounted() {
    // console.log()
    // fetch({url:"https://covid19.mathdro.id/api/countries/idn/confirmed"}).then(res=>{
    //   console.log(res)
    // })
    // axios.defaults.headers={}

    // console.log(axios.defaults.headers)
    // axios.defaults.headers['Accept']="*/*"
    // axios.defaults.headers['Accept-Encoding']="gzip, deflate, br"
    // fetch("http://api.kawalcorona.com/indonesia",{mode:"no-cors"}).then(async res=>{
    //   const data= await res.text()
    //   console.log(data);
    //   })
    // delete axios.defaults.headers.common['X-Requested-With']
 
    axios.get("https://apicovid19indonesia-v2.vercel.app/api/indonesia").then(res=>{
      // this.covid=res.data[0];
      // console.log(this.covid)
      this.covid=res.data;
    }).catch(err=>{
      // console.log(err.response)
    })
    // this.axios.get("https://covid19.mathdro.id/api/countries/idn/confirmed").then(res=>{
    //   console.log("request re")
    //   console.log(res.data)
    // }).catch(err=>{})
    console.log("Component mounted.");
  },
};
</script>
