<template>
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-12 col-sm-8">
        <label for="judul" class="form-label">Judul</label>
        <input
          type="email"
          class="form-control required"
          id="judul"
          aria-describedby="emailHelp"
          v-model="berita.Judul"
        />
      </div>

      <div class="col-12 col-sm-4">
        <label for="hubungan">Status</label>
        <select
          id="cars"
          name="Status Penanggung Jawab"
          v-model="berita.Status"
          class="form-control"
        >
          <option value="Aktif" selected>Aktif</option>
          <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
      </div>
    </div>

    <div id="editor" class="container-fluid position-relative"></div>
    <input
      type="file"
      style="display: none"
      id="uploader"
      @change="fileUpload"
    />
    <button class="btn btn-primary my-3" @click="simpanData">Simpan</button>

    <button class="btn btn-danger my-3" @click="deleteData">Hapus</button>
  </div>
</template>
<script>
import "quill/dist/quill.snow.css";
import Quill from "quill/dist/quill";
import axios from "axios";
import { isValidated } from "../../utilities/validate";
import Request from "../../utilities/request";
export default {
  data() {
    return {
      berita: {},
      editor: {},
      filesAwal: [],
      fileUploaded: [],
    };
  },
  mounted() {
    const id = this.$route.params.id;

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
      ["image"],

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
    Request.get("/api/berita/" + id).then((res) => {
      const data = res.data;
      this.berita = data;
      const doc = this.editor.root;

      doc.innerHTML = data.Content;
      //   console.log(this.editor.root)
      const elems = doc.querySelectorAll("img");
      elems.forEach((image) => {
        //   console.log($(image).attr("src"))
        this.filesAwal.push($(image).attr("src"));
      });

    });

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
    deleteData: function () {
      this.$swal
        .fire({
          title: "Menghapus Berita",
          text: "Apakah Anda Yakin ingin menghapus berita ini?",
          icon: "question",
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: "red",
        })
        .then((confirmed) => {
          if (confirmed.isConfirmed) this.deleting();
        });
    },
    deleting: async function () {
      const fileDeleted = this.filesAwal.map((fileStr) => fileStr);
      // console.log(fileDeleted);
      this.$swal.fire({
        title: "Uploading...",
        text: "Mohon Tunggu...",
        allowEscapeKey: false,
        // allowOutsideClick: false,
        showConfirmButton: false,

        onBeforeOpen: () => {
          this.$swal.showLoading();
        },
      });
      try {
        const res = await axios.delete("/api/berita/" + this.$route.params.id);
        await axios.delete("/api/deleteImages", {
          data: {
            filesDeleted: fileDeleted,
          },
        });

        this.$swal.close();
        //   axios.post("")
        this.$swal
          .fire({
            icon: "success",
            title: "Berhasil",
            text: res.data.message,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1000,
          })
          .then(() => {
            //   console.log(res.data)
            this.$router.push({ name: "AdminBerita" });
          });
      } catch (error) {

        this.$swal.close();
        this.$swal
          .fire({
            icon: "error",
            title: "Oppss...",
            text: error.response.data.message,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1000,
          })
          .then(() => {
            this.$router.push({ name: "AdminBerita" });
          });
      }
    },
    simpanData: function (e) {
      const doc = this.editor.root;
      //   console.log(this.editor.root)
      const elems = doc.querySelectorAll("img");

      const fileToServer = [];
      this.$swal.fire({
        title: "Uploading...",
        text: "Mohon Tunggu...",
        allowEscapeKey: false,
        // allowOutsideClick: false,
        showConfirmButton: false,

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
            // console.log("appending ke ", i + 1);
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
             console.log(filesResponse)
            elems.forEach((image) => {
              const imageSrc = $(image).attr("src");
              for (let i = 0; i < this.filesAwal.length; i++) {
                if (imageSrc == this.filesAwal[i]) {
                  this.filesAwal.splice(i, 1);
                  return;
                } 
              }
              if(filesResponse[0]){
                  image.src = filesResponse[0];

                    image.style.maxWidth="100%";
                    image.style.width="auto";
                  filesResponse.splice(0, 1);
              }
            });

            const fileDeleted = this.filesAwal.map((fileStr) => fileStr);
            
            const dataBerita = {
              ...this.berita,
              Content: doc.innerHTML,
            };
            axios
              .post("/api/berita", dataBerita)
              .then(async (res) => {
                await axios.delete("/api/deleteImages", {
                  data: {
                    filesDeleted: fileDeleted,
                  },
                });
                this.$swal.close();
                //   axios.post("")
                this.$swal
                  .fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.data.message,
                    showCloseButton: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                  })
                  .then(() => {
                    //   console.log(res.data)
                    this.$router.go(0);
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
            this.$swal.close();
          });
      }
    },
    imageHandler: function (e) {
      $("#uploader").click(); // trigger input file clicked
    },
    fileUpload: function (e) {
      const range = this.editor.getSelection(true);
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = (ev) => {
        this.fileUploaded.push({ file, dataUri: ev.target.result });
        this.editor.insertEmbed(range.index, "image", ev.target.result, "user");
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>