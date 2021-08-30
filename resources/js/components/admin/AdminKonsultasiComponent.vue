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
                <td v-if="editDataKonsultasi.detail">
                  <table id="editTable" class="table">
                      <thead>
                        <tr>
                          <th>Obat</th>
                          <th>Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(obat,index) in editDataKonsultasi.detail" :key="index">
                           <td>{{obat.obat && obat.obat.NamaObat}}</td>
                           <td>{{obat.Qty}}</td>
                        </tr>
                      </tbody>
                  </table>
                 
                </td>
                <td v-else> Tidak Ada</td>
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
                <td>{{ editDataKonsultasi.pasien.NamaPasien }}</td>
              </tr>
              <tr>
                <th>Dokter</th>
                <td>
                    <AutoComplete
                  :search="search"
                  :placeholder="editDataKonsultasi.dokter && editDataKonsultasi.dokter.Nama? `${editDataKonsultasi.dokter.Nama}`:`Cari Dokter`"
                  aria-label="Cari Dokter"
                  @submit="selectedDokter"
                  :get-result-value="getResultVal"
                  >
                  <template #result="{result,props}">
                    <li v-bind="props" class="autocomplete-result">{{result.Nama}}</li>
                  </template>

                  </AutoComplete>
                </td>
              </tr>
              <!-- <tr>
                <th>Oksigen</th>
                <td>
                    <AutoComplete
                  :search="search"
                  placeholder="Cari Obat"
                  aria-label="Cari Obat"
                  @submit="selectedDokter"
                  :get-result-value="getResultVal"
                  >
                  <template #result="{result,props}">
                    <li v-bind="props" class="autocomplete-result">{{result.Nama}}</li>
                  </template>

                  </AutoComplete>
                </td>
              </tr> -->
              <tr>
                <th>Status</th>
                <td>
                  <select
                    v-model="editDataKonsultasi.Status"
                    class="requiredSave form-select"
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

import "@trevoreyre/autocomplete-vue/dist/style.css"
import AutoComplete from "@trevoreyre/autocomplete-vue";
export default {
  components:{
    AutoComplete
  },
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
      this.$nextTick(() => {
          $("#dataTable").DataTable();
          $("#editTable").DataTable({
          searching:false,
          info:false,
        })
        }); 
    });
  },
  methods: {
    selectedDokter:function(dokter){
        this.editDataKonsultasi.IDDokter=dokter.IDUser;
    },
    search:function(){
        return this.listDokter;
    },
    getResultVal:function(dokter){
        return dokter.Nama;
    },
    getKonsultasi: function (status = "") {
      Request.get("/api/konsultasi", { Status: status }).then((res) => {
        this.listKonsultasi = res.data;
        
      });
    },
    prosesModal: function (konsultasi) {
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