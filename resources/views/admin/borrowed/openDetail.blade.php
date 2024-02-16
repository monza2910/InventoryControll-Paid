<div  wire:ignore.self class="modal fade" id="openDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>    
                        <tr>
                            <th>Nama Peminjam</th>
                            <td>{{$receipent_name}}</td>
                        </tr>
                        <tr>
                            <th>Cabang Peminjam</th>
                            <td>{{$receipent_cabang}}</td>
                        </tr>
                        <tr>
                            <th>Tipe Peminjam</th>
                            <td>{{$type}}</td>
                        </tr>
                        <tr>
                            <th>Barang Yang Dipinjam</th>
                            <td>{{$good_name}}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{$image}}" style="width:200px; height:100px" alt=""></td>
                        </tr>
                        <tr>
                          <th>Banyak Pinjam</th>
                          <td>{{$qtyPinjam}}</td>
                        </tr>
                        <tr>
                          <th>Tanggal Pinjam</th>
                          <td>{{$date_pinjam}}</td>
                        </tr>
                        <tr>
                          <th>Tanggal Kembali</th>
                          <td>{{$date_back}}</td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td>{{$status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="closeDetail()">Close</button>
        </div>
      </div>
    </div>
  </div>