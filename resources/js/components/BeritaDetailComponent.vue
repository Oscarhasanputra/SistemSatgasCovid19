<template >
  <div class="site-section">
    <h2 class="my-4 text-center fw-bold">{{ berita.Judul }}</h2>
    <div class="container" v-html="berita.Content"></div>
    <div
      class="card material-card w-40-s mr-1-s ml-1-s"
      style="borderradius: 0; position: relative"
    >
      <div style="overflow: hidden; lineheight: 0">
        <img src="/images/logo.jpg" class="material-card-image" />
      </div>
      <div class="white-text material-card-header z-depth-4">
        <span class="title-header-blog"> {blog.title}{blog.title} </span>
      </div>
      <div class="material-card-backdrop"></div>
      <div class="material-card-backdrop-content">
          <router-link 
          to="/"
          class="expandable-button white-text aligns-center"
          ></router-link>
        <!-- <Link
                                to={`/blog/${blog.url}`}
                                onClick={(e)=>{
                                    e.preventDefault()
                                    history.push({pathname:`/blog/${blog.url}`,state:{blog,index}})}
                                    } class="expandable-button white-text aligns-center">See More <MdVisibility style={{verticalAlign:"middle"}} class="white-text"></MdVisibility></Link> -->
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
    };
  },
  mounted() {
    const id = this.$route.params.id;
    Request.get("/api/berita/" + id).then((res) => {
      this.berita = res.data;
    });
  },
};
</script>