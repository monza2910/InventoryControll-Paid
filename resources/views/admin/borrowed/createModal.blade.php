  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="tambahPinjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" wire.click="close()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="storePinjaman" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="">Tipe Peminjam :</label>
              <select class="form-control" wire:model.live="type">
                <option value="">Pilih tipe peminjam</option>
                <option value="internal">Internal</option>
                <option value="eksternal">Eksternal</option>
              </select>
              @error('type')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>

            <div class="form-group">
              <label for="">Nama Peminjam :</label>
              <select class="form-control" wire:model.live="receipent_id">
                <option value="">Pilih Peminjam</option>
                @foreach ($peminjams as $peminjam)
                <option value="{{$peminjam->id}}">{{$peminjam->name}} ({{$peminjam->cabang}})</option>
                @endforeach
              </select>
              @error('receipent_id')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>

            @if ($receipent_id != null)
            
            <div class="form-group">
              <label for="">Barang Yang Dipinjam :</label>
              <select class="form-control" wire:model.live="good_id">
                <option value="">Pilih Barang</option>
                @foreach ($goods as $good)
                <option value="{{$good->id}}">{{$good->name}} ({{$good->qty}})</option>
                @endforeach
              </select>
              @error('good_id')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>

            <div class="form-group">
              <label for="name" class="col-form-label">Masukan Jumlah Pinjam:</label>
              <input type="number" min="1" class="form-control" wire:model.live="qty" id="qty">
              @error('qty')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Catatan(optional) :</label>
              <textarea class="form-control" wire:model="note" cols="30" rows="10"></textarea>
              @error('note')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>
            @endif
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" wire.click="close()">Close</button>
              @if ($good_id && $qty)
              <button type="submit" class="btn btn-primary">Save changes</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  