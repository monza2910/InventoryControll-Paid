  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="tambahStok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" wire:click="closeForm()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="tambahStok" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="name" class="col-form-label">Nama Barang :</label>
              <select wire:model.live="good_id" class="form-control">
                  <option value="">Pilih barang...</option>
                @foreach ($addgoods as $good)
                  <option value="{{$good->id}}">{{$good->name}}</option> 
                @endforeach
              </select>
              @error('good_id')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>

            @if ($good_id)
              
              <div class="form-group">
                <label for="description" class="col-form-label">Jumlah:</label>
                <input type="number" min="1" wire:model.live="qty" class="form-control">
                @error('qty')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
              </div>

              <div class="form-group">
                <label for="description" class="col-form-label">Keterangan(Optional):</label>
                <textarea class="form-control" wire:model="note" id="description"></textarea>
                @error('note')
                <small class="text-danger">
                    {{$message}}
                </small>
                @enderror
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeForm()">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
              </div> 
            @endif

          </form>
        </div>
      </div>
    </div>
  </div>

  