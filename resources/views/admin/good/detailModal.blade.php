<div  wire:ignore.self class="modal fade" id="detailGood" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>    
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{$v_name}}</td>
                        </tr>
                        <tr>
                            <th>Stok Barang</th>
                            <td>{{$v_stok}}</td>
                        </tr>
                        <tr>
                            <th>Foto Barang</th>
                            <td><img src="{{$v_image}}" style="height: 100px; width: 200px " alt=""></td>
                        </tr>
                        <tr>
                            <th>Deskripsi Barang</th>
                            <td>{{$v_desc}}</td>
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