<template>
  <div>
    <div class="hero-v2">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6 text-center mx-auto">
            <h1 class="heading mb-3 mt-5">Form Relawan Donor Plasma</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- MAIN -->

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 blog-content">
            <div class="row justify-content-between">
              <div class="form-group col-8">
                <label for="hp">Nomor Whatsapp / HP*</label>
                <input
                  :disabled="disabled.NoHP"
                  type="number"
                  name="Nomor HP"
                  class="form-control required"
                  id="hp"
                  v-model="formPasien.NoHP"
                />
              </div>

              <button
                class="btn btn-primary col-3 align-self-center"
                @click="checking()"
              >
                Check Data Pasien
              </button>
            </div>
            <div class="form-group">
              <label for="name">Nama Pasien *</label>
              <input
                type="text"
                class="form-control required"
                id="nama"
                name="Nama Pasien"
                :disabled="disabled.NamaPasien"
                v-model="formPasien.NamaPasien"
              />
            </div>

            <div class="form-group">
              <label for="jeniskelamin">Jenis Kelamin *</label>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jk"
                  id="jk1"
                  value="Laki-Laki"
                  :disabled="disabled.JenisKelamin"
                  v-model="formPasien.JenisKelamin"
                />
                <label class="form-check-label" for="jk1"> Laki - Laki </label>
                &emsp14; &emsp14; &emsp14;

                <input
                  class="form-check-input"
                  type="radio"
                  name="jk"
                  id="jk2"
                  value="Perempuan"
                  :disabled="disabled.JenisKelamin"
                  v-model="formPasien.JenisKelamin"
                />
                <label class="form-check-label" for="jk2"> Perempuan </label>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat * </label>
              <textarea
                name="Alamat"
                id="alamat"
                cols="30"
                rows="5"
                class="form-control required"
                v-model="formPasien.Alamat"
                :disabled="disabled.Alamat"
              ></textarea>
            </div>

            <div class="form-group">
              <label for="golongandarah">Golongan Darah *</label>
              <select
                id="cars"
                name="Golongan Darah Pendonor"
                class="form-control required"
                :disabled="disabled.GolonganDarah"
                v-model="formPasien.GolonganDarah"
              >
                <option value="" selected>-- Pilih --</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
              </select>
            </div>

            <div class="form-group">
              <label for="rhesus">Rhesus *</label>
              <select
                id="cars"
                name="Rhesus Darah Pendonor"
                :disabled="disabled.RhesusDarah"
                class="form-control required"
                v-model="formPasien.RhesusDarah"
              >
                <option value="" selected>-- Pilih --</option>
                <option value="Positive">Positif (+)</option>
                <option value="Negative">Negatif (-)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="profesi">Profesi *</label>
              <input
                type="text"
                name="Profesi Pendonor"
                :disabled="disabled.Profesi"
                class="form-control required"
                id="profesi"
                v-model="formPasien.Profesi"
              />
            </div>

            <div class="form-group">
              <label for="bb">Berat Badan (Kg) *</label>
              <input
                type="number"
                class="form-control required"
                id="bb"
                name="Berat Badan Pendonor"
                v-model="formPasien.Berat"
              />
            </div>

            <div class="form-group">
              <label for="tanggalpositif"
                >Tanggal terkonfirmasi Covid-19 *</label
              >
              <input
                type="date"
                class="form-control required"
                id="tanggalpositif"
                name="Tanggal Positif Covid19"
                v-model="formDonor.TanggalPositif"
              />
            </div>
            <div class="form-group">
              <label for="tanggalsembuh">Tanggal sembuh Covid-19</label>
              <input
                type="date"
                class="form-control required"
                id="tanggalsembuh"
                name="Tanggal Sembuh dari Covid19"
                v-model="formDonor.TanggalSembuh"
              />
            </div>

            <div class="form-group">
              <label for="tanggalsembuh"
                >Dengan ini saya bersedia melakukan donor Plasma
                Konvalesen</label
              ><br />

              <button class="btn btn-primary" @click="submit()">
                Daftar Donor
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Request from "../utilities/request";
import { isValidated } from "../utilities/validate";
export default {
  data() {
    return {
      disabled: {},
      formDonor: {
        PernahBerobat: "Ya",
      },
      formPasien: {
        JenisKelamin: "Laki-Laki",
      },
    };
  },
  mounted(){

  },
  methods: {
    submit: function () {
      const form = { ...this.formPasien, ...this.formDonor };
      if(isValidated()){
        Request.post("/api/donorplasma", form)
          .then((res) => {
            const data = res.data;

            this.$router.go(0);
          })
          .catch((err) => {});
      }
    },
    checking: function () {
      Request.get("/api/admin/test").then(res=>{
        console.log("testing")
        console.log(res.data)
          Request.get("/api/admin").then(res=>{
        console.log(res.data)
      }).catch(err=>{
        console.log(err.response)
      })
      }).catch(err=>{
        console.log("testing")
        console.log(err.response)
      })
    
      
      // Request.get("/api/checkpasien", {
      //   IDPasien: "PSN" + this.formPasien.NoHP,
      // })
      //   .then((response) => {
      //     const data = response.data.DataPasien;
       
      //     this.formPasien = {...data};
      //     this.disabled = { ...data };
      //   })
      //   .catch((err) => {
      //     console.log(err.response);
      //     this.disabled = {};
      //   });
    },
  },
};
</script>