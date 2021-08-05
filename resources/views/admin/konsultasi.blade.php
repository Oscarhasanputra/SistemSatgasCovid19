@extends('admin.main')

@section('content')
    <!-- Begin Page Content -->
   
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Konsultasi</h1>
     
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
                                <th>Tanggal Positif</th>
                                <th>No HP/WA</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Siska</td>
                                <td>02 - 12 - 2020</td>
                                <td>0899312312</td>
                                <td>Menunggu</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Lihat">
                                    Lihat
                                  </button>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Proses">
                                    Proses
                                  </button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Oline</td>
                                <td>02 - 05 - 2021</td>
                                <td>0899312312</td>
                                <td>Sembuh</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Lihat">
                                    Lihat
                                  </button>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Proses">
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
            <h5 class="modal-title" id="exampleModalLabel"><b>Lihat Data Konsul</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
                <tr>
                    <th>Nama Pasien</th>
                    <td>Siska</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>02 Agustus 2021</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>Sembuh</td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td>Covid-19</td>
                </tr>
                <tr>
                    <th>Gejala</th>
                    <td>Batuk, penciuman hilang</td>
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
                    <td>-</td>
                </tr>
                <tr>
                    <th>Obat</th>
                    <td>Fluvir</td>
                </tr>
                <tr>
                    <th>Jumlah Obat</th>
                    <td>2</td>
                </tr>
                <tr>
                    <th>Butuh Oksigen</th>
                    <td>Tidak</td>
                </tr>
                <tr>
                    <th>Butuh Oxymeter</th>
                    <td>Ya</td>
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
        <h5 class="modal-title" id="exampleModalLabel"><b>Proses</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table">
            <tr>
                <th>Nama Pasien</th>
                <td>Siska</td>
            </tr>
            <tr>
                <th>Dokter</th>
                <td>
                    <select>
                        <option nama="dokter" value="A">dr. Aditiya</option>
                        <option nama="dokter" value="B">dr. Oscar</option>
                        <option nama="dokter" value="C">dr. Yusuf</option>
                        <option nama="dokter" value="D">dr. Mansur</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><select>
                    <option nama="dokter" value="A">Menunggu</option>
                    <option nama="dokter" value="B">Konsultasi</option>
                    <option nama="dokter" value="C">Sembuh</option>
                    <option nama="dokter" value="D">Meninggal</option>
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