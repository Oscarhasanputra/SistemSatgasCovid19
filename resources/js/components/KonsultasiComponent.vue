<template>
  <div>
    <div class="hero-v2">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6 text-center mx-auto">
            <h1 class="heading mb-3">Form Pendaftaran Konsultasi</h1>
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
              <label for="usia">Usia Pasien *</label>
              <input
                type="number"
                class="form-control required"
                id="usia"
                name="Usia Pasien"
                :disabled="disabled.Usia"
                v-model="formPasien.Usia"
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
              <label for="alamat"
                >Alamat domisili (mohon tulis alamat lengkap termasuk kecamatan,
                kelurahan ) *
              </label>
              <textarea
                name="Alamat"
                id="alamat"
                cols="30"
                rows="5"
                v-model="formPasien.Alamat"
                :disabled="disabled.Alamat"
                class="form-control required"
              ></textarea>
            </div>

            <div class="form-group">
              <label for="tanggallahir">Tanggal Lahir *</label>
              <input
                type="date"
                class="form-control required"
                id="tanggallahir"
                name="Tanggal Lahir"
                :disabled="disabled.TanggalLahir"
                v-model="formPasien.TanggalLahir"
              />
            </div>

            <div class="form-group">
              <label for="hubungan">Agama*</label>
              <select
                id="agama"
                name="Agama"
                class="form-control required"
                :disabled="disabled.Agama"
                v-model="formPasien.Agama"
              >
                <option value="Buddha">Buddha</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katholik">Katholik</option>
                <option value="Hindu">Hindu</option>
              </select>
            </div>

            <div class="form-group">
              <label for="tanggalpositif">Tanggal Positif *</label>
              <input
                type="date"
                class="form-control required"
                id="tanggalpositif"
                v-model="formKonsultasi.Tanggal"
              />
            </div>

            <div class="form-group">
              <label for="konsul"
                >Apakah sudah konsul dokter sebelumnya ? *</label
              >
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="pernahberobat"
                  id="pernahberobat1"
                  value="Ya"
                  v-model="formKonsultasi.PernahBerobat"
                />
                <label class="form-check-label" for="pernahberobat1">
                  Sudah
                </label>
                &emsp14; &emsp14; &emsp14;

                <input
                  class="form-check-input"
                  type="radio"
                  name="pernahberobat"
                  id="pernahberobat2"
                  value="Tidak"
                  v-model="formKonsultasi.PernahBerobat"
                />
                <label class="form-check-label" for="pernahberobat2">
                  Belum
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="penyakit"
                >Apakah ada penyakit sebelum terpapar ? Bila ada sebutkan.
                *</label
              >
              <input
                type="text"
                class="form-control required"
                name="Riwayat Penyakit"
                id="penyakit"
                v-model="formKonsultasi.RiwayatPenyakit"
              />
            </div>

            <div class="form-group">
              <label for="obatan"
                >Apakah ada obat-obatan yang diminum sebelumnya? Bila ada
                sebutkan. *
              </label>
              <input
                type="text"
                class="form-control required"
                name="Obat yang Dikonsumsi"
                id="obatan"
                v-model="formKonsultasi.KonsumsiObat"
              />
            </div>

            <div class="form-group">
              <label for="Penanggung"
                >Nama Penanggung Jawab (jika berbeda dengan Pasien)</label
              >
              <input
                type="text"
                class="form-control"
                id="Penanggung"
                :disabled="disabled.Penanggung"
                v-model="formPasien.Penanggung"
              />
            </div>

            <div class="form-group">
              <label for="WaPenanggung"
                >No WA Penanggung Jawab (jika berbeda dengan Pasien)</label
              >
              <input
                type="number"
                class="form-control"
                :disabled="disabled.NoHPPenanggung"
                v-model="formPasien.NoHPPenanggung"
                id="WaPenanggung"
              />
            </div>

            <div class="form-group">
              <button class="btn btn-primary" @click="submit()">
                Ajukan Konsultasi
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
      formKonsultasi: {
        PernahBerobat: "Ya",
      },
      formPasien: {
        JenisKelamin: "Laki-Laki",
      },
    };
  },
  methods: {
    submit: function () {
      // const test= objectToFor
      const form = { ...this.formPasien, ...this.formKonsultasi };

      if (isValidated()) {
      Request.post("/api/konsultasi", form)
        .then((respon) => {
          this.$router.go(0);
        })
        .catch((err) => {});
      }
    },
    checking: function () {
      Request.get("/api/checkpasien", {
        IDPasien: "PSN" + this.formPasien.NoHP,
      })
        .then((response) => {
          const data = response.data.DataPasien;
         
          this.formPasien = data;
          this.disabled = { ...data };
        })
        .catch((err) => {
          this.disabled = {};
        });
    },
  },
};
</script>