<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Konsultasi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          Status Filter :
          <select v-model="status" @change="filterStatus">
            <option nama="dokter" value="">--</option>
            <option nama="dokter" value="Menunggu">Menunggu</option>
            <option nama="dokter" value="Konsultasi">Konsultasi</option>
            <option nama="dokter" value="Sembuh">Sembuh</option>
            <option nama="dokter" value="Meninggal">Meninggal</option>
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
                <th>No HP/WA</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(konsul, index) in listKonsultasi" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ konsul.pasien.NamaPasien }}</td>
                <td>{{ konsul.Tanggal }}</td>
                <td>{{ konsul.pasien.NoHP }}</td>
                <td>{{ konsul.Status }}</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#Lihat"
                    @click="prosesModal(konsul)"
                  >
                    Lihat
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#Proses"
                    @click="prosesModal(konsul)"
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
              <b>Lihat Data Konsul</b>
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
                <td>{{ editDataKonsultasi.pasien.NamaPasien }}</td>
              </tr>
              <tr>
                <th>Tanggal</th>
                <td>{{ editDataKonsultasi.Tanggal }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>{{ editDataKonsultasi.Status }}</td>
              </tr>
              <tr>
                <th>Diagnosa</th>
                <td>
                  {{
                    editDataKonsultasi.Diagnosa
                      ? editDataKonsultasi.Diagnosa
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Gejala</th>
                <td>
                  {{
                    editDataKonsultasi.Gejala ? editDataKonsultasi.Gejala : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Pernah Berobat</th>
                <td>{{ editDataKonsultasi.PernahBerobat }}</td>
              </tr>
              <tr>
                <th>Riwayat Penyakit</th>
                <td>
                  {{
                    editDataKonsultasi.RiwayatPenyakit
                      ? editDataKonsultasi.RiwayatPenyakit
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Konsumsi Obat</th>
                <td>
                  {{
                    editDataKonsultasi.KonsumsiObat
                      ? editDataKonsultasi.KonsumsiObat
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Obat</th>
                <td>
                  <div
                    class="d-flex flex-row flex-wrap"
                    v-if="editDataKonsultasi.detail"
                  >
                    <div
                      class="btn btn-primary mx-2 my-2"
                      v-for="(obat, index) in editDataKonsultasi.detail"
                      :key="index"
                    >
                      {{ obat.obat && obat.obat.NamaObat }}
                      <div class="fw-bold text-white">({{ obat.Qty }})</div>
                    </div>
                  </div>
                  <div v-else>Tidak ada</div>
                </td>
              </tr>

              <tr>
                <th>Butuh Oksigen</th>
                <td>{{ editDataKonsultasi.ButuhOksigen }}</td>
              </tr>
              <tr>
                <th>Butuh Oxymeter</th>
                <td>{{ editDataKonsultasi.ButuhOxymeter }}</td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger">Kembali</button>
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
            <h5 class="modal-title" id="exampleModalLabel"><b>Proses</b></h5>
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
                <td>{{ editDataKonsultasi.NamaPasien }}</td>
              </tr>
              <tr>
                <th>Dokter</th>
                <td>
                  <select
                    name="Dokter"
                    v-model="editDataKonsultasi.IDDokter"
                    class="requiredSave"
                  >
                    <option
                      v-for="(dokter, index) in listDokter"
                      :key="index"
                      nama="dokter"
                      :value="dokter.IDUser"
                    >
                      {{ dokter.Nama }}
                    </option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <select
                    v-model="editDataKonsultasi.Status"
                    class="requiredSave"
                  >
                    <option nama="dokter" value="Menunggu">Menunggu</option>
                    <option nama="dokter" value="Konsultasi">Konsultasi</option>
                    <option nama="dokter" value="Sembuh">Sembuh</option>
                    <option nama="dokter" value="Meninggal">Meninggal</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="ajukanProses">
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
      editDataKonsultasi: {
        pasien: {},
        detail: {
          obat: {},
        },
      },
      listKonsultasi: [],
      listDokter: [],
      status: "",
    };
  },
  mounted() {
    this.getKonsultasi();
    Request.get("/api/user/dokter").then((res) => {
      this.listDokter = res.data;
    });
  },
  methods: {
    getKonsultasi: function (status = "") {
      Request.get("/api/konsultasi", { Status: status }).then((res) => {
        this.listKonsultasi = res.data;
        this.$nextTick(() => {
          $("#dataTable").DataTable();
        });
      });
    },
    prosesModal: function (konsultasi) {
      // console.log(konsultasi)
      this.editDataKonsultasi = konsultasi;
    },
    ajukanProses: function () {
      const data = {
        IDTrTele: this.editDataKonsultasi.IDTrTele,
        NamaPasien: this.editDataKonsultasi.pasien.NamaPasien,
        IDDokter: this.editDataKonsultasi.IDDokter,
        Status: this.editDataKonsultasi.Status,
      };

      if (isValidated(".requiredSave")) {
        Request.put("/api/konsultasi/" + data.IDTrTele, data)
          .then((res) => {
            this.$router.go(0);
          })
          .catch((err) => {});
      }
    },
    filterStatus: function () {
      this.getKonsultasi(this.status);
    },
  },
};
</script>