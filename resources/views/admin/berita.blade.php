@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Master Berita</h1>
     
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
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Isi Konten</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Vaksinasi Pada Vihara Buddhi Vardhana</td>
                                <td><img src="{{asset("images/Penguins.jpg")}}" alt="" height="80"></td>
                                <td>Oksigensdasdasdasdasdasdasdasd</td>
                                <td>24 Agustus 2020</td>
                                <td>Aktif</td>
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
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Berita</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                <tr>
                    <th>Judul</th>
                    <td><input type="text" name="" id="" value="Vaksinasi Pada Vihara Buddhi Vardhana"> </td>
                </tr>
               
                <tr>
                    <th>Gambar</th>
                    <td><input type="file" name="" id=""></td>
                </tr>
                <tr>
                    <th>Isi Konten</th>
                    <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select>
                        <option nama="dokter" value="A">Aktif</option>
                        <option nama="dokter" value="B">Tidak Aktif</option>
                      </select></td>
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


        <!-- Modal Tambah-->
        <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Berita</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
               
                <tr>
                    <th>Judul</th>
                    <td><input type="text" name="" id="" value="Vaksinasi Pada Vihara Buddhi Vardhana"> </td>
                </tr>
               
                <tr>
                    <th>Gambar</th>
                    <td><input type="file" name="" id=""></td>
                </tr>
                <tr>
                    <th>Isi Konten</th>
                    <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select>
                        <option nama="dokter" value="A">Aktif</option>
                        <option nama="dokter" value="B">Tidak Aktif</option>
                      </select></td>
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