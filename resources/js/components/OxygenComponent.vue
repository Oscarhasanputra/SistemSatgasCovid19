<template>
    <div>
         <div class="hero-v1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6 text-center mx-auto">
           
            <h1 class="heading mb-3">Form Pendaftaran Peminjaman Tabung Oksigen </h1>
            <p class="mb-5">Selamat datang! Program ini adalah salah satu Program kerja sama antara Vihara Dharma Ratna dengan PC Magabudhi Kota Tangerang dalam kegiatan Peduli Covid. Bagi Anda yang membutuhkan tabung oksigen.
                Silakan Bapak/Ibu mengisi form ini terlebih dahulu dan kami akan segera menghubungi via Whatsapp Chat untuk memberikan informasi selanjutnya.</p>
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
                        <label for="darimana">Dapat info program kerja sama peminjaman tabung oksigen ini dari mana? *</label>
                        <input type="text" class="form-control" id="darimana">
                      </div>
                      <div class="form-group">
                        <label for="name">Nama Pasien *</label>
                        <input type="text" class="form-control" id="nama">
                      </div>
                      <div class="form-group">
                        <label for="usia">Usia Pasien *</label>
                        <input type="text" class="form-control" id="usia">
                      </div>
                      <div class="form-group">
                        <label for="jeniskelamin">Jenis Kelamin *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                             Laki - Laki
                            </label> &emsp14; &emsp14; &emsp14;
                            
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                              Perempuan
                            </label>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="alamat">Alamat domisili (mohon tulis alamat lengkap termasuk kecamatan, kelurahan ) *
                        </label>
                        <textarea name="" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="hp">Nomor Whatsapp / HP*</label>
                        <input type="text" class="form-control" id="hp">
                      </div>
                      <div class="form-group">
                        <label for="tanggallahir">Tanggal Lahir *</label>
                        <input type="date" class="form-control" id="tanggallahir">
                      </div>
                    
                      <div class="form-group">
                        <label for="ktp">Unggah Foto KTP Pasien *</label>
                        <input type="file" class="form-control" id="ktp">
                      </div>

                      <div class="form-group">
                        <label for="Penanggung">Nama Penanggung Jawab (jika berbeda dengan Pasien)</label>
                        <input type="text" class="form-control" id="Penanggung">
                      </div>

                      <div class="form-group">
                        <label for="WaPenanggung">No WA Penanggung Jawab (jika berbeda dengan Pasien)</label>
                        <input type="text" class="form-control" id="WaPenanggung">
                      </div>

                      <div class="form-group">
                        <label for="hubungan">Hubungan dengan Penanggung Jawab</label>
                        <select id="cars" class="form-control" >
                            <option value="orgtua" selected>Orang Tua</option>
                            <option value="suamiistri">Suami / Istri</option>
                            <option value="anak">Anak</option>
                            <option value="teman">Teman</option>
                            <option value="lain">Yang Lainnya</option>
                          </select>
                      </div>


                      <div class="form-group">
                        <label for="gejala">Jelaskan Gejala Pasien *</label>
                        <textarea name="" id="gejala" cols="30" rows="5" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="saturasi">Berapakah saturasi oksigen pasien? (Tanpa bantuan oksigen) Jika belum diukur dengan Oxymeter, 
                        karena tidak ada, silakan diisi dengan tanda minus ( - ) *
                        </label>
                        <input type="text" class="form-control" id="saturasi">
                      </div>

                      <div class="form-group">
                        <label for="tanggalpositif">Rapid Swab Antigen / PCR Swab terakhir kapan yg menyatakan hasil positif? *</label>
                        <input type="date" class="form-control" id="tanggalpositif">
                      </div>

                      <div class="form-group">
                        <label for="swab">Masukan foto hasil SWAB Antigen / PCR *</label>
                        <input type="file" class="form-control" id="swab">
                      </div>
                     
                      <div class="form-group">
                        <label for="obat">Obat Covid yang diminum ?*
                        </label>
                        <input type="text" class="form-control" id="obat">
                      </div>

                      <div class="form-group">
                        <label for="jeniskelamin">Sudah berobat konsultasi ke dokter? *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                             Sudah
                            </label> &emsp14; &emsp14; &emsp14;
                            
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                              Belum
                            </label>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="ukur">Masukkan foto pengukuran dengan Oxymeter</label>
                        <input type="file" class="form-control" id="ukur">
                      </div>

                      <div class="form-group">
                        <label for="golongandarah">Golongan Darah *</label>
                        <select id="cars" class="form-control" >
                            <option value="pilih" selected>-- Pilih --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="O">O</option>
                            <option value="AB">AB</option>
                          </select>
                      </div>

                      <div class="form-group">
                        <input type="submit" value="Pinjam Oksigen" class="btn btn-primary">
                      </div>

                    </form>
                 
                </div>

              </div>
             
            </div>
          </div>
    </div>
</template>
<script>
export default {
    mounted(){
        console.log("oxygen component")
    }
}
</script>