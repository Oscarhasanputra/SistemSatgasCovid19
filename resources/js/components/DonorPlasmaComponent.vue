<template>
    <div>
        <div class="hero-v2 ">
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
                    <form action="#" class="p-5 bg-light">
                      <div class="form-group">
                        <label for="name">Nama Pasien *</label>
                        <input type="text" class="form-control" id="nama">
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
                        <label for="alamat">Alamat *
                        </label>
                        <textarea name="" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="hp">Nomor Whatsapp / HP*</label>
                        <input type="text" class="form-control" id="hp">
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
                        <label for="rhesus">Rhesus *</label>
                        <select id="cars" class="form-control" >
                            <option value="pilih" selected>-- Pilih --</option>
                            <option value="positif">Positif (+)</option>
                            <option value="negatif">Negatif (-)</option>
                          </select>
                      </div>

                      <div class="form-group">
                        <label for="profesi">Profesi *</label>
                        <input type="text" class="form-control" id="profesi">
                      </div>

                      <div class="form-group">
                        <label for="bb">Berat Badan (Kg) *</label>
                        <input type="text" class="form-control" id="bb">
                      </div>

                      <div class="form-group">
                        <label for="tanggalpositif">Tanggal terkonfirmasi Covid-19 *</label>
                        <input type="date" class="form-control" id="tanggalpositif">
                      </div>
                      <div class="form-group">
                        <label for="tanggalsembuh">Tanggal sembuh Covid-19</label>
                        <input type="date" class="form-control" id="tanggalsembuh">
                      </div>

                      <div class="form-group">
                        <label for="tanggalsembuh">Dengan ini saya bersedia melakukan donor Plasma Konvalesen</label><br>
                        <input type="submit" value="Daftar Donor" class="btn btn-primary">
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
    
}
</script>