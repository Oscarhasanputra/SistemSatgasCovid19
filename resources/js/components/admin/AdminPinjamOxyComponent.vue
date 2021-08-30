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
            <option nama="dokter" value="Dipinjamkan">Dipinjamkan</option>
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
                <th>Pinjaman</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>

                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr
                v-for="(pinjam, index) in listPinjam"
                :key="pinjam.IDTrPinjam"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ pinjam.JenisPinjaman }}</td>
                <td>
                  {{
                    pinjam.pasien && pinjam.pasien.NamaPasien
                      ? pinjam.pasien.NamaPasien
                      : "-"
                  }}
                </td>
                <td>
                  {{
                    pinjam.pasien && pinjam.pasien.Alamat
                      ? pinjam.pasien.Alamat
                      : "-"
                  }}
                </td>
                <td>{{ pinjam.created_at }}</td>
                <td>{{ pinjam.Status }}</td>
                <td>
                  <button
                    @click="editModal(pinjam)"
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#Lihat"
                  >
                    Lihat
                  </button>
                  <button
                    v-if="pinjam.Status != 'Selesai'"
                    @click="editModal(pinjam)"
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
              <b>Lihat Data Pinjam</b>
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
                    detailPinjam.pasien && detailPinjam.pasien.NamaPasien
                      ? detailPinjam.pasien.NamaPasien
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Alamat Pasien</th>
                <td>
                  {{
                    detailPinjam.pasien && detailPinjam.pasien.Alamat
                      ? detailPinjam.pasien.Alamat
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ detailPinjam.created_at }}</td>
              </tr>
              <tr>
                <th>Asal Pinjam</th>
                <td>{{ detailPinjam.AsalPinjam }}</td>
              </tr>
              <tr
                v-if="
                  detailPinjam.JenisPinjaman == 'Oxymeter' ||
                  detailPinjam.JenisPinjaman == 'Oxygen & Oxymeter'
                "
              >
              <th>Oxymeter</th>
              <td>{{detailPinjam.oxymeter ? detailPinjam.oxymeter.NamaOxy:'-'}}</td>
              </tr>
               <tr
                v-if="
                  detailPinjam.JenisPinjaman == 'Oxygen' ||
                  detailPinjam.JenisPinjaman == 'Oxygen & Oxymeter'
                "
              >
              <th>Oxygen</th>
              <td>{{detailPinjam.oxygen ? detailPinjam.oxygen.NamaOxy:'-'}}</td>
              </tr>
              <tr v-if="detailPinjam.TglKirim">
                <th>
                  Tanggal Kirim
                </th>
                <td>
                  {{new Date(detailPinjam.TglKirim).toISOString().slice(0, 10)}}
                </td>
              </tr>
              <tr v-if="detailPinjam.TglKembali">
                <th>
                  Tanggal Kembali
                </th>
                <td>
                  {{new Date(detailPinjam.TglKembali).toISOString().slice(0, 10)}}
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" @click="simpanData">
              Simpan
            </button> -->
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
              <b>Proses Oxy</b>
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
                    detailPinjam.pasien && detailPinjam.pasien.NamaPasien
                      ? detailPinjam.pasien.NamaPasien
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Alamat Pasien</th>
                <td>
                  {{
                    detailPinjam.pasien && detailPinjam.pasien.Alamat
                      ? detailPinjam.pasien.Alamat
                      : "-"
                  }}
                </td>
              </tr>
              <tr>
                <th>Asal Pinjam</th>
                <td>
                  <select class="form-select" v-model="detailPinjam.AsalPinjam">
                    <option value="Anjuran Dokter">Anjuran Dokter</option>
                    <option value="Pinjam Sendiri">Pinjam Sendiri</option>
                  </select>
                </td>
              </tr>
              <tr
                v-if="
                  detailPinjam.JenisPinjaman == 'Oxygen' ||
                  detailPinjam.JenisPinjaman == 'Oxygen & Oxymeter'
                "
              >
                <th>Oxygen</th>
                <td>
                  <AutoComplete
                    :search="oxygen"
                    :placeholder="oxygen().length>0 ? `Cari Oxygen`:`Oxygen Tidak Tersedia`"
                    aria-label="Cari Oxygen"
                    @submit="selectedOxy"
                    :get-result-value="getResultVal"
                  >
                    <template #result="{ result, props }">
                      <li v-bind="props" class="autocomplete-result">
                        {{ result.NamaOxy }}
                      </li>
                    </template>
                  </AutoComplete>
                </td>
              </tr>
               <tr
                v-if="
                  detailPinjam.JenisPinjaman == 'Oxymeter' ||
                  detailPinjam.JenisPinjaman == 'Oxygen & Oxymeter'
                "
              >
                <th>Oxymeter</th>
                <td>
                  <AutoComplete
                    :search="oxymeter"
                    :placeholder="oxymeter().length>0 ? `Cari Oxymeter`:`Oxymeter Tidak Tersedia`"
                    aria-label="Cari Oxymeter"
                    @submit="selectedOxymeter"
                    :get-result-value="getResultVal"
                  >
                    <template #result="{ result, props }">
                      <li v-bind="props" class="autocomplete-result">
                        {{ result.NamaOxy }}
                      </li>
                    </template>
                  </AutoComplete>
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <select class="form-select" v-model="detailPinjam.Status">
                    <option nama="dokter" value="Menunggu">Menunggu</option>
                    <option nama="dokter" value="Dipinjamkan">
                      Dipinjamkan
                    </option>
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
import "@trevoreyre/autocomplete-vue/dist/style.css";
import AutoComplete from "@trevoreyre/autocomplete-vue";
export default {
  components: {
    AutoComplete,
  },
  data() {
    return {
      status: "",
      listPinjam: [],
      listOxy: [],
      detailPinjam: {},
    };
  },
  mounted() {
    this.getListPinjam();
    Request.get("/api/data/oxygen", { Status: "Tersedia" }).then((res) => {
      this.listOxy = res.data;
    });
  },
  methods: {
    getResultVal: function (oxy) {
      return oxy.NamaOxy;
    },
    selectedOxy:function(oxy){
      this.detailPinjam.IDOxygen = oxy.IDOxy;
    },
    selectedOxymeter:function(oxy){
      this.detailPinjam.IDOxymeter= oxy.IDOxy;
    },

    oxygen: function () {
      const filtered = this.listOxy.filter((oxy) => oxy.Jenis == "Oxygen");
      return filtered;
    },
    oxymeter: function () {
      const filtered = this.listOxy.filter((oxy) => oxy.Jenis == "Oxymeter");
      return filtered;
    },
    filterStatus: function () {
      this.getListPinjam(this.status);
    },
    getListPinjam: function (status = "") {
      Request.get("/api/oxy", { Status: status }).then((res) => {
        this.listPinjam = res.data;
        this.$nextTick(() => {
          $("#dataTable").DataTable();
        });
      });
    },
    editModal: function (dataPinjam) {
      this.detailPinjam = dataPinjam;
    },
    simpanData: function () {
      const {IDOxygen,IDOxymeter}=this.detailPinjam;
    
      Request.put("/api/oxy/" + this.detailPinjam.IDTrPinjam, this.detailPinjam)
        .then((res) => {
          this.$router.go(0)
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
};
</script>