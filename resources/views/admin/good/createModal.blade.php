  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="createGood" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="storeGood" enctype="multipart/form-data">
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
              <label for="image" class="col-form-label">Image:</label>
              <input type="file" class="form-control" wire:model="image" id="image">
              @error('image')
              <small class="text-danger">
                {{$message}}
              </small>
              @enderror
            </div>

            <div class="form-group">
              @if ($image)
                  Image Preview: <br>
                  <img style="width: 200px; height : 100px" src="{{ $image->temporaryUrl() }}">
              @endif
            </div>
            <div class="form-group">
              <label for="description" class="col-form-label">Description:</label>
              <textarea class="form-control" wire:model="description" id="description"></textarea>
              @error('description')
              <small class="text-danger">
                  {{$message}}
              </small>
              @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  