  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="createReceipent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjam</h5>
          <button type="button" class="close" data-dismiss="modal" wire:click="closeCreate() aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="storePeminjam" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" wire:model="name" id="name">
              @error('name')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Kantor Cabang:</label>
              <input type="text" class="form-control" wire:model="cabang" id="name">
              @error('cabang')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeCreate()">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  