<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Pasien</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <button
            type="button"
            class="btn btn-success"
            data-toggle="modal"
            data-target="#Tambah"
          >
            Tambah
          </button>
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>No HP/WA</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(pasien,index) in listPasien" :key="index">
                <td>{{index+1}}</td>
                <th>{{pasien.IDPasien}}</th>
                <td>{{pasien.NamaPasien}}</td>
                <td>{{pasien.NoHP}}</td>
                <td>{{pasien.Alamat}}</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#Edit"
                    @click="editModalPasien(pasien)"
                  >
                    Edit
                  </button>
                  <button type="button" class="btn btn-danger" @click="deletePasien(pasien.IDPasien)">Delete</button>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Edit-->
    <div
      class="modal fade"
      id="Edit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Edit Pasien</b>
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
              <!-- <tr>
                    <th>ID Pasien</th>
                    <td><input type="text" name="" id="" value="005" disabled></td>
                </tr> -->
              <tr>
                <th>Nama Pasien *</th>
                <td>
                  <input
                    type="text"
                    class="requiredEdit"
                    name="Nama Pasien"
                    id=""
                    v-model="editDataPasien.NamaPasien"
                  />
                </td>
              </tr>
              <tr>
                <th>No HP Pasien *</th>
                <td>
                  <input
                    type="number"
                    name="No HP"
                    class="requiredEdit"
                    v-model="editDataPasien.NoHP"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Tanggal Lahir *</th>
                <td>
                  <input
                    type="date"
                    name="Tanggal Lahir"
                    class="requiredEdit"
                    v-model="editDataPasien.TanggalLahir"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Alamat *</th>
                <td>
                  <textarea
                    name="Alamat"
                    id=""
                    cols="30"
                    class="requiredEdit"
                    rows="10"
                    v-model="editDataPasien.Alamat"
                  ></textarea>
                </td>
              </tr>
              <tr>
                <th>Usia Pasien *</th>
                <td>
                  <input
                    type="number"
                    name="Usia Pasien"
                    class="requiredEdit"
                    v-model="editDataPasien.Usia"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Berat Badan Pasien(kg) *</th>
                <td>
                  <input
                    type="number"
                    name="Berat Badan"
                    class="requiredEdit"
                    v-model="editDataPasien.Berat"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Profesi Pasien *</th>
                <td>
                  <input
                    type="text"
                    name="Profesi Pasien"
                    class="requiredEdit"
                    v-model="editDataPasien.Profesi"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Agama Pasien *</th>
                <td>
                  <select
                    name="Agama Pasien"
                    class="requiredEdit"
                    v-model="editDataPasien.Agama"
                  >
                    <option nama="agama" value="Islam">Islam</option>
                    <option nama="agama" value="Buddha">Buddha</option>
                    <option nama="agama" value="Kristen">Kristen</option>
                    <option nama="agama" value="Katholik">Katholik</option>
                    <option nama="agama" value="Hindu">Hindu</option>
                    <option nama="agama" value="Konghucu">Konghucu</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Jenis Kelamin *</th>
                <td>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="jk"
                      id="exampleRadios1"
                      value="Laki-Laki"
                      v-model="editDataPasien.JenisKelamin"
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
                      v-model="editDataPasien.JenisKelamin"
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      Perempuan
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <th>Gol. Darah *</th>
                <td>
                  <select
                    class="requiredEdit"
                    v-model="editDataPasien.GolonganDarah"
                    name="Golongan Darah Pasien"
                  >
                    <option nama="golongan darah" value="A">A</option>
                    <option nama="golongan darah" value="AB">AB</option>
                    <option nama="golongan darah" value="O">O</option>
                    <option nama="golongan darah" value="B">B</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Rhesus Darah *</th>
                <td>
                  <select
                    class="requiredEdit"
                    v-model="editDataPasien.RhesusDarah"
                    name="Rhesus Darah Pasien"
                  >
                    <option nama="rhesus" value="Positive">Positif(+)</option>
                    <option nama="rhesus" value="Negative">Negatif(-)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Foto KTP {{editDataPasien.FotoKTP==''? '*':''}}</th>
                <td>
                  <input
                    type="file"
                    :class="editDataPasien.FotoKTP?'':'requiredEdit'"
                    accept="image/png, image/jpeg"
                    data-message="Foto KTP Pasien belum diupload"
                    id=""
                    @change="uploadKTPEdit"
                  />
                  <img v-if="editDataPasien.FotoKTP" :src="'/storage/'+editDataPasien.FotoKTP" height="100" width="100"/>
                </td>
              </tr>
              <tr>
                <th>Penanggung Jawab</th>
                <td>
                  <input
                    type="text"
                    name="Penanggung Jawab"
                    id=""
                    v-model="editDataPasien.Penanggung"
                  />
                </td>
              </tr>
              <tr>
                <th>No.Penanggung</th>
                <td>
                  <input
                    type="text"
                    name="No Hp Penanggung Jawab"
                    v-model="editDataPasien.NoHPPenanggung"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Status Penanggung</th>
                <td>
                  <select
                    name="Status Penanggung Jawab"
                    class="form-control"
                    v-model="editDataPasien.StatusPenanggung"
                  >
                    <option value="OrangTua" selected>Orang Tua</option>
                    <option value="Suami-Istri">Suami / Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Teman">Teman</option>
                    <option value="Lainnya">Yang Lainnya</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="simpanEditDataPasien">Simpan</button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah-->
    <div
      class="modal fade"
      id="Tambah"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Tambah Pasien</b>
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
              <!-- <tr>
                    <th>ID Pasien</th>
                    <td><input type="text" name="" id="" value="005" disabled></td>
                </tr> -->
              <tr>
                <th>Nama Pasien *</th>
                <td>
                  <input
                    type="text"
                    class="requiredSaved"
                    name="Nama Pasien"
                    id=""
                    v-model="dataPasien.NamaPasien"
                  />
                </td>
              </tr>
              <tr>
                <th>No HP Pasien *</th>
                <td>
                  <input
                    type="number"
                    name="No HP"
                    class="requiredSaved"
                    v-model="dataPasien.NoHP"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Tanggal Lahir *</th>
                <td>
                  <input
                    type="date"
                    name="Tanggal Lahir"
                    class="requiredSaved"
                    v-model="dataPasien.TanggalLahir"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Alamat *</th>
                <td>
                  <textarea
                    name="Alamat"
                    id=""
                    cols="30"
                    class="requiredSaved"
                    rows="10"
                    v-model="dataPasien.Alamat"
                  ></textarea>
                </td>
              </tr>
              <tr>
                <th>Usia Pasien *</th>
                <td>
                  <input
                    type="number"
                    name="Usia Pasien"
                    class="requiredSaved"
                    v-model="dataPasien.Usia"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Berat Badan Pasien(kg) *</th>
                <td>
                  <input
                    type="number"
                    name="Berat Badan"
                    class="requiredSaved"
                    v-model="dataPasien.Berat"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Profesi Pasien *</th>
                <td>
                  <input
                    type="text"
                    name="Profesi Pasien"
                    class="requiredSaved"
                    v-model="dataPasien.Profesi"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Agama Pasien *</th>
                <td>
                  <select
                    name="Agama Pasien"
                    class="requiredSaved"
                    v-model="dataPasien.Agama"
                  >
                    <option nama="agama" value="Islam">Islam</option>
                    <option nama="agama" value="Buddha">Buddha</option>
                    <option nama="agama" value="Kristen">Kristen</option>
                    <option nama="agama" value="Katholik">Katholik</option>
                    <option nama="agama" value="Hindu">Hindu</option>
                    <option nama="agama" value="Konghucu">Konghucu</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Jenis Kelamin *</th>
                <td>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="jk"
                      id="exampleRadios1"
                      value="Laki-Laki"
                      v-model="dataPasien.JenisKelamin"
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
                      v-model="dataPasien.JenisKelamin"
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      Perempuan
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <th>Gol. Darah *</th>
                <td>
                  <select
                    class="requiredSaved"
                    v-model="dataPasien.GolonganDarah"
                    name="Golongan Darah Pasien"
                  >
                    <option nama="golongan darah" value="A">A</option>
                    <option nama="golongan darah" value="AB">AB</option>
                    <option nama="golongan darah" value="O">O</option>
                    <option nama="golongan darah" value="B">B</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Rhesus Darah *</th>
                <td>
                  <select
                    class="requiredSaved"
                    v-model="dataPasien.RhesusDarah"
                    name="Rhesus Darah Pasien"
                  >
                    <option nama="rhesus" value="Positive">Positif(+)</option>
                    <option nama="rhesus" value="Negative">Negatif(-)</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Foto KTP *</th>
                <td>
                  <input
                    class="requiredSaved"
                    type="file"

                    accept="image/png, image/jpeg"
                    data-message="Foto KTP Pasien belum diupload"
                    id=""
                    @change="uploadKTP"
                  />
                </td>
              </tr>
              <tr>
                <th>Penanggung Jawab</th>
                <td>
                  <input
                    type="text"
                    name="Penanggung Jawab"
                    id=""
                    v-model="dataPasien.Penanggung"
                  />
                </td>
              </tr>
              <tr>
                <th>No.Penanggung</th>
                <td>
                  <input
                    type="text"
                    name="No Hp Penanggung Jawab"
                    v-model="dataPasien.NoHPPenanggung"
                    id=""
                  />
                </td>
              </tr>
              <tr>
                <th>Status Penanggung</th>
                <td>
                  <select
                    name="Status Penanggung Jawab"
                    class="form-control"
                    v-model="dataPasien.StatusPenanggung"
                  >
                    <option value="OrangTua" selected>Orang Tua</option>
                    <option value="Suami-Istri">Suami / Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Teman">Teman</option>
                    <option value="Lainnya">Yang Lainnya</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              @click="simpanDataPasien"
            >
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
import { isValidated} from "../../utilities/validate"
import Request from "../../utilities/request"
export default {
  data() {
    return {
      dataPasien: {
        JenisKelamin: "Laki-Laki",
      },
      editDataPasien:{
          
      },
      listPasien:[]
    };
  },
  mounted(){
      Request.get("/api/user/pasien").then(res=>{
          const data= res.data;
          this.listPasien=data;
      })
  },
  methods: {
    editModalPasien:function(user){
        this.editDataPasien=user;
    },
    deletePasien: function(id){
        this.$swal({
              title:"Hapus Data Pasien",
              text:"Apakah Anda yakin ingin menghapus data Pasien ini?",
              confirmButtonText:"Ya",
              cancelButtonText:"Batal",
              showCancelButton:true,
              cancelButtonColor:"red"
          }).then(ans=>{
              if(ans.isConfirmed){
                    Request.delete("/api/user/pasien/"+id).then(res=>{
                        this.$router.go(0)
                    })
              }
          }).catch(err=>{

          })
        console.log("delete user id",id)
    },
    uploadKTPEdit: function(e){

      const file = e.target.files[0];
      this.editDataPasien.FileFotoKTP=file;

    },
    uploadKTP: function (e) {
      const file = e.target.files[0];
      this.dataPasien.FotoKTP = file;
    },
    simpanDataPasien: function () {
      const form = new FormData();
      // const test= objectToFor
      for (let key in this.dataPasien) {
        const val = this.dataPasien[key];
        if (val) form.append(key, val);
      }
      if (isValidated(".requiredSaved")) {
        Request.post("/api/user/pasien", form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
          .then((respon) => {
              this.$router.go(0)
          })
          .catch((err) => {});
      }
    },
    simpanEditDataPasien: function(){
        const form = new FormData();
      // const test= objectToFor
      for (let key in this.editDataPasien) {
        const val = this.editDataPasien[key];
        if (val) form.append(key, val);
      }
      if (isValidated(".requiredEdit")) {
        Request.post("/api/user/pasien/"+this.editDataPasien.IDPasien, form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
          .then((respon) => {
              this.$router.go(0)
            // console.log(respon)
          })
          .catch((err) => {});
      }
    }
  },
};
</script>