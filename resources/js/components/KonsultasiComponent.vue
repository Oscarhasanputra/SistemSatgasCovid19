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
            <form action="#" class="p-5 bg-light">
              <div class="form-group">
                <label for="name">Nama Pasien *</label>
                <input type="text" class="form-control" id="nama" />
              </div>
              <div class="form-group">
                <label for="usia">Usia Pasien *</label>
                <input type="text" class="form-control" id="usia" />
              </div>
              <div class="form-group">
                <label for="jeniskelamin">Jenis Kelamin *</label>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="exampleRadios"
                    id="exampleRadios1"
                    value="option1"
                    checked
                  />
                  <label class="form-check-label" for="exampleRadios1">
                    Laki - Laki
                  </label>
                  &emsp14; &emsp14; &emsp14;

                  <input
                    class="form-check-input"
                    type="radio"
                    name="exampleRadios"
                    id="exampleRadios2"
                    value="option2"
                  />
                  <label class="form-check-label" for="exampleRadios2">
                    Perempuan
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="alamat"
                  >Alamat domisili (mohon tulis alamat lengkap termasuk
                  kecamatan, kelurahan ) *
                </label>
                <textarea
                  name=""
                  id="alamat"
                  cols="30"
                  rows="5"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group">
                <label for="hp">Nomor Whatsapp / HP*</label>
                <input type="text" class="form-control" id="hp" />
              </div>
              <div class="form-group">
                <label for="tanggallahir">Tanggal Lahir *</label>
                <input type="date" class="form-control" id="tanggallahir" />
              </div>
              <div class="form-group">
                <label for="agama">Agama *</label>
                <input type="text" class="form-control" id="agama" />
              </div>

              <div class="form-group">
                <label for="tanggalpositif">Tanggal Positif *</label>
                <input type="date" class="form-control" id="tanggalpositif" />
              </div>

              <div class="form-group">
                <label for="gejala">Gejala *</label>
                <input type="text" class="form-control" id="gejala" />
              </div>

              <div class="form-group">
                <label for="konsul"
                  >Apakah sudah konsul dokter sebelumnya ? *</label
                >
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="exampleRadios"
                    id="exampleRadios1"
                    value="option1"
                    checked
                  />
                  <label class="form-check-label" for="exampleRadios1">
                    Sudah
                  </label>
                  &emsp14; &emsp14; &emsp14;

                  <input
                    class="form-check-input"
                    type="radio"
                    name="exampleRadios"
                    id="exampleRadios2"
                    value="option2"
                  />
                  <label class="form-check-label" for="exampleRadios2">
                    Belum
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="penyakit"
                  >Apakah ada penyakit sebelum terpapar ? Bila ada sebutkan.
                  *</label
                >
                <input type="text" class="form-control" id="penyakit" />
              </div>

              <div class="form-group">
                <label for="obatan"
                  >Apakah ada obat-obatan yang diminum sebelumnya? Bila ada
                  sebutkan. *
                </label>
                <input type="text" class="form-control" id="obatan" />
              </div>

              <div class="form-group">
                <label for="Penanggung"
                  >Nama Penanggung Jawab (jika berbeda dengan Pasien)</label
                >
                <input type="text" class="form-control" id="Penanggung" />
              </div>

              <div class="form-group">
                <label for="WaPenanggung"
                  >No WA Penanggung Jawab (jika berbeda dengan Pasien)</label
                >
                <input type="text" class="form-control" id="WaPenanggung" />
              </div>

              <div class="form-group">
                <input type="submit" value="Konsul" class="btn btn-primary" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>