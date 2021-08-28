@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Konsul Dokter</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                   
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        Status Filter : 
                        <select>
                            <option nama="dokter" value="AB">--</option>
                            <option nama="dokter" value="A">Menunggu</option>
                            <option nama="dokter" value="B">Konsultasi</option>
                            <option nama="dokter" value="C">Sembuh</option>
                            <option nama="dokter" value="D">Meninggal</option>
                          </select>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Merry</td>
                                <td>02 Agustus 2021</td>
                                <td>089993141</td>
                                <td>Konsultasi</td>
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

        <!-- Modal lihat-->
        <div class="modal fade" id="Lihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Lihat Data Konsul</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
               
                <tr>
                    <th>Nama</th>
                    <td>Merry</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>02 Agustus 2021</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>Konsultasi</td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td>Covid-19</td>
                </tr>
                <tr>
                    <th>Gejala </th>
                    <td>Batuk Pilek</td>
                </tr>
                <tr>
                    <th>Pernah Berobat</th>
                    <td>Belum</td>
                </tr>
                <tr>
                    <th>Riwayat Penyakit</th>
                    <td>Tidak ada</td>
                </tr>
                <tr>
                    <th>Konsumsi Obat</th>
                    <td>Epexol</td>
                </tr>
                </table>
            </div>
                <div class="modal-footer">
                 
                    <button type="button" class="btn btn-danger">Kembali</button>
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
        <h5 class="modal-title" id="exampleModalLabel"><b>Proses Konsul</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
              
                <tr>
                    <th>Nama Pasien</th>
                    <td>Merry</td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td><input type="text" name="password" id=""></td>
                </tr>
                <tr>
                    <th>Obat</th>
                    <td><input type="checkbox" name="password" id=""></td>
                </tr>
                <tr>
                    <th>Jumlah Obat</th>
                    <td><input type="text" name="password" id=""></td>
                </tr>
                <tr>
                    <th>Butuh Oksigen</th>
                    <td><select>
                        <option nama="dokter" value="A">Ya</option>
                        <option nama="dokter" value="B">Tidak</option>
                      </select></td>
                </tr>
                <tr>
                    <th>Butuh Oxymeter</th>
                    <td><select>
                        <option nama="dokter" value="A">Ya</option>
                        <option nama="dokter" value="B">Tidak</option>
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