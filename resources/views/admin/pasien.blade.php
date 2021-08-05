@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Master Pasien</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tambah">
                            Tambah
                          </button>
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
                            <tr>
                                <td>1</td>
                                <th>001</th>
                                <td>Siska</td>                               
                                <td>0899312312</td>
                                <td>Karawaci</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Edit">
                                    Edit
                                  </button>
                                  <button type="button" class="btn btn-danger">
                                    Delete
                                  </button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <th>023</th>
                                <td>Oline</td>
                                <td>089935212</td>
                                <td>Pantai Indah Kapuk</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Edit">
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

        <!-- Modal Edit-->
        <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Pasien</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
                <tr>
                    <th>ID Pasien</th>
                    <td>001</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Profesi</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td> <select>
                        <option nama="dokter" value="A">Islam</option>
                        <option nama="dokter" value="B">Buddha</option>
                        <option nama="dokter" value="C">Kristen</option>
                        <option nama="dokter" value="D">Katholik</option>
                        <option nama="dokter" value="D">Hindu</option>
                        <option nama="dokter" value="D">Konghucu</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><input type="radio" name="" id=""></td>
                </tr>
                <tr>
                    <th>Gol. Darah</th>
                    <td><select>
                        <option nama="dokter" value="A">A</option>
                        <option nama="dokter" value="B">AB</option>
                        <option nama="dokter" value="C">O</option>
                        <option nama="dokter" value="D">B</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Rhesus Darah</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Foto KTP</th>
                    <td><input type="file" name="" id=""></td>
                </tr>
                <tr>
                    <th>Penanggung Jawab</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>No.Penanggung </th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Status Penanggung </th>
                    <td><input type="text" name="" id=""></td>
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
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Pasien</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>ID Pasien</th>
                    <td><input type="text" name="" id="" value="005" disabled></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Profesi</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td> <select>
                        <option nama="dokter" value="A">Islam</option>
                        <option nama="dokter" value="B">Buddha</option>
                        <option nama="dokter" value="C">Kristen</option>
                        <option nama="dokter" value="D">Katholik</option>
                        <option nama="dokter" value="D">Hindu</option>
                        <option nama="dokter" value="D">Konghucu</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><input type="radio" name="" id=""></td>
                </tr>
                <tr>
                    <th>Gol. Darah</th>
                    <td><select>
                        <option nama="dokter" value="A">A</option>
                        <option nama="dokter" value="B">AB</option>
                        <option nama="dokter" value="C">O</option>
                        <option nama="dokter" value="D">B</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Rhesus Darah</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Foto KTP</th>
                    <td><input type="file" name="" id=""></td>
                </tr>
                <tr>
                    <th>Penanggung Jawab</th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>No.Penanggung </th>
                    <td><input type="text" name="" id=""></td>
                </tr>
                <tr>
                    <th>Status Penanggung </th>
                    <td><input type="text" name="" id=""></td>
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