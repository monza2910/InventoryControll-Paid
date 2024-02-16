<div>

    @include('admin.receipent.createModal')
    @include('admin.receipent.editModal')
    @include('admin.receipent.deleteModal')

    <h1 class="mt-4">Data Nama Peminjam</h1>
        @if (session()->has('message'))
            <div class="alert alert-success text-center">
                {{session('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 form-group">
                        
                    </div>
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-primary d-inline float-right mx-2" data-toggle="modal" data-target="#createReceipent">
                            Tambah Peminjam
                        </button>
                        <input type="search" wire:model.live="search" style="width: 50%" 
                        placeholder="Masukan Keyword..." class="form-control d-inline float-right">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cabang</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @forelse($receipents as $item => $receipent)    
                            <tr>
                                <td>{{$item + 1}}</td>
                                <td>{{$receipent->name}}</td>
                                <td>{{$receipent->cabang}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" wire:click="editPeminjam({{$receipent->id}})">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletereceipent" 
                                    wire:click="deleteConfirmation({{$receipent->id}})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center">
                                    <span class="text-danger" >Data yang dicari tidak ada di database</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">

                {{ $receipents->links() }}
            </div>
        </div>
</div>

@push('scripts')

    <script>

        //Create modal 
        window.addEventListener('close-modal-create', event =>{
            $('#createReceipent').modal('hide');
        });
        
        //edit modal
        window.addEventListener('show-modal-edit', event =>{
            $('#editModal').modal('show');
        });

        //delete modal
        window.addEventListener('show-modal-delete', event =>{
            $('#deleteModal').modal('show');
        });
        window.addEventListener('close-modal-delete', event =>{
            $('#deleteModal').modal('hide');
        });

    </script>
    
@endpush