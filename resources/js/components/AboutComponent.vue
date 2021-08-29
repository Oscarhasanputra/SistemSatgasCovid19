<template>
    <div>
      <div class="hero-v1">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mr-auto text-center text-lg-left">
            <span class="d-block subheading">Tentang</span>
            <h1 class="heading mb-3">Tentang Kami</h1>
            <p class="mb-5">Bersama bahu membahu, membantu meringankan korban terdampak pandemi</p>
            <p class="mb-4"><router-link to="/" class="btn btn-primary">Lihat Penyebaran</router-link></p>



          </div>
          <div class="col-lg-6">
            <figure class="illustration">
              <img src="images/illustration.png" alt="Image" class="img-fluid">
            </figure>
          </div>
          
        </div>
      </div>
    </div>


    <!-- MAIN -->
   <div class="site-section">
     <div class="container">
        <div class="row justify-content-center">
          <template 
            v-for="(berita, index) in listBerita"> 
          <router-link
            class="col-10 col-md-4 my-3"
            :to="'/berita/'+berita.IDBerita"
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
          </router-link>
          </template>
        </div>
     </div>
   </div>
  
   </div>
</template>
<script>
import Request from "../utilities/request"
export default {
  data(){
    return{
      listBerita:[]
    }
  },
    mounted(){
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
    }
}
</script>