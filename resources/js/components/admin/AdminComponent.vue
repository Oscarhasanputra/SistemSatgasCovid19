<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Admin</h1>

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
                <th>Username ID</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
                
              <tr v-for="(user, index) in usersAdmin" :key="user.IDUser">
                <td>{{index+1}}</td>
                <td>{{user.Username}}</td>
                <td>{{user.Nama}}</td>
                <td>************</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#edit"
                    @click="editModal(user)"
                  >
                    Edit
                  </button>
                  <button type="button" class="btn btn-danger" @click="deleteUser(user)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal edit-->
    <div
      class="modal fade"
      id="edit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <b>Edit Admin</b>
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
              <tr>
                <th>Username ID</th>
                <td>{{editUser.Username}}</td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><input type="text" class="requiredEdit" name="Nama Admin" v-model="editUser.Nama"/></td>
              </tr>
              <tr>
                <th>Password</th>
                <td><input type="password" class="requiredEdit" name="Password" id="" v-model="editUser.Password"/></td>
              </tr>
              <tr>
                <th>Confirm Password</th>
                <td><input type="password" class="requiredEdit" name="Confirm Password" id="" v-model="editUser.ConfirmPassword"/></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              @click="editDataAdmin"
            >
              Simpan
            </button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Proses-->
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
              <b>Tambah Admin</b>
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
              <tr>
                <th>Username ID</th>
                <td>
                  <input type="text" class="requiredTambah" name="Username" id="" v-model="dataAdmin.Username"/>
                </td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><input type="text" class="requiredTambah" name="Nama Admin" id="" v-model="dataAdmin.Nama"/></td>
              </tr>
              <tr>
                <th>Password</th>
                <td><input type="password" class="requiredTambah" name="Password" id="" v-model="dataAdmin.Password"/></td>
              </tr>
              <tr>
                <th>Confirm Password</th>
                <td><input type="password" class="requiredTambah" name="Confirm Password" id="" v-model="dataAdmin.ConfirmPassword"/></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="saveDataAdmin">Simpan</button>
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
  data() {
    return {
      dataAdmin: {},
      usersAdmin:[],
      editUser:{}
    };
  },
  mounted() {
    // console.log("component mounted")
      Request.get("/api/user/admin").then(res=>{
          const data= res.data;
          this.usersAdmin=data;
          console.log(data);
      }).catch(err=>{
        console.log(err);
      })
    // console.log("admin component mounted");
  },
  methods: {
      deleteUser : function(user){
          this.$swal({
              title:"Hapus Data User",
              text:"Apakah Anda yakin ingin menghapus data User ini?",
              confirmButtonText:"Ya",
              cancelButtonText:"Batal",
              showCancelButton:true,
              cancelButtonColor:"red"
          }).then(ans=>{
              if(ans.isConfirmed){
                    Request.delete("/api/user/admin/"+user.IDUser).then(res=>{
                        this.$router.go(0)
                    })
              }
          }).catch(err=>{

          })
          
      },
      editModal : function(user){
         
          this.editUser=user;
          delete this.editUser.Password;
          
      },
      editDataAdmin: function () {

        if(isValidated(".requiredEdit")){
            if(this.editUser.Password!=this.editUser.ConfirmPassword)
                return this.$swal({
                      title:"Form Kosong",
                        text:" Pastikan Konfirmasi Password sama dengan Password ",
                        icon:"error",
                })

            Request.put("/api/user/admin/"+this.editUser.IDUser,this.editUser).then(res=>{
                this.$router.go(0)
            })
        }
    },
    saveDataAdmin: function () {

        if(isValidated(".requiredTambah")){
            if(this.dataAdmin.Password!=this.dataAdmin.ConfirmPassword)
                return this.$swal({
                      title:"Form Kosong",
                        text:" Pastikan Konfirmasi Password sama dengan Password ",
                        icon:"error",
                })

            Request.post("/api/user/admin",this.dataAdmin).then(res=>{
                // console.log(res.data)
                this.$router.go(0)
            })
        }
    },
  },
};
</script>