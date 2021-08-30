<template >
  <div class="site-section row justify-content-center">
    <div class="col-10 col-sm-8 mt-5 border">
      <h2 class="my-4 text-center fw-bold">{{ berita.Judul }}</h2>
      <div class="container" v-html="berita.Content"></div>
    </div>
    <div class="col-12 col-sm-4 mt-5 border">
      <div class="fs-2 fw-bold text-center">Berita Lainnya</div>
      <div class="row flex-row flex-sm-column">
        <template 
          v-for="(berita, index) in listBerita.slice(0, 10)">
        <router-link
          :to="'/berita/'+berita.IDBerita"
          class="my-5 col-4 col-sm-12"
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
                style="height: 250px !important"
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
</template>
<script>
import Request from "../utilities/request";
export default {
  data() {
    return {
      berita: {},

      listBerita: [],
    };
  },
  mounted() {
    console.log("mounted")
    const id = this.$route.params.id;
    this.refresh(id);
    
  },
  methods:{
    refresh:function(id){
Request.get("/api/berita/" + id).then((res) => {
      const{berita,list} = res.data;
      this.berita=berita;
      this.listBerita=list;
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
  },
  watch:{
    '$route'(){
      this.refresh(this.$route.params.id);
    }
  }
};
</script>