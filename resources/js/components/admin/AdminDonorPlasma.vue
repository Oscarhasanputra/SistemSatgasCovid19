<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Peminjaman Oxy</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          Status Filter :
          <select v-model="status" @change="filterStatus">
            <option nama="dokter" value="">--</option>
            <option nama="dokter" value="Menunggu">Menunggu</option>
            <option nama="dokter" value="Selesai">Selesai</option>
          </select>
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Tanggal Positif</th>
                <th>Tanggal Sembuh</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr
                v-for="(pendonor, index) in listDonor"
                :key="pendonor.IDDonor"
              >
                <td>{{ index + 1 }}</td>
                <td>
                  {{
                    pendonor.pasien && pendonor.pasien.NamaPasien
                      ? pendonor.pasien.NamaPasien
                      : "-"
                  }}
                </td>

                <td>{{ pendonor.TanggalPositif }}</td>
                <td>{{ pendonor.TanggalSembuh }}</td>
                <td>{{ pendonor.Status }}</td>
                <td>
                  <button
                    @click="editModal(pendonor)"
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#Lihat"
                  >
                    Lihat
                  </button>
                  <button
                  v-if="pendonor.Status!='Selesai'"
                    @click="editModal(pendonor)"
                    type="button"
                    class="btn btn-success"
                    data-toggle="modal"
                    data-target="#Proses"
                  >
                    Proses
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Lihat-->
    <div
      class="modal fade"
      id="Lihat"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Lihat Data Pendonor</b>
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
                <th>Nama Pasien</th>
                <td>
                  {{
                    detailDonor.pasien && detailDonor.pasien.NamaPasien
                      ? detailDonor.pasien.NamaPasien
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Tanggal Positif</th>
                <td>{{ detailDonor.TanggalPositif }}</td>
              </tr>
              <tr>
                <th>Tanggal Sembuh</th>
                <td>{{ detailDonor.TanggalSembuh }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>{{ detailDonor.Status }}</td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" @click="simpanData">Simpan</button> -->
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Proses-->
    <div
      class="modal fade"
      id="Proses"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Proses Pendonor</b>
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
                <th>Nama Pasien</th>
                <td>
                  {{
                    detailDonor.pasien && detailDonor.pasien.NamaPasien
                      ? detailDonor.pasien.NamaPasien
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Tanggal Positif</th>
                <td>{{ detailDonor.TanggalPositif }}</td>
              </tr>
              <tr>
                <th>Tanggal Sembuh</th>
                <td>{{ detailDonor.TanggalSembuh }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <select v-model="detailDonor.Status">
                    <option nama="dokter" value="Menunggu">Menunggu</option>
                    <option nama="dokter" value="Selesai">Selesai</option>
                  </select>
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
import Request from "../../utilities/request";
export default {
  data() {
    return {
      listDonor: [],
      detailDonor: {},
      status: "",
    };
  },
  mounted() {
    this.getDonorList();
    Request.get("/api/pendonor").then((res) => {
      this.listDonor = res.data;
    });
  },
  methods: {
    filterStatus: function () {
      this.getDonorList(this.status);
    },
    getDonorList: function (status = "") {
      Request.get("/api/pendonor", { Status: status }).then((res) => {
        this.listDonor = res.data;
         this.$nextTick(()=>{
            $("#dataTable").DataTable()
        })
      });
    },
    editModal: function (dataPinjam) {
      this.detailDonor = dataPinjam;
    },
    simpanData: function () {
      Request.put("/api/donor/" + this.detailDonor.IDDonor, this.detailDonor)
        .then((res) => {
          this.$router.go(0);
          // console.log(res.data)
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
};
</script>