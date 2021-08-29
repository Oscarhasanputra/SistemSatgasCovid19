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
            <p class="">Ulurkan Tangan, Satukan Hati.</p>
            <p class="mb-5">
              sama-sama kita merangkul seksama yang membutuhkan.
            </p>
            <p class="mb-4">
              <router-link to="/konsultasi" class="btn btn-primary"
                >Yuk Konsul</router-link
              >
            </p>
          </div>
          <div class="col-lg-6">
            <figure class="illustration">
              <img src="images/logo-home.jpeg" alt="Image" class="img-fluid" />
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
          <div class="col-lg-3 col-6 mb-5 mb-lg-0">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{
                covid.positif && covid.positif.toLocaleString()
              }}</strong>
              <span class="label">Terkonfirmasi</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{
                covid.dirawat && covid.dirawat.toLocaleString()
              }}</strong>
              <span class="label">Aktif</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{
                covid.sembuh && covid.sembuh.toLocaleString()
              }}</strong>
              <span class="label">Sembuh</span>
            </div>
          </div>
          <div class="col-lg-3 col-6 mb-5 mb-lg-0">
            <div class="data">
              <span class="icon text-primary">
                <span class="flaticon-virus"></span>
              </span>
              <strong class="d-block number">{{
                covid.meninggal && covid.meninggal.toLocaleString()
              }}</strong>
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

        <div class="row justify-content-center">
          <div
            class="col-10 col-md-4 my-3"
            v-for="(berita, index) in listBerita"
            :key="index"
          >
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">{{
                  new Date(berita.created_at).toISOString().slice(0, 10)
                }}</span>
                <img
                  :src="berita.overview"
                  alt="Image"
                  class="img-fluid"
                  style="height: 400px !important"
                />
              </a>
              <div class="post-meta text-center">
                <span class="icon-user"></span>
                <span>{{
                  berita.admin && berita.admin.Nama
                    ? berita.admin.Nama
                    : "Unknown Admin"
                }}</span>
              </div>
              <h3
                :title="berita.Judul"
                style="
                  text-overflow: ellipsis;
                  overflow: hidden;
                  white-space: nowrap;
                "
              >
                {{ berita.Judul }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Request from "../utilities/request"
export default {
  data() {
    return {
      listBerita: [],
      covid: {},
    };
  },
  mounted() {
    axios
      .get("https://apicovid19indonesia-v2.vercel.app/api/indonesia")
      .then((res) => {
        // this.covid=res.data[0];
        // console.log(this.covid)
        this.covid = res.data;
      })
      .catch((err) => {
        // console.log(err.response)
      });
    Request.get("/api/berita").then((res) => {
      const data = res.data.slice(0, 3);
      this.listBerita = data;
      this.listBerita.map((berita) => {
        const doc = new DOMParser().parseFromString(
          berita.Content,
          "text/html"
        );
        const img = doc.querySelector("img");
        berita.overview = img.src;
      });
    });
    console.log("Component mounted.");
  },
};
</script>
