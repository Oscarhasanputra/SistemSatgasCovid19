<template>
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Peminjaman Oxy</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                    Status Filter : 
                        <select>
                            <option nama="dokter" value="AB">--</option>
                            <option nama="dokter" value="A">Menunggu</option>
                            <option nama="dokter" value="B">Dipinjamkan</option>
                            <option nama="dokter" value="C">Selesai</option>
                          </select>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pinjaman</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr v-for="(pinjam,index) in listPinjam" :key="pinjam.IDTrPinjam">
                                <td>{{index+1}}</td>
                                <td>{{pinjam.JenisPinjaman}}</td>
                                <td>{{(pinjam.pasien && pinjam.pasien.NamaPasien)? pinjam.pasien.NamaPasien:"-"}}</td>
                                <td>{{pinjam.created_at}}</td>
                                <td>{{pinjam.Status}}</td>
                                <td><button @click="editModal(pinjam)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#Lihat">
                                    Lihat
                                  </button>
                                  <button @click="editModal(pinjam)" type="button" class="btn btn-success" data-toggle="modal" data-target="#Proses">
                                    Proses
                                  </button></td>
                            </tr>
                          
              
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Lihat-->
        <div class="modal fade" id="Lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Lihat Data Pinjam</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                    <tr>
                        <th>Nama Pasien</th>
                        <td>{{(detailPinjam.pasien && detailPinjam.pasien.NamaPasien)?detailPinjam.pasien.NamaPasien:"-"}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{detailPinjam.created_at}}</td>
                    </tr>
                    <tr>
                        <th>Asal Pinjam</th>
                        <td><select v-model="detailPinjam.AsalPinjam">
                            <option nama="dokter" value="Anjuran Dokter">Anjuran Dokter</option>
                            <option nama="dokter" value="Pinjam Sendiri">Pinjam Sendiri</option>
                          </select></td>
                    </tr>
               
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="simpanData">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
            </div>
            </div>
            </div>

        <!-- Modal Proses-->
        <div class="modal fade" id="Proses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Proses Oxy</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
               
             
                <tr>
                    <th>Nama Pasien</th>
                    <td>{{(detailPinjam.pasien && detailPinjam.pasien.NamaPasien)?detailPinjam.pasien.NamaPasien:"-"}}</td>
                </tr>
                <tr>
                    <th>Asal Pinjam</th>
                    <td><select v-model="detailPinjam.AsalPinjam">
                        <option nama="dokter" value="Anjuran Dokter">Anjuran Dokter</option>
                        <option nama="dokter" value="Pinjam Sendiri">Pinjam Sendiri</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select v-model="detailPinjam.Status">
                        <option nama="dokter" value="Menunggu">Menunggu</option>
                        <option nama="dokter" value="Dipinjamkan">Dipinjamkan</option>
                        <option nama="dokter" value="Selesai">Selesai</option>
                      </select></td>
                </tr>
             
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="simpanData">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
        </div>
        </div>
        </div>

    </div>
</template>
<script>
import Request from "../../utilities/request"
export default {
    data(){
        return {
            listPinjam:[],
            detailPinjam:{}
        }
    },
    mounted(){
        Request.get("/api/oxy").then(res=>{
            this.listPinjam=res.data;
        })
    },
    methods:{
        editModal:function(dataPinjam){
            this.detailPinjam=dataPinjam
        },
        simpanData:function(){
            Request.put("/api/oxy/"+this.detailPinjam.IDTrPinjam,this.detailPinjam).then(res=>{
                // this.$router.go(0)
                console.log(res.data)
            }).catch(err=>{
                console.log(err.response)
            })
        }
    }
}
</script>