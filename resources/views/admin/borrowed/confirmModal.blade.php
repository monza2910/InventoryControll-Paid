<div  wire:ignore.self class="modal fade" id="confirmKembali" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Confirmation  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah barang akan dikembalikan ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeConfirm()">Close</button>
          <button type="button" class="btn btn-primary" wire:click="confirmProses()">Selesai</button>
        </div>
      </div>
    </div>
  </div>