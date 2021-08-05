@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Peminjaman Oxy</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                   
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        Status Filter : 
                        <select>
                            <option nama="dokter" value="AB">--</option>
                            <option nama="dokter" value="A">Menunggu</option>
                            <option nama="dokter" value="B">Dipinjamkan</option>
                            <option nama="dokter" value="C">Selesai</option>
                          </select>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sir Oscar</td>
                                <td>02 Agustus 2021</td>
                                <td>Menunggu</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Lihat">
                                    Lihat
                                  </button>
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Proses">
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
                        <td>Sir. Oscar</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>01 Agustus 2021</td>
                    </tr>
                    <tr>
                        <th>Asal Pinjam</th>
                        <td><select>
                            <option nama="dokter" value="A">Anjuran Dokter</option>
                            <option nama="dokter" value="B">Pinjam Sendiri</option>
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
            {{-- end modal lihat--}}


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
                    <td>Sir. Oscar</td>
                </tr>
                <tr>
                    <th>Asal Pinjam</th>
                    <td><select>
                        <option nama="dokter" value="A">Anjuran Dokter</option>
                        <option nama="dokter" value="B">Pinjam Sendiri</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select>
                        <option nama="dokter" value="A">Menunggu</option>
                        <option nama="dokter" value="B">Dipinjamkan</option>
                        <option nama="dokter" value="B">Selesai</option>
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