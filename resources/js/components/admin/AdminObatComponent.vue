<template>
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Master Obat</h1>
     
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
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr v-for="(obat,index) in listObat" :key="index">
                                <td>{{index}}</td>
                                <td>{{obat.IDObat}}</td>
                                <td>{{obat.NamaObat}}</td>
                                <td>{{obat.JenisObat}}</td>
                                <td>{{obat.Jumlah}}</td>
                                 <td><button type="button" @click="editModal(obat)" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                                    Edit
                                  </button>
                                  <button type="button" @click="deleteObat(obat.IDObat)" class="btn btn-danger">
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
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Obat</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                <!-- <tr>
                    <th>ID</th>
                    <td>001</td>
                </tr> -->
                <tr>
                    <th>Nama Obat *</th>
                    <td><input type="text" name="Nama Obat" id="" v-model="editDataObat.NamaObat"></td>
                </tr>
                <tr>
                    <th>Jenis Obat *</th>
                    <td><input type="text" name="Jenis Obat" id="" v-model="editDataObat.JenisObat"></td>
                </tr>
                <tr>
                    <th>Jumlah *</th>
                    <td><input type="number" name="Jumlah Obat" id="" v-model="editDataObat.Jumlah"></td>
                </tr>
             
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="simpanDataEdit">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
            </div>
            </div>
            </div>
            

        <!-- Modal Proses-->
        <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Obat</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
               
                
               <tr>
                    <th>Nama Obat *</th>
                    <td><input type="text" name="Nama Obat" class="requiredSaved" id="" v-model="dataObat.NamaObat"></td>
                </tr>
                <tr>
                    <th>Jenis Obat *</th>
                    <td><input type="text" name="Jenis Obat" class="requiredSaved" id="" v-model="dataObat.JenisObat"></td>
                </tr>
                <tr>
                    <th>Jumlah *</th>
                    <td><input type="number" name="Jumlah Obat" class="requiredSaved" id="" v-model="dataObat.Jumlah"></td>
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
            dataObat:{

            },
            editDataObat:{

            },
            listObat:[]
            
        }
    },
    mounted(){
        Request.get("/api/obat").then(res=>{
            console.log(res.data)
            this.listObat=res.data;
        }).catch(err=>{

        })
    },
    methods:{
        deleteObat:function(id){
            this.$swal({
              title:"Hapus Data Obat",
              text:"Apakah Anda yakin ingin menghapus data Obat ini?",
              confirmButtonText:"Ya",
              cancelButtonText:"Batal",
              showCancelButton:true,
              cancelButtonColor:"red"
          }).then(ans=>{
              if(ans.isConfirmed){
                    Request.delete("/api/obat/"+id).then(res=>{
                        this.$router.go(0)
                    })
              }
          }).catch(err=>{

          })
        },
        editModal: function(obat){
            this.editDataObat=obat;
        },
        simpanData: function(){
            if(isValidated('.requiredSaved'))
                Request.post("/api/obat",this.dataObat).then((res)=>{
                    this.$router.go(0)
                    // console.log(res)
                }).catch(err=>{
                    // console.log(err.response)
                })
        },
         simpanDataEdit: function(){
            if(isValidated('.requiredEdit'))
                Request.put("/api/obat/"+this.editDataObat.IDObat,this.editDataObat).then((res)=>{
                    this.$router.go(0)
                }).catch(err=>{
                    console.log(err.response)
                })
        }
    }
}
</script>