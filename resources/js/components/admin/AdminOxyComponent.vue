<template>
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Master Oxy</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tambah">
                        Tambah
                      </button>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Oxy</th>
                                <th>Jenis Oxy</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr v-for="(oxygen,index) in listOxy" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{oxygen.IDOxy}}</td>
                                <td>{{oxygen.NamaOxy}}</td>
                                <td>{{oxygen.Jenis}}</td>
                                <td>{{oxygen.Status}}</td>
                                <td><button type="button" class="btn btn-primary" @click="editModal(oxygen)" data-toggle="modal" data-target="#edit">
                                    Edit
                                  </button>
                                  <button @click="deleteOxy(oxygen.IDOxy)" type="button" class="btn btn-danger">
                                    Delete
                                  </button></td>
                            </tr>
                          
              
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal edit-->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Oxy</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="Nama Oxygen" id="" v-model="editDataOxy.NamaOxy"></td>
                </tr>
                <tr>
                    <th>Jenis Oxy</th>
                    <td><input type="text" name="Jenis Oxygen" id="" v-model="editDataOxy.Jenis"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select v-model="editDataOxy.Status">
                        <option nama="dokter" value="Tersedia">Tersedia</option>
                        <option nama="dokter" value="Terpakai">Terpakai</option>
                      </select></td>
                </tr>
             
               
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="editData">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
            </div>
            </div>
            </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Oxy</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
               
                <!-- <tr>
                    <th>ID</th>
                    <td><input type="text" name="" id="" value="002" disabled></td>
                </tr> -->
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="Nama Oxygen" id="" v-model="dataOxy.NamaOxy"></td>
                </tr>
                <tr>
                    <th>Jenis Oxy</th>
                    <td><input type="text" name="Jenis Oxygen" id="" v-model="dataOxy.Jenis"></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select v-model="dataOxy.Status">
                        <option nama="dokter" value="Tersedia">Tersedia</option>
                        <option nama="dokter" value="Terpakai">Terpakai</option>
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
import {isValidated} from "../../utilities/validate"
import Request from "../../utilities/request"
export default {
    data(){
        return{
            dataOxy:{
                Status:"Tersedia"
            },
            editDataOxy:{},
            listOxy:[]
        }
    },
    mounted(){
        Request.get("/api/data/oxygen").then(res=>{
            this.listOxy=res.data;
        })
    },
    methods:{
        editModal: function(oxygen){
            this.editDataOxy=oxygen;
        },
        simpanData : function(){
            if(isValidated(".requiredSave")){
                
                 
                 Request.post("/api/data/oxygen",this.dataOxy).then(res=>{
                        this.$router.go(0)
                 }).catch(err=>{
                    //  console.log(err)
                 })
            }
               
        },
        editData : function(){
            console.log("edit")
            if(isValidated(".requiredEdit")){
                
                 
                 Request.put("/api/data/oxygen/"+this.editDataOxy.IDOxy,this.editDataOxy).then(res=>{
                     this.$router.go(0)
                 }).catch(err=>{})
            }
        },
        deleteOxy: function(id){
            console.log("delete",id)
            this.$swal({
              title:"Hapus Data Oxygen",
              text:"Apakah Anda yakin ingin menghapus data Oxygen ini?",
              confirmButtonText:"Ya",
              cancelButtonText:"Batal",
              showCancelButton:true,
              cancelButtonColor:"red"
          }).then(ans=>{
              if(ans.isConfirmed){

                    Request.delete("/api/data/oxygen/"+id).then(res=>{
                        this.$router.go(0)
                    })
              }
          }).catch(err=>{

          })
        }
    }
}
</script>