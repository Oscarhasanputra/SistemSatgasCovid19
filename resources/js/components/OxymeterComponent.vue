<template>
  <div>
    <div class="hero-v2">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6 text-center mx-auto">
            <h1 class="heading mb-3">Form Pendaftaran Peminjaman Oxymeter</h1>
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
              <label for="darimana"
                >Dapat info program kerja sama peminjaman tabung oksigen ini
                dari mana? *</label
              >
              <input
                type="text"
                name="Sumber Informasi"
                class="form-control required"
                id="sumber"
                v-model="formPinjam.Sumber"
              />
            </div>
            <div class="form-group">
              <label for="name">Nama Pasien *</label>
              <input
                type="text"
                :disabled="disabled.NamaPasien"
                name="Nama Pasien"
                class="form-control required"
                id="nama"
                v-model="formPasien.NamaPasien"
              />
            </div>
            <div class="form-group">
              <label for="usia">Usia Pasien *</label>
              <input
                type="number"
                :disabled="disabled.Usia"
                max="100"
                min="1"
                name="Usia Pasien"
                class="form-control required"
                id="usia"
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
                  id="exampleRadios1"
                  value="Laki-Laki"
                  :disabled="disabled.JenisKelamin"
                  checked
                  v-model="formPasien.JenisKelamin"
                />
                <label class="form-check-label" for="exampleRadios1">
                  Laki - Laki
                </label>
                &emsp14; &emsp14; &emsp14;

                <input
                  class="form-check-input"
                  type="radio"
                  name="jk"
                  id="exampleRadios2"
                  value="Perempuan"
                  :disabled="disabled.JenisKelamin"
                  v-model="formPasien.JenisKelamin"
                />
                <label class="form-check-label" for="exampleRadios2">
                  Perempuan
                </label>
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
                :disabled="disabled.Alamat"
                class="form-control required"
                v-model="formPasien.Alamat"
              ></textarea>
            </div>

            <div class="form-group">
              <label for="tanggallahir">Tanggal Lahir *</label>
              <input
                type="date"
                :disabled="disabled.TanggalLahir"
                name="Tanggal Lahir"
                class="form-control required"
                id="tanggallahir"
                v-model="formPasien.TanggalLahir"
              />
            </div>

            <div class="form-group">
              <label for="ktp">Unggah Foto KTP Pasien *</label>
              <input
                type="file"
                accept="image/png, image/jpeg"
                :disabled="disabled.FotoKTP"
                data-message="Foto KTP belum diupload"
                :class="'form-control ' + (disabled ? '' : 'required')"
                id="ktp"
                @change="uploadKTP"
              />
            </div>
            <img
              v-if="disabled.FotoKTP"
              :src="'/storage/' + formPasien.FotoKTP"
              height="100"
              width="100"
            />

            <div class="form-group">
              <label for="Penanggung"
                >Nama Penanggung Jawab (jika berbeda dengan Pasien)</label
              >
              <input
                type="text"
                name="Nama Penanggung Jawab"
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
                name="Nomor Penanggung Jawab"
                class="form-control"
                id="WaPenanggung"
                :disabled="disabled.NoHPPenanggung"
                v-model="formPasien.NoHPPenanggung"
              />
            </div>

            <div class="form-group">
              <label for="hubungan">Hubungan dengan Penanggung Jawab</label>
              <select
                id="cars"
                name="Hubungan dengan Penanggung Jawab"
                class="form-control"
                :disabled="disabled.StatusPenanggung"
                v-model="formPasien.StatusPenanggung"
              >
                <option value="OrangTua" selected>Orang Tua</option>
                <option value="Suami-Istri">Suami / Istri</option>
                <option value="Anak">Anak</option>
                <option value="Teman">Teman</option>
                <option value="Lainnya">Yang Lainnya</option>
              </select>
            </div>

            <div class="form-group">
              <label for="gejala">Jelaskan Gejala Pasien *</label>
              <textarea
                name="Gejala"
                id="gejala"
                cols="30"
                rows="5"
                class="form-control required"
                v-model="formPinjam.Gejala"
              ></textarea>
            </div>

            <div class="form-group">
              <label for="saturasi"
                >Berapakah saturasi oksigen pasien? (Tanpa bantuan oksigen) Jika
                belum diukur dengan Oxymeter, karena tidak ada, silakan diisi
                dengan tanda minus ( - ) *
              </label>
              <input
                type="number"
                max="100"
                min="0"
                name="Saturasi"
                class="form-control required col-1 d-inline"
                id="saturasi"
                v-model="formPinjam.Saturasi"
              />
              <span>%</span>
            </div>

            <div class="form-group">
              <label for="tanggalpositif"
                >Rapid Swab Antigen / PCR Swab terakhir kapan yg menyatakan
                hasil positif? *</label
              >
              <input
                type="date"
                name="Tanggal Positif"
                class="form-control required"
                id="tanggalpositif"
                v-model="formPinjam.TanggalSwab"
              />
            </div>

            <div class="form-group">
              <label for="swab">Masukan foto hasil SWAB Antigen / PCR *</label>
              <input
                type="file"
                accept="image/png, image/jpeg"
                data-message="Bukti Swab belum diupload"
                class="form-control required"
                id="swab"
                @change="buktiSwabUpload"
              />
            </div>

            <div class="form-group">
              <label for="obat">Obat Covid yang diminum ?* </label>
              <input
                type="text"
                name="Obat Covid"
                class="form-control required"
                id="obat"
                v-model="formPinjam.KonsumsiObat"
              />
            </div>

            <div class="form-group">
              <label for="jeniskelamin"
                >Sudah berobat konsultasi ke dokter? *</label
              >
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="berobat"
                  value="Ya"
                  checked
                  v-model="formPinjam.PernahBerobat"
                />
                <label class="form-check-label" for="exampleRadios1">
                  Sudah
                </label>
                &emsp14; &emsp14; &emsp14;

                <input
                  class="form-check-input"
                  type="radio"
                  name="berobat"
                  value="Tidak"
                  v-model="formPinjam.PernahBerobat"
                />
                <label class="form-check-label" for="exampleRadios2">
                  Belum
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="ukur"
                >Sudah memiliki Tabung Oksigen di rumah saat ini? *</label
              >
              <select
                id="tabung"
                name="Ketersediaan Tabung Oksigen"
                class="form-control required"
                v-model="formPinjam.KetersediaanTabung"
              >
                <option value="" selected>-- Pilih --</option>
                <option value="sudah">Sudah</option>
                <option value="belum">Belum</option>
              </select>
            </div>

            <div class="form-group">
              <label for="golongandarah">Golongan Darah *</label>
              <select
                id="golongandarah"
                :disabled="disabled.GolonganDarah"
                name="Golongan Darah"
                class="form-control required"
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
              <button class="btn btn-primary" @click="submit()">
                Pinjam Oxymeter
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
      formPinjam: {
        PernahBerobat: "Ya",
      },
      formPasien: {
        JenisKelamin: "Laki-Laki",
      },
    };
  },
  mounted() {},
  methods: {
    submit: function () {
      const form = new FormData();
      // const test= objectToFor
      for (let key in this.formPasien) {
        const val=this.formPasien[key];
        if(val)
        form.append(key, val);
      }
      for (let key in this.formPinjam) {
        form.append(key, this.formPinjam[key]);
      }
      if (isValidated()) {
        Request.post("/api/oxymeter", form,{headers:{ 'Content-Type': 'multipart/form-data'}})
          .then((respon) => {
            // console.log(respon.data)
            this.$router.go(0)
          })
          .catch((err) => {});
      }
    },
    uploadKTP: function (e) {
      const file = e.target.files[0];
      // this.fileKTP.get
      this.formPasien.FotoKTP = file;
    },
    buktiSwabUpload: function (e) {
      const file = e.target.files[0];
      this.formPinjam.BuktiSwab = file;
    },
    checking: function () {
      Request.get("/api/checkpasien", {
        IDPasien: "PSN" + this.formPasien.NoHP,
      })
        .then((response) => {
          const data = response.data.DataPasien;
          this.formPasien = data;
          this.disabled = {...data};
        })
        .catch((err) => {
          console.log(err.response);
          this.disabled = {};
        });
    },
  },
};
</script>