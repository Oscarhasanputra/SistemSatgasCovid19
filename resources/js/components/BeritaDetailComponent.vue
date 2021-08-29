<template >
  <div class="site-section">
    <h2 class="my-4 text-center fw-bold">{{ berita.Judul }}</h2>
    <div class="container" v-html="berita.Content"></div>
    <div
      className="card material-card w-40-s mr-1-s ml-1-s"
      style="borderradius: 0; position: relative"
    >
      <div style="overflow: hidden; lineheight: 0">
        <img src="/images/logo.jpg" className="material-card-image" />
      </div>
      <div className="white-text material-card-header z-depth-4">
        <span className="title-header-blog"> {blog.title}{blog.title} </span>
      </div>
      <div className="material-card-backdrop"></div>
      <div className="material-card-backdrop-content">
        <!-- <Link
                                to={`/blog/${blog.url}`}
                                onClick={(e)=>{
                                    e.preventDefault()
                                    history.push({pathname:`/blog/${blog.url}`,state:{blog,index}})}
                                    } className="expandable-button white-text aligns-center">See More <MdVisibility style={{verticalAlign:"middle"}} className="white-text"></MdVisibility></Link> -->
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