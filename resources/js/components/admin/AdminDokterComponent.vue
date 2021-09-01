<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Dokter</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <button
            type="button"
            class="btn btn-success"
            data-toggle="modal"
            data-target="#Tambah"
          >
            Tambah
          </button>
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>No</th>
                <th>Username ID</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Password</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(dokter, index) in listDokter" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ dokter.Username }}</td>
                <td>{{ dokter.Nama }}</td>
                <td>{{ dokter.NoHP }}</td>
                <td>******</td>
                <td>
                  <button
                    type="button"
                    @click="editModal(dokter)"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#edit"
                  >
                    Edit
                  </button>
                  <button type="button" class="btn btn-danger" @click="deleteDokter(dokter.IDUser)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal edit-->
    <div
      class="modal fade"
      id="edit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Edit Dokter</b>
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th>Username ID</th>
                <td>
                  <input
                    class="requiredEdit"
                    type="text"
                    name="Nama Dokter"
                    id=""
                    v-model="editDataDokter.Username"
                  />
                </td>
              </tr>
              <tr>
                <th>Nama</th>
                <td>
                  <input
                    class="requiredEdit"
                    type="text"
                    name="Nama Dokter"
                    id=""
                    v-model="editDataDokter.Nama"
                  />
                </td>
              </tr>
              <tr>
                <th>No HP</th>
                <td>
                  <input
                    class="requiredEdit"
                    type="text"
                    name="No HP"
                    id=""
                    v-model="editDataDokter.NoHP"
                  />
                </td>
              </tr>
              <tr>
                <th>Password</th>
                <td>
                  <input
                    class="requiredEdit"
                    type="password"
                    name="Password"
                    id=""
                    v-model="editDataDokter.Password"
                  />
                </td>
              </tr>
              <tr>
                <th>Confirm Password</th>
                <td>
                  <input
                    class="requiredEdit"
                    type="password"
                    name="Confirm Password"
                    id=""
                    v-model="editDataDokter.ConfirmPassword"
                  />
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editData">
              Simpan
            </button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Proses-->
    <div
      class="modal fade"
      id="Tambah"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Tambah Dokter</b>
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th>Username ID</th>
                <td>
                  <input
                    type="text"
                    name="Nama Dokter"
                    id=""
                    v-model="dataDokter.Username"
                  />
                </td>
              </tr>
              <tr>
                <th>Nama</th>
                <td>
                  <input
                    class="requiredSave"
                    type="text"
                    name="Nama Dokter"
                    id=""
                    v-model="dataDokter.Nama"
                  />
                </td>
              </tr>
              <tr>
                <th>No HP</th>
                <td>
                  <input
                    class="requiredSave"
                    type="text"
                    name="No HP"
                    id=""
                    v-model="dataDokter.NoHP"
                  />
                </td>
              </tr>
              <tr>
                <th>Password</th>
                <td>
                  <input
                    class="requiredSave"
                    type="password"
                    name="Password"
                    id=""
                    v-model="dataDokter.Password"
                  />
                </td>
              </tr>
              <tr>
                <th>Confirm Password</th>
                <td>
                  <input
                    class="requiredSave"
                    type="password"
                    name="Confirm Password"
                    id=""
                    v-model="dataDokter.ConfirmPassword"
                  />
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="simpanData">
              Simpan
            </button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { isValidated } from "../../utilities/validate";
import Request from "../../utilities/request";
export default {
  data() {
    return {
      dataDokter: {},
      editDataDokter: {},
      listDokter: [],
    };
  },
  mounted() {
    Request.get("/api/user/dokter")
      .then((res) => {
        const data = res.data;
        this.listDokter = data;
        this.$nextTick(() => {
          $("#dataTable").DataTable();
        });
      })
      .catch((err) => {});
  },
  methods: {
    editModal: function (data) {
      this.editDataDokter = data;
      // delete this.editDataDokter.Password
    },
    simpanData: function () {
      if (isValidated(".requiredSave")) {
        if (this.dataDokter.Password != this.dataDokter.ConfirmPassword)
          return this.$swal({
            title: "Form Kosong",
            text: " Pastikan Konfirmasi Password sama dengan Password ",
            icon: "error",
          });

        Request.post("/api/user/dokter", this.dataDokter)
          .then((res) => {
            this.$router.go(0);
          })
          .catch((err) => {});
      }
    },
    deleteDokter:function(id){
       this.$swal({
        title: "Hapus Data Dokter",
        text: "Apakah Anda yakin ingin menghapus data Dokter ini?",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        showCancelButton: true,
        cancelButtonColor: "red",
      })
        .then((ans) => {
          if (ans.isConfirmed) {
            Request.delete("/api/user/dokter/" + id).then((res) => {
              this.$router.go(0);
            });
          }
        })
        .catch((err) => {});
    },
    editData: function () {
      console.log("edit");
      if (isValidated(".requiredEdit")) {
        if (this.editDataDokter.Password != this.editDataDokter.ConfirmPassword)
          return this.$swal({
            title: "Form Kosong",
            text: " Pastikan Konfirmasi Password sama dengan Password ",
            icon: "error",
          });

        Request.put(
          "/api/user/dokter/" + this.editDataDokter.IDUser,
          this.editDataDokter
        )
          .then((res) => {
            this.$router.go(0);
          })
          .catch((err) => {});
      }
    },
  },
};
</script>