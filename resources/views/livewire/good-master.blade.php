<div>

    @include('admin.good.createModal')

    @include('admin.good.editModal')

    @include('admin.good.deleteModal')

    @include('admin.good.detailModal')

    <h1 class="mt-4">Data Barang</h1>
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
                        <button type="button" class="btn btn-primary d-inline float-right mx-2" data-toggle="modal" data-target="#createGood">
                            Tambah Barang
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
                                <th>Image</th>
                                <th>Description</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @forelse($goods as $item => $good)    
                            <tr>
                                <td>{{$item + 1}}</td>
                                <td>{{$good->name}}</td>
                                <td>
                                    @if ($good->image)
                                        <img style="width: 200px; height : 100px" src="{{ $good->image }}">
                                    @endif
                                </td>
                                <td>{{$good->description}}</td>
                                <td>{{$good->qty}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" wire:click="editGood({{$good->id}})">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteGood" 
                                    wire:click="deleteConfirmation({{$good->id}})">
                                        Hapus
                                    </button>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailGood" 
                                    wire:click="detailGood({{$good->id}})">
                                        Detail
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

                {{ $goods->links() }}
            </div>
        </div>
</div>

@push('scripts')

    <script>

        //Create modal 
        window.addEventListener('close-modal', event =>{
            $('#createGood').modal('hide');
        });
        
        //edit update modal
        window.addEventListener('close-modal-edit', event =>{
            $('#editGood').modal('hide');
        });

        window.addEventListener('show-modal-edit', event =>{
            $('#editGood').modal('show');
        });

        //delete modal
        window.addEventListener('show-modal-delete', event =>{
            $('#deleteGood').modal('show');
        });

        window.addEventListener('close-modal-delete', event =>{
            $('#deleteGood').modal('hide');
        });

        //detail modal
        window.addEventListener('show-modal-detail', event =>{
            $('#detailGood').modal('show');
        });

        window.addEventListener('close-modal-detail', event =>{
            $('#detailGood').modal('hide');
        });


    </script>
    
@endpush