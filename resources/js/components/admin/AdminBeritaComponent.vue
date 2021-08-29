<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Berita</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <router-link to="/admin/tambahberita" class="btn btn-success">
            Tambah
          </router-link>
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th style="width:30% ">Isi Konten</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody class="custom-table">
              <tr v-for="(berita, index) in listBerita" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ berita.Judul }}</td>
                <td v-html="berita.Content" style="height:200px;text-overflow:ellipsis;overflow-x:hidden;overflow-y:scroll;max-width:300px;display:block;"></td>
                <td>{{ berita.created_at }}</td>
                <td>{{ berita.Status }}</td>
                <td>
                  <router-link
                    class="btn btn-primary"
                    :to="'/admin/berita/'+berita.IDBerita"
                  >
                    Edit
                  </router-link>
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
              <b>Edit Berita</b>
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
                <th>Judul</th>
                <td>
                  <input
                    type="text"
                    name=""
                    id=""
                    value="Vaksinasi Pada Vihara Buddhi Vardhana"
                  />
                </td>
              </tr>

              <tr>
                <th>Gambar</th>
                <td><input type="file" name="" id="" /></td>
              </tr>
              <tr>
                <th>Isi Konten</th>
                <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <select>
                    <option nama="dokter" value="A">Aktif</option>
                    <option nama="dokter" value="B">Tidak Aktif</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah-->
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
              <b>Tambah Berita</b>
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
                <th>Judul</th>
                <td>
                  <input
                    type="text"
                    name=""
                    id=""
                    value="Vaksinasi Pada Vihara Buddhi Vardhana"
                  />
                </td>
              </tr>

              <tr>
                <th>Gambar</th>
                <td><input type="file" name="" id="" /></td>
              </tr>
              <tr>
                <th>Isi Konten</th>
                <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <select>
                    <option nama="dokter" value="A">Aktif</option>
                    <option nama="dokter" value="B">Tidak Aktif</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Request from "../../utilities/request"
export default {
  data() {
    return {
      listBerita: [],
    };
  },
  mounted() {
    Request.get("/api/berita").then((res) => {
      // console.log(res.data)
      this.listBerita = res.data;
      this.$nextTick(()=>{
        $("#dataTable").DataTable()
      })
    });
  },
};
</script>