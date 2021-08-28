<template>
    <div>
         <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Pasien</h1>
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Positif</th>
                                <th>No WA</th>
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
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    konsul
                                  </button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Oline</td>
                                <td>02 - 05 - 2021</td>
                                <td>0899312312</td>
                                <td>Sembuh</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    konsul
                                  </button></td>
                            </tr>
              
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"><b>Detail</b></h5>
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
</div>
</div>
</div>
</div>

    </div>
    </div>
</template>