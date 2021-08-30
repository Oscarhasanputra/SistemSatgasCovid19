<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Konsul Dokter</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          Status Filter :
          <select @change="filterStatus" v-model="status">
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
                <th>Tanggal</th>
                <th>No HP</th>
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
                    v-if="konsul.Status=='Konsultasi'"
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

    <!-- Modal lihat-->
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
                <th>Nama</th>
                <td>
                  {{
                    editDataKonsultasi.pasien &&
                    editDataKonsultasi.pasien.NamaPasien
                  }}
                </td>
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
                  }}
                </td>
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
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Proses Konsul</b>
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
                    editDataKonsultasi.pasien &&
                    editDataKonsultasi.pasien.NamaPasien
                  }}
                </td>
              </tr>
              <tr>
                <th>Diagnosa</th>
                <td>
                  <textarea
                    rows="10"
                    name="text"
                    id=""
                    v-model="editDataKonsultasi.Diagnosa"
                  />
                </td>
              </tr>
              <tr>
                <th>Obat</th>
                
                <td>
                  <AutoComplete
                  :search="search"
                  placeholder="Cari Obat"
                  aria-label="Cari Obat"
                  @submit="selectedObat"
                  :get-result-value="getResultVal"
                  >
                  <template #result="{result,props}">
                    <li v-bind="props" class="autocomplete-result">{{result.NamaObat}} ({{result.Jumlah}})</li>
                  </template>

                  </AutoComplete>
                  <!-- <select
                    @change="selectedObat"
                    name="Obat"
                    class="requiredSav"
                  >
                    <option value="">--</option>
                    <option
                      v-for="(obat, index) in listObat"
                      :key="index"
                      nama="dokter"
                      :value="index"
                    >
                      {{ obat.NamaObat }}
                    </option>
                  </select> -->
                  <table id="editTable" class="table" v-if="editDataKonsultasi.detail">
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
                        <tr   v-for="(obat, index) in selected"
                      :key="obat.NamaObat + index">
                      <td>  <span class="text-danger fw-bold" style="cursor:pointer;" @click="deleteItemSelected(index)">X</span>
                      {{ obat.NamaObat }} 
                      </td>
                      <td>{{obat.Qty}}</td>
                    
                      </tr>
                      </tbody>
                  </table>
                 
                <div v-else> Tidak Ada</div>
                  
                  <!-- <div class="d-flex flex-row flex-wrap">
                    <div
                      class="btn btn-primary mx-2 my-2"
                      v-for="(obat, index) in selected"
                      :key="index"
                    >
                      <span class="text-danger fw-bold" @click="deleteItemSelected(index)">X</span>
                      {{ obat.NamaObat }}
                    </div>
                  </div> -->
                </td>
              </tr>

              <tr>
                <th>Butuh Oksigen</th>
                <td>
                  <select
                    name="oxygen"

                    class="form-select"
                    v-model="editDataKonsultasi.ButuhOksigen"
                    :disabled="editDataKonsultasi.StatusPeminjaman"
                  >
                    <option nama="dokter" value="Ya">Ya</option>
                    <option nama="dokter" value="Tidak">Tidak</option>
                  </select>
                  <span class="text-danger" v-if="editDataKonsultasi.StatusPeminjaman"> ! {{editDataKonsultasi.ButuhOksigen? 'Pengajuan Peminjaman Telah Dilakukan pada Konsultasi ini':'Masih Terdapat Pengajuan Peminjaman untuk Pasien terkait'}}</span>
                </td>
              </tr>
              <tr>
                <th>Butuh Oxymeter</th>
                <td>
                  <select
                    name="oxymeter"
                    class="form-select"
                    v-model="editDataKonsultasi.ButuhOxymeter"
                    :disabled="editDataKonsultasi.StatusPeminjaman"
                  >
                    <option nama="dokter" value="Ya">Ya</option>
                    <option nama="dokter" value="Tidak">Tidak</option>
                  </select>

                  <span class="text-danger" v-if="editDataKonsultasi.StatusPeminjaman"> ! {{editDataKonsultasi.ButuhOxymeter? 'Pengajuan Peminjaman Telah Dilakukan pada Konsultasi ini':'Masih Terdapat Pengajuan Peminjaman untuk Pasien terkait'}}</span>
   
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
import Swal from "vue-sweetalert2";

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
      listObat: [],
      selected: [],
      status: "",
    };
  },
  mounted() {
    this.getKonsultasi();
    Request.get("/api/obat/tersedia")
      .then((res) => {
        this.listObat = res.data;
         this.$nextTick(() => {
          $("#dataTable").DataTable();
          $("#editTable").DataTable({
          searching:false,
          info:false,
        })
        }); 
      })
      .catch((err) => {});
  },
  methods: {
    getResultVal:function(obat){
      return obat.NamaObat;
    },
    search:function(){

      if(this.selected.length>0){
          let listObats=[...this.listObat]
        this.selected.map((selectedObat)=>{
          for(let i=0;i<listObats.length;i++){
            const obat=listObats[i];
            if(obat.IDObat==selectedObat.IDObat){
              listObats.splice(i,1);
              break;
            }
          }
        })
        return listObats;
      }
      return this.listObat;
      // return this.listObat.map((obat)=>obat.NamaObat);
    },
    deleteItemSelected:function(index){
        this.selected.splice(index,1);
    },
    getKonsultasi: function (status = "") {
      Request.get("/api/konsultasi/dokter", { Status: status }).then((res) => {
        this.listKonsultasi = res.data;

      });
    },
    prosesModal: function (konsultasi) {
      this.editDataKonsultasi = konsultasi;
      if((konsultasi.pasien && konsultasi.pasien.pinjam.length>0)||(konsultasi.ButuhOksigen || konsultasi.ButuhOxymeter) ){
        this.editDataKonsultasi.StatusPeminjaman=true;
      }
      this.editData = {};
      this.selected=[];
    },
    ajukanProses: function () {
        const data={
            listObat:this.selected,
            ...this.editDataKonsultasi
        }
        if (isValidated(".requiredSave")) {
          Request.put("/api/dokter/konsultasi/" + data.IDTrTele, data)
            .then((res) => {
              this.$router.go(0);
            // console.log(res.data)
            })
            .catch((err) => {
                console.log(err.response)
            });
        }
    },
    filterStatus: function () {
      this.getKonsultasi(this.status);
    },
    selectedObat: function (obat) {
      
        this.$swal
          .fire({
            title: "Jumlah Obat " + obat.NamaObat,
            showCancelButton: true,
            confirmButtonText: "Simpan",
            showLoaderOnConfirm: true,
            html: ` <div class="mb-3">
    <label for="jumlahObat" class="form-label">Masukan Jumlah Obat</label>
    <input tabindex="1" type="number" class="form-control" id="jumlahObat" >
  </div>`,
            preConfirm: () => {
              return new Promise((res, rej) => {
                const inputVal = $("#jumlahObat").val();
                if (obat.Jumlah - inputVal < 0) {
                  this.$swal.showValidationMessage("Stok Obat Terbatas");
                }
                res({
                  JumlahObat: $("#jumlahObat").val(),
                });
              });
            },
          })
          .then((data) => {
            if (data.isConfirmed) {
              const { JumlahObat } = data.value;
              this.selected.push({
                Qty:JumlahObat,
                ...obat,
              });
            }
          })
          .catch((err) => {});
      
    },
  },
};
</script>