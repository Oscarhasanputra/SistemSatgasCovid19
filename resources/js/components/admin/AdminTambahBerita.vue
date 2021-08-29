<template>
  <div class="container-fluid">
    <div class="mb-3">
      <label for="judul" class="form-label">Judul</label>
      <input
        type="email"
        class="form-control required"
        id="judul"
        aria-describedby="emailHelp"
        v-model="judul"
      />
    </div>

    <div id="editor" class="container-fluid position-relative"></div>
    <input
      type="file"
      style="display: none"
      id="uploader"
      @change="fileUpload"
    />
    <button class="btn btn-primary my-3" @click="simpanData">Simpan</button>
  </div>
</template>
<script>
import "quill/dist/quill.snow.css";
import Quill from "quill/dist/quill";
import axios from "axios";
import { isValidated } from "../../utilities/validate";
export default {
  data() {
    return {
      editor: {},
      fileUploaded: [],
      judul: "",
    };
  },
  mounted() {
    var toolbarOptions = [
      ["bold", "italic", "underline", "strike"], // toggled buttons
      ["blockquote", "code-block"],

      [{ header: 1 }, { header: 2 }], // custom button values
      [{ list: "ordered" }, { list: "bullet" }],
      [{ script: "sub" }, { script: "super" }], // superscript/subscript
      [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
      [{ direction: "rtl" }], // text direction

      [{ size: ["small", false, "large", "huge"] }], // custom dropdown
      [{ header: [1, 2, 3, 4, 5, 6, false] }],
      [ "image"],

      [{ color: [] }, { background: [] }], // dropdown with defaults from theme
      [{ font: [] }],
      [{ align: [] }],

      ["clean"], // remove formatting button
    ];
    this.editor = new Quill("#editor", {
      theme: "snow",
      bounds: "#editor",
      modules: {
        toolbar: toolbarOptions,
      },
    });
    const toolbar = this.editor.getModule("toolbar");
    toolbar.addHandler("image", this.imageHandler);
    // toolbar.addHandler("link", this.linkHandler);
  },
  methods: {
    // linkHandler: function (e) {
    //   this.$swal({
    //     title: "Masukkan Link pada Berita",
    //     html: ` <div class="container-fluid">
    //                 <div class="p-3 d-flex flex-column justify-content-between">
    //                         <div class="form-group ">
    //                             <input type="text" class="form-control form-control-user"
    //                                 id="formlink" aria-describedby="emailHelp"
    //                                 name="link"
    //                                 placeholder="Enter link">
    //                         </div>
                       
    //                 </div>
    //         </div>`,
    //     showConfirmButton: true,
    //     confirmButtonText: "Login",
    //     showLoaderOnConfirm: true,
    //     preConfirm: () => {
    //       const link = $("#formlink").val();
    //       return new Promise((res, rej) => {
    //         res({ link });
    //       });
    //     },
    //   })
    //     .then((res) => {
    //       if (res.isConfirmed) {
    //         console.log(res.value.link);
    //         const link = res.value.link;
    //         const r = this.editor.getSelection(true)
    //         this.editor.updateContents(new Delta().retain(r.index).delete(r.length).insert(text, {link}))
    //       }
    //     })
    //     .catch((err) => {});
    // },
    simpanData: function (e) {
      const doc = this.editor.root;
      //   console.log(this.editor.root)
      const elems = doc.querySelectorAll("img");

      const fileToServer = [];
      this.$swal.fire({
        title: "Uploading...",
        text: "Mohon Tunggu...",
        allowEscapeKey: false,
        allowOutsideClick: false,
        onBeforeOpen: () => {
          this.$swal.showLoading();
        },
      });

      const files = new FormData();

      elems.forEach((image) => {
        for (let i = 0; i < this.fileUploaded.length; i++) {
          const file = this.fileUploaded[i];
          if (file.dataUri == image.src) {
            files.append("fileImages[]", file.file);
            console.log("appending ke ", i + 1);
            this.fileUploaded.splice(0, 1);
            break;
          }
        }
      });
      if (isValidated()) {
        axios
          .post("/api/uploadImages", files, {
            headers: { "Content-Type": "multipart/form-data" },
          })
          .then((res) => {
            const filesResponse = res.data;
            console.log(filesResponse);
            console.log("respon dari server");
            if (filesResponse.length > 0) {
              elems.forEach((image) => {
                image.src = filesResponse[0];
                image.style.maxWidth="100%";
                image.style.width="auto";
                filesResponse.splice(0, 1);
              });
            }
            const dataBerita = {
              Judul: this.judul,
              Content: doc.innerHTML,
            };
            axios
              .post("/api/berita", dataBerita)
              .then((res) => {
                  
                  console.log(res.data)
                this.$swal.close();
                //   axios.post("")
                this.$swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: "Berita Berhasil dipublish",
                  showCloseButton: false,
                  showCancelButton: false,
                  showConfirmButton: false,
                  timer: 1000,
                }).then(()=>{
                    this.$router.go(0)
                });
              })
              .catch((err) => {
                  console.log(err.response)
                this.$swal.fire({
                  icon: "error",
                  title: "Oppss...",
                  text: err.response.message,
                  showCloseButton: false,
                  showCancelButton: false,
                  showConfirmButton: false,
                  timer: 1000,
                });
              });
          })
          .catch((err) => {
            console.log(err.response);
            this.$swal.close();
          });
      }
    },
    imageHandler: function (e) {
      $("#uploader").click(); // trigger input file clicked
    },
    fileUpload: function (e) {
      console.log("uploading...");
      const range = this.editor.getSelection(true);
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = (ev) => {
        console.log(range);
        this.fileUploaded.push({ file, dataUri: ev.target.result });
        this.editor.insertEmbed(range.index, "image", ev.target.result, "user");
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>