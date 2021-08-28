@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Master Admin</h1>
     
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
                                <th>Nama</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>001</td>
                                <td>Hasan</td>
                                <td>************</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                                    Edit
                                  </button>
                                  <button type="button" class="btn btn-danger">
                                    Delete
                                  </button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>012</td>
                                <td>Udin</td>
                                <td>************</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                                    Edit
                                  </button>
                                  <button type="button" class="btn btn-danger">
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
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Admin</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                <tr>
                    <th>ID</th>
                    <td>001</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>Hasan</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <th>Confirm Password</th>
                    <td><input type="password" name="password" id=""></td>
                </tr>
             
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
            </div>
            </div>
            </div>
            {{-- end modal edit--}}


        <!-- Modal Proses-->
        <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Admin</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td><input type="text" name="id" id="" value="005" disabled> </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <th>Confirm Password</th>
                    <td><input type="password" name="password" id=""></td>
                </tr>
             
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
        </div>
        </div>
        </div>
        {{-- end modal proses --}}


    </div>
@endsection